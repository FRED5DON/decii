<?php

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php include_once 'plates/head.php' ?>
    <link rel="stylesheet" type="text/css" href="<?= $path_dir_templates ?>styles/plugin/bootstrap-markdown.min.css"/>
    <style>
        textarea#content {
            padding: 6px;
        }

        .write-panel {
            margin: auto 10px;
        }

    </style>
</head>
<body class="decii theme-normal">
<!--<h1>你好，世界！</h1>-->
<!--<div class="loading">-->
<!--<div class="item-1"></div>-->
<!--<div class="item-2"></div>-->
<!--<div class="item-3"></div>-->
<!--</div>-->
<?php include_once 'plates/nav.php' ?>

<div class="container">


    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form  id="pub-article" class="form-horizontal write-panel" action="/article/make">
                <div class="form-group">
                    <label for="title"><?= $map['title'][$lang] ?></label>
                    <input type="text" class="form-control" name="title"
                           placeholder="<?= $map['title'][$lang] ?>"/>
                </div>
                <div class="form-group">
                    <label for="remark"><?= $map['remark'][$lang] ?></label>
                    <input type="text" class="form-control" id="remark" name="remark"
                           placeholder="<?= $map['remark'][$lang] ?>">
                </div>
                <div class="form-group">
                    <label for="content"><?= $map['content'][$lang] ?></label>
                    <textarea id="content" name="content" data-provide="markdown" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="keyword"><?= $map['keyword'][$lang] ?></label>
                    <input type="text" class="form-control" id="keyword" name="keyword"
                           placeholder="<?= $map['keyword'][$lang] ?>">
                </div>
                <div class="form-group">
                    <button type="button" id="publish" class="btn btn-info"><?= $map['submit'][$lang] ?></button>
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div><!-- /.row -->
</div><!-- /.container -->

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<?php include_once 'plates/footer.php' ?>
<script src="<?= $path_dir_templates ?>scripts/markdown.js"></script>
<script src="<?= $path_dir_templates ?>scripts/to-markdown.js"></script>
<script src="<?= $path_dir_templates ?>scripts/bootstrap-markdown.js"></script>
<script src="<?= $path_dir_templates ?>scripts/locale/bootstrap-markdown.ja.js"></script>
<script src="<?= $path_dir_templates ?>scripts/locale/bootstrap-markdown.zh.js"></script>

<script src="<?= $path_dir_templates ?>scripts/fred/fred.valid.js"></script>
<script>

    //    $(document).ready(function(){
    //
    ////        $('#fore-see').click(function(){
    ////
    ////            $('#content-md').html($("#content").val());
    ////            $('#content-md').markdown();
    ////            $("#content").attr('data-provide','markdown-editable');
    ////
    ////        });
    //
    //    });

    ;
    (function ($) {

        var _count = 30000;
        $("#content").markdown({
            autofocus: true,
            savable: false,
            footer: "<span class='text-success' id='content-footer'>0 / " + _count + "</span>",
            language: 'ja'
            ,
            onChange: function (e) {
                if (e.getContent().length <= _count) {
                    $("#content-footer").attr("class", 'text-success');
                } else {
                    $("#content-footer").attr("class", 'text-danger');
                }
                $("#content-footer").text(e.getContent().length + " / " + _count);
            },


        });

        $('form button#publish').click(function () {

            var v = [
                {
                    "value": $('input[name="title"]').val(),
                    "rules": ['not_empty'],
                    "msg": "请填写标题"
                },
                {
                    "value": $("textarea[name='content']").val(),
                    "rules": ['not_empty'],
                    "msg": "请输正文"
                },

                {
                    "value": $("input#keyword").val(),
                    "rules": ['not_empty'],
                    "msg": "请填写关键字"
                },

            ];
            /*if (<($_SESSION['sign_up_code']) ? 1 : 0 ?>) {
             v.push({
             "value": $("input[name='uvcode']").val(),
             "rules": ['not_empty', 'alphas_dash'
             ],
             "msg": "请输入验证码"
             });
             }*/
//                alert(12);
            var s = $.fred_valid().validate(v);
            if (s) {
                console.log(s['msg']);
            } else {
                envir.httpProxy.ajax($('form#pub-article').attr('action'), $('form').serialize(), 'POST',
                    function (xhr, res, o) {
                        console.log(o.responseText);
//                            showNotify($.parseJSON(o.responseText)['msg']['msg']);
                    },
                    function (xhr, res, o) {
                    }
                );
            }

        });


    }(jQuery))

</script>

</body>
</html>

