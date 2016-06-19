<?php

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php include_once 'plates/head.php' ?>
    <link rel="stylesheet" type="text/css" href="<?= $path_dir_templates ?>styles/plugin/bootstrap-markdown.min.css"/>
    <!--    <link href="//cdn.bootcss.com/bootstrap-markdown/2.9.0/css/bootstrap-markdown.min.css" rel="stylesheet">-->
    <style>
        textarea#content {
            padding: 6px;
        }

        .write-panel {
            margin: auto 10px;
        }

        div.md-preview{
            overflow-y: auto;
        }
        .container-fluid,.container-fluid .row{
            height:100% !important;
        }
        .md-editor.md-fullscreen-mode .md-input,
        .md-editor.md-fullscreen-mode .md-input:focus, .md-editor.md-fullscreen-mode .md-input:hover{
            background: #dff0d8;
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
            <form id="pub-article" class="form-horizontal write-panel" action="/article/make">
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
            <div id="prompt-markdown" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">插入图片</h4>
                        </div>


                        <div class="modal-body">
                            <form>
                                <div class="alert alert-danger" role="alert">
                                    本地图片仅支持JPG、GIF、PNG格式,并且文件小于512Kb(1kb=1024字节).网络图片地址以http://、https://或ftp://格式开头
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">请填入网络图片地址或点击按钮上传本地图片到服务器.</label>
                                    <input type="text" class="form-control" id="insertedLinkValue"
                                           placeholder="请填入网络图片地址(如: http://www.freddon.com/logo.png )">
                                </div>
                                <div class="form-group">
                                    <input type="file"/>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">上传进度</label>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar"
                                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 100%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button id="insertLink" type="button" class="btn btn-info">插入</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div><!-- /.row -->
</div><!-- /.container -->

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<?php include_once 'plates/footer.php' ?>
<!--<script src="//cdn.bootcss.com/bootstrap-markdown/2.9.0/js/bootstrap-markdown.js"></script>-->
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
        var mDe;
        $("#content").markdown({
            autofocus: true,
            savable: false,
            footer: "<span class='text-success' id='content-footer'>0 / " + _count + "</span>",
            language: '<?= $map['currentLang'] ?>',
            disabledButtons: ['cmdIPre'],
            onChange: function (e) {
                if (e.getContent().length <= _count) {
                    $("#content-footer").attr("class", 'text-success');
                } else {
                    $("#content-footer").attr("class", 'text-danger');
                }
                $("#content-footer").text(e.getContent().length + " / " + _count);
            },
            onBtnClick: function (e, name) {
                if (name == 'cmdImage') {
                    mDe = e;
                    $('#prompt-markdown').modal('toggle');
                    $("input#insertedLinkValue").val("");
                    return true;
                }
                if (name == 'cmdUrl') {
                    // Give [] surround the selection and prepend the link
                    var chunk, cursor, selected = e.getSelection(), content = e.getContent(), link;
                    if (selected.length === 0) {
                        // Give extra word
                        chunk = e.__localize('enter link description here');
                    } else {
                        chunk = selected.text;
                    }
                    link = 'http://';
                    var sanitizedLink = $('<div>' + link + '</div>').text();
                    // transform selection and set the cursor into chunked text
                    e.replaceSelection('[' + chunk + '](' + sanitizedLink + ')');
                    cursor = selected.start + 1;
                    // Set the cursor
                    e.setSelection(cursor, cursor + chunk.length);
                    return true;
                }
                return false;

            },
            onAfterBtnClick: function (e,name) {
                if (name == 'cmdPreview') {
                    if (e.$isFullscreen) {
                        e.enableButtons('cmdIPre');
                        $("textarea#content").removeClass("col-sm-6");
                        $("textarea#content").addClass("col-xs-12");
                    } else {
                        e.disableButtons('cmdIPre');
                    }
                }
            },
            onChange: function (e) {
                if (e.$isFullscreen && e.$isPreview) {
                    $('.md-preview').html(e.parseContent());
                }
            },
            onFullScreenChanged: function (e, isFullScreen) {
                if (isFullScreen) {
                    e.enableButtons('cmdIPre');
                    $("textarea#content").removeClass("col-sm-6");
                    $("textarea#content").addClass("col-xs-12");
                } else {
                    e.disableButtons('cmdIPre');
                    $("textarea#content").removeClass("col-sm-6");
                    $("textarea#content").addClass("col-xs-12");
                }
            },
            onPreview: function (e) {
                if (e.$isFullscreen) {
                    e.enableButtons('cmdIPre');
                } else {
                    e.disableButtons('cmdIPre');

                }
                $(".md-editor.md-fullscreen-mode .md-preview").css({'height': e.$textarea.outerHeight()+'px !important;'});

            },
            additionalButtons: [
                [{
                    name: "groupUtil",
                    data: [{
                        name: "cmdIPre",
                        title: "InstancePre",
                        icon: "glyphicon glyphicon-flash",
                        toggle: true,
                        clicked: this.$isPreview,
                        callback: function (e) {
                            mDe = e;
                            if (e.$isFullscreen) {
                                //打开、关闭分栏模式
                                e.showPreview();
                                if (this.clicked) {
                                    //关闭
                                    e.disableButtons('all').enableButtons('cmdPreview').enableButtons('cmdIPre');
                                    $("textarea#content").removeClass("col-sm-6");
                                    $("textarea#content").removeClass("col-xs-12");
                                    $('textarea#content').addClass('col-sm-12');
                                    $("textarea#content").css('display', 'none');
                                    $('.md-preview').removeClass('col-sm-6');
                                    $('.md-preview').addClass('col-sm-12');
                                } else {
                                    e.enableButtons('all');
                                    $("textarea#content").removeClass("col-sm-12");
                                    $('textarea#content').addClass('col-sm-6');
                                    $('textarea#content').addClass('col-xs-12');
                                    $("textarea#content").css('display', 'block');
                                    $(".md-preview").removeClass("col-sm-12");
                                    $('.md-preview').addClass('col-sm-6');
                                }
                                $(".md-editor.md-fullscreen-mode .md-preview").css({'height': e.$textarea.outerHeight()+'px !important;'});
                                this.clicked = !this.clicked;
                            }
                        }
                    }]
                }]
            ]


        });

        $("#insertLink").click(function () {
            var link = $("input#insertedLinkValue").val();
            var opts = [

                {
                    "value": link,
                    "rules": ['not_empty', 'url'
                    ],
                    "msg": "请输入正确的图片url"
                },
            ];
            var s = $.fred_valid().validate(opts);
            if (s) {
                $("input#insertedLinkValue").val(s['msg']);
            } else {
                var e = mDe;
                var chunk, cursor, selected = e.getSelection(), content = e.getContent();

                if (selected.length === 0) {
                    // Give extra word
                    chunk = e.__localize('enter image description here');
                } else {
                    chunk = selected.text;
                }
                var urlRegex = new RegExp('^((http|https)://|(//))[a-z0-9]', 'i');
                if (link !== null && link !== '' && link !== 'http://' && urlRegex.test(link)) {
                    var sanitizedLink = $('<div>' + link + '</div>').text();

                    // transform selection and set the cursor into chunked text
                    e.replaceSelection('![' + chunk + '](' + sanitizedLink + ' "' + e.__localize('enter image title here') + '")');
                    cursor = selected.start + 2;

                    // Set the next tab
                    e.setNextTab(e.__localize('enter image title here'));

                    // Set the cursor
                    e.setSelection(cursor, cursor + chunk.length);
                }
                $('#prompt-markdown').modal('toggle');
            }

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

