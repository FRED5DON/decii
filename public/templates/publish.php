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

        div.md-preview {
            overflow-y: auto;
        }

        .container-fluid, .container-fluid .row {
            height: 100% !important;
        }

        .md-editor.md-fullscreen-mode .md-input,
        .md-editor.md-fullscreen-mode .md-input:focus, .md-editor.md-fullscreen-mode .md-input:hover {
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
                                    <label for="recipient-name" class="control-label">请填入网络图片地址.</label>
                                    <input type="text" class="form-control" id="insertedLinkValue"
                                           placeholder="请填入网络图片地址(如: http://www.freddon.com/logo.png )">
                                </div>
                                <div class="form-group">
                                    <input id="pick_file" type="file"/><br/>
                                    <input id="pic_width" type="number" placeholder="图片宽度"/>
                                    <input id="pic_height" type="number" placeholder="图片高度"/>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">上传进度</label>
                                    <div class="progress">
                                        <div id="file-progress" class="progress-bar progress-bar-info"
                                             role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 0%">
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
<script src="<?= $path_dir_templates ?>scripts/servo/qiniu.js"></script>
<script src="<?= $path_dir_templates ?>scripts/servo/plupload.full.min.js"></script>
<script>

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
            onAfterBtnClick: function (e, name) {
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
                $(".md-editor.md-fullscreen-mode .md-preview").css({'height': e.$textarea.outerHeight() + 'px !important;'});

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
                                $(".md-editor.md-fullscreen-mode .md-preview").css({'height': e.$textarea.outerHeight() + 'px !important;'});
                                this.clicked = !this.clicked;
                            }
                        }
                    }]
                }]
            ]


        });

        $("#insertLink").click(function () {
            $("#file-progress").css("width", '0%');
            generalPicUrl(320,240);
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


        //upload

        var Qiniu_UploadUrl = "http://o8wa1uopp.bkt.clouddn.com";
        var active_pic;

        /*$("#pick_file").change(function(){
         //普通上传
         var Qiniu_upload = function(f, token, key) {
         var xhr = new XMLHttpRequest();
         xhr.open('POST', Qiniu_UploadUrl, true);
         var formData, startDate;
         formData = new FormData();
         if (key !== null && key !== undefined) formData.append('key', key);
         formData.append('token', token);
         formData.append('file', f);
         var taking;
         xhr.upload.addEventListener("progress", function(evt) {
         if (evt.lengthComputable) {
         var nowDate = new Date().getTime();
         taking = nowDate - startDate;
         var x = (evt.loaded) / 1024;
         var y = taking / 1000;
         var uploadSpeed = (x / y);
         var formatSpeed;
         if (uploadSpeed > 1024) {
         formatSpeed = (uploadSpeed / 1024).toFixed(2) + "Mb\/s";
         } else {
         formatSpeed = uploadSpeed.toFixed(2) + "Kb\/s";
         }
         var percentComplete = Math.round(evt.loaded * 100 / evt.total);
         //                        progressbar.progressbar("value", percentComplete);
         // console && console.log(percentComplete, ",", formatSpeed);
         }
         }, false);

         xhr.onreadystatechange = function(response) {
         if (xhr.readyState == 4 && xhr.status == 200 && xhr.responseText != "") {
         var blkRet = JSON.parse(xhr.responseText);
         console && console.log(blkRet);
         $("#dialog").html(xhr.responseText).dialog();
         } else if (xhr.status != 200 && xhr.responseText) {

         }
         };
         startDate = new Date().getTime();
         $("#progressbar").show();
         xhr.send(formData);
         };
         var token = $("#token").val();
         if ($("#pick_file")[0].files.length > 0 && token != "") {
         Qiniu_upload($("#pick_file")[0].files[0], token, $("#key").val());
         } else {
         console && console.log("form input error");
         }
         });*/


        var uploader = Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式,依次退化
            browse_button: 'pick_file',         // 上传选择的点选按钮，**必需**
            // 在初始化时，uptoken, uptoken_url, uptoken_func 三个参数中必须有一个被设置
            // 切如果提供了多个，其优先级为 uptoken > uptoken_url > uptoken_func
            // 其中 uptoken 是直接提供上传凭证，uptoken_url 是提供了获取上传凭证的地址，如果需要定制获取 uptoken 的过程则可以设置 uptoken_func
//             uptoken : '<?//=$qiniuToken?>//', // uptoken 是上传凭证，由其他程序生成
            uptoken_url: '/qiniu/token',         // Ajax 请求 uptoken 的 Url，**强烈建议设置**（服务端提供）
            // uptoken_func: function(file){    // 在需要获取 uptoken 时，该方法会被调用
            //    // do something
            //    return uptoken;
            // },
            get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的 uptoken
//            downtoken_url: '/qiniu/token',
            // Ajax请求downToken的Url，私有空间时使用,JS-SDK 将向该地址POST文件的key和domain,服务端返回的JSON必须包含`url`字段，`url`值为该文件的下载地址
            unique_names: true,              // 默认 false，key 为文件名。若开启该选项，JS-SDK 会为每个文件自动生成key（文件名）
            // save_key: true,                  // 默认 false。若在服务端生成 uptoken 的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
            domain: Qiniu_UploadUrl,     // bucket 域名，下载资源时用到，**必需**
//            container: 'container',             // 上传区域 DOM ID，默认是 browser_button 的父元素，
            max_file_size: '512kb',             // 最大文件体积限制
//            flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入 flash,相对路径
            max_retries: 3,                     // 上传失败最大重试次数
//            dragdrop: true,                     // 开启可拖曳上传
//            drop_element: 'container',          // 拖曳上传区域元素的 ID，拖曳文件或文件夹后可触发上传
//            chunk_size: '4mb',                  // 分块上传时，每块的体积
            auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传,
            //x_vars : {
            //    自定义变量，参考http://developer.qiniu.com/docs/v6/api/overview/up/response/vars.html
            //    'time' : function(up,file) {
            //        var time = (new Date()).getTime();
            // do something with 'time'
            //        return time;
            //    },
            //    'size' : function(up,file) {
            //        var size = file.size;
            // do something with 'size'
            //        return size;
            //    }
            //},
            init: {
                'FilesAdded': function (up, files) {
                    plupload.each(files, function (file) {
                        // 文件添加进队列后,处理相关的事情
                    });
                },
                'BeforeUpload': function (up, file) {
                    // 每个文件上传前,处理相关的事情
                },
                'UploadProgress': function (up, file) {
                    // 每个文件上传时,处理相关的事情
                    $("#file-progress").css("width", file.percent + '%');
                },
                'FileUploaded': function (up, file, info) {
                    var ifo = JSON.parse(info);
                    active_pic = ifo.key;
                    generalPicUrl(320,240);
                    // 每个文件上传成功后,处理相关的事情
                    // 其中 info 是文件上传成功后，服务端返回的json，形式如
                    // {
                    //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    //    "key": "gogopher.jpg"
                    //  }
                    // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html

                    // var domain = up.getOption('domain');
                    // var res = parseJSON(info);
                    // var sourceLink = domain + res.key; 获取上传成功后的文件的Url
                },
                'Error': function (up, err, errTip) {
                    //上传出错时,处理相关的事情
                },
                'UploadComplete': function () {
                    //队列文件处理完毕后,处理相关的事情
                },
                'Key': function (up, file) {
                    // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                    // 该配置必须要在 unique_names: false , save_key: false 时才生效

                    var key = "";
                    // do something with key here
                    return key;
                }
            }
        });

        function generalPicUrl(pwidth, pheight) {
            if (active_pic) {
                var width = $("#pic_width").val() || pwidth;
                var height = $("#pic_height").val() || pheight;
                var imgUrl = Qiniu_UploadUrl + "/" + active_pic;
                var url = imgUrl + "?imageView2/1/w/" + width + "/h/" + height;
                $("#insertedLinkValue").val(url);
            }
        }


    }(jQuery))

</script>

</body>
</html>

