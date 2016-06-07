<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php include_once 'plates/head.php' ?>
    <style>
        .input-group-addon.verify-code {
            padding: 0;
            border-radius: 0px;
            border-width: 1px;
            background: transparent;
        }

        .input-group-addon.verify-code,
        .input-group-addon.verify-code img {
            border-radius: 0 30px 30px 0;
        }
        .alert{
            margin-bottom: 0 !important;
        }

    </style>
</head>
<body class="decii theme-normal global-bg">
<!--<h1>你好，世界！</h1>-->
<!--<div class="loading">-->
<!--<div class="item-1"></div>-->
<!--<div class="item-2"></div>-->
<!--<div class="item-3"></div>-->
<!--</div>-->

<div class="container">

    <div class="row">
        <div class="col-sm-2 col-md-3"></div>
        <div class="col-sm-8 col-md-6 center-block panel-sign circle-corner">
            <form  class="form-horizontal" action="/user/signin">
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="#">
                            <h3 class="center">De'Blog</h3>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="center"><?= $map['nav-signin'][$lang] ?></h4>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control circle-corner" name="usrname"
                               placeholder="<?= $map['username'][$lang] . ' / ' . $map['email'][$lang] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control circle-corner" id="usrpwd"
                               placeholder="<?= $map['password'][$lang] ?>">
                        <input type="password" name="usrpassword" hidden="hidden"/>
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 16px;">
                    <input type="text" class="form-control circle-corner" name="uvcode" placeholder="<?= $map['vcode'][$lang] ?>"
                           aria-describedby="basic-addon2">
                    <span class="input-group-addon verify-code" id="basic-addon2">
                        <img width="120" height="32" id="u-imcode" class="img-sm" src="/user/vcode/signin?index=<?=time() ?>"
                             alt="..." class="img-rounded"></span>
                </div>
                <div class="form-group has-feedback notify-panel">
                    <div class="col-sm-12">

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"><?= $map['remember'][$lang] ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="button" id="signin"
                                class="btn btn-info btn-block circle-corner"><?= $map['nav-signin'][$lang] ?></button>
                    </div>
                </div>

                <div class="form-group has-feedback ">
                    <div class="col-sm-12">
                        <div class="bg-info alert circle-corner">
                            <p><?= $map['direct-login-info'][$lang] ?><a class="text-primary" href="#">
                                    <b><?= $map['nav-signin'][$lang] ?></b></a></p>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-sm-2 col-md-3"></div>


    </div><!-- /.row -->

</div><!-- /.container -->

<?php include_once 'plates/footer.php' ?>


<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<script src="<?php echo $path_dir_templates; ?>scripts/fred/fred.valid.js"></script>
<script>
    $(document).ready(
        function () {

            $('#u-imcode').click(function(){
                refresh();
            });
            function refresh(){
                $("#u-imcode").attr('src','/user/vcode/signin?index='+new Date().getTime());
            }

            function mkNotification(value) {
                var s = [];
                s.push('<div class="alert alert-warning alert-dismissible fade in circle-corner" role="alert">');
                s.push('<button type="button" class="close" data-dismiss="alert" aria-label="Close">');
                s.push('<span aria-hidden="true">×</span></button>');
                s.push('<span class="msg-content">' + value + '</span></div>');
                return s.join('');
            }

//           console.log( $('form[id="signUp"]').fred_valid(2) );
            $('form button#signin').click(function () {

                var v = [
                    {
                        "value": $('input[name="usrname"]').val(),
                        "rules": ['not_empty', 'abcsignal_dash',
                            {'max_length': 11},
                            {'min_length': 4}
                        ],
                        "msg": "请检查用户名"
                    },
                    {
                        "value": $("input#usrpwd").val(),
                        "rules": ['not_empty', 'abcnums_dash',
                            {'max_length': 11},
                            {'min_length': 6}
                        ],
                        "msg": "密码只能包含数字、字母、下划线"
                    },

                ];
                if (<?=isset($_SESSION['sign_in_code']) ? 1 : 0 ?>) {
                    v.push({
                        "value": $("input[name='uvcode']").val(),
                        "rules": ['not_empty', 'alphas_dash'
                        ],
                        "msg": "请输入验证码"
                    });
                }
//                alert(12);
                var s = $.fred_valid().validate(v);
                if (s) {
                    showNotify(s['msg']);
                }else{
                    if($("input#usrpwd").val()){
                        $("input[name='usrpassword']").val($.fn.md5($("input#usrpwd").val()));
                        envir.httpProxy.ajax($('form').attr('action'),$('form').serialize(),'POST',
                            function(xhr,res,o){
                                refresh();
                                showNotify($.parseJSON(o.responseText)['msg']['msg']);
                                console.log(o.responseText);
                            },
                            function(xhr,res,o){}
                        );
                    }
                }



            });

            function showNotify(msg){
                $('.notify-panel > div').html(mkNotification(msg));
                $('.notify-panel').fadeIn('slow', function () {
                    // Animation complete
                });
            }


        });

</script>
</body>
</html>

