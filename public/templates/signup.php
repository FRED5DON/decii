<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php include_once 'plates/head.php';
    ?>
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

        #agreement {
            color: #00b3ee;
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
            <form id="signUp" class="form-horizontal" action="/user/signup"
                  method="post"
                  enctype="application/x-www-form-urlencoded">
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="#">
                            <h3 class="center">De'Blog</h3>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="center"><?= $map['nav-signup'][$lang] ?></h4>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control circle-corner" name="usrname"
                               value="fred"
                               placeholder="<?= $map['username'][$lang] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" class="form-control circle-corner" name="email"
                               value="gsiner@live.com"
                               placeholder="<?= $map['email'][$lang] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control circle-corner" id="usrpwd" name="usrpwd"
                               value="123456"
                               placeholder="<?= $map['password'][$lang] ?>">
                        <input type="password" name="usrpassword" hidden="hidden"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control circle-corner" id="usrpwd2"
                               value="123456"
                               placeholder="<?= $map['confirmPassword'][$lang] ?>">
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 16px;">
                    <input type="text" class="form-control circle-corner"
                           name="uvcode"
                           placeholder="<?= $map['vcode'][$lang] ?>"
                           aria-describedby="basic-addon2">
                    <span class="input-group-addon verify-code" id="basic-addon2">
                        <img width="120" height="32" class="img-sm" id="u-imcode" src="/user/vcode/signup?index=<?= time() ?>"
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
                                <input type="checkbox" name="isAgree"><?= $map['agree'][$lang] ?>
                            </label><?= '<a id="agreement" data-toggle="modal" data-target="#myModal" href="javascript:;">' . $map['agreement'][$lang] . '</a>' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="button" id="signup"
                                class="btn btn-success btn-block circle-corner"><?= $map['nav-signup'][$lang] ?></button>
                    </div>
                </div>

                <div class="form-group has-feedback ">
                    <div class="col-sm-12">
                        <div class="bg-info alert circle-corner">
                            <p><?= $map['direct-login-info'][$lang] ?><a class="text-primary" href="signin.php">
                                    <b><?= $map['nav-signin'][$lang] ?></b></a></p>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-sm-2 col-md-3"></div>


    </div><!-- /.row -->

</div><!-- /.container -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
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
                $("#u-imcode").attr('src','/user/vcode/signup?index='+new Date().getTime());
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
            $('form button#signup').click(function () {

                var v = [
                    {
                        "value": $('input[name="usrname"]').val(),
                        "rules": ['not_empty', 'alpha_dash',
                            {'max_length': 11},
                            {'min_length': 4}
                        ],
                        "msg": "请检查用户名，只能包含小写字母、下划线"
                    },
                    {
                        "value": $("input[name='email']").val(),
                        "rules": ['not_empty', 'email'
                        ],
                        "msg": "请输入电子邮箱"
                    },
                    {
                        "value": $("input#usrpwd").val(),
                        "rules": ['not_empty', 'abcnums_dash',
                            {'max_length': 11},
                            {'min_length': 6}
                        ],
                        "msg": "密码只能包含数字、字母、下划线"
                    },
                    {
                        "value": $("input#usrpwd2").val(),
                        "rules": ['not_empty', 'abcnums_dash',
                            {'matches': $('input#usrpwd').val()}
                        ],
                        "msg": "确认密码不一致，请重新输入"
                    },

                ];
                if (<?=isset($_SESSION['sign_up_code']) ? 1 : 0 ?>) {
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
                                console.log(o.responseText);
                                showNotify($.parseJSON(o.responseText)['msg']['msg']);
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

