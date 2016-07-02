<?php include_once 'plates/head.php' ?>
<link rel="stylesheet" type="text/css" href="<?= $path_dir_templates ?>styles/plugin/bootstrap-markdown.min.css"/>
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

    .md-editor, .md-editor > .md-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .md-editor, .md-editor .md-footer, textarea#content {
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

</style>
<?= '</head>' ?>
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

        <div class="col-sm-8 blog-main col-sm-offset-2">


            <?php

            if (isset($_REQUEST['id'])) {
                $cid = $_REQUEST['id'];
            }
            if (!$cid) {
                die("非法请求");
            }
            $cookie = "";
            if ($_COOKIE) {
                foreach ($_COOKIE as $key => $value) {
                    $cookie = $cookie . $key . '=' . $value . '; ';
                }
            }
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/article/get' . '?' . 'id=' . $cid;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            $result = curl_exec($ch);
            curl_close($ch);
            $datas = json_decode($result, true);
            $article = [];
            if (isset($datas['data'])) {
                $article = $datas['data'][0];
                $blog = [];
                $blog[] = ("<div class=\"blog-post\">");
                $blog[] = ("<h2 class=\"blog-post-title text-center\">" . $article['title'] . "</h2>");
                $blog[] = ("<p class=\"text-center\">");
                $blog[] = ("<span class=\"center-block\">");
                $blog[] = ("<a href=\"javascript:;\">");
                $blog[] = ("<img class=\"circle-image-24 common-hoz-margin\" src=\"" . $article['usrIcon'] . "\" alt=\"\">");
                $blog[] = ("<b>" . $article['usrName'] . "</b></a>");
                $blog[] = ' 发表于' . (explode(" ", $article['createTime'])[0]) . ' &nbsp; 阅读' . $article['viewCount'] . ' | 赞' . $article['loveCount'] . ' | 转发' . $article['forwardCount'] . ' | 评论' . $article['discussCount'];
                $blog[] = ("</span>");
                $blog[] = ("<blockquote>" . $article['desc'] . " </blockquote>");
                $blog[] = ("<div class=\"article-content\"> </div>");
                $blog[] = ("</div>");
                echo implode('', $blog);
            }

            ?>


            <!-- <nav>
                 <ul class="pagination">

 /*                    $pageCount = 0;
                     if (isset($pageData['pages'])) {
                         $pageCount = $pageData['pages'];
                     }
                     if (isset($pageData['index'])) {
                         $currentPage = $pageData['index'];
                     }
                     $maxShowCols = 10;
                     $offset = $currentPage % ($maxShowCols - 1);
                     //$i>=$maxShowCols*$currentPage/($maxShowCols-1) and
                     for ($i = 0; $i < $pageCount; $i++) {
                         echo '<li ' . ($currentPage == $i ? "class=\"active disable\"" : "") . '>
                         <a href="articles.php?page=' . $i . '">' . ($i + 1) . '</a></li>';
                     }

                 </ul>
             </nav>-->


        </div><!-- /.blog-main -->

        <div class="col-sm-8 col-sm-offset-2">

            <h4>评论（5）</h4>
            <hr/>


            <ul class="media-list">
                <li class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object circle-image-48 common-hoz-margin" alt="64x64"
                                 src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTVhYWI4ODgwMSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NWFhYjg4ODAxIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4="
                                 data-holder-rendered="true">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Fred</h4>
                        <div class="reply-content">
                            <p>dsfsdf</p>
                        </div><!-- Nested media object -->
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object circle-image-48 common-hoz-margin" alt="64x64"
                                         src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTVhYWI4ODgwMSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NWFhYjg4ODAxIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4="
                                         data-holder-rendered="true"></a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Gsiner</h4>
                                <div class="reply-content">
                                    <p>vdasaf</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>


            <hr/>
            <form
                enctype="application/x-www-form-urlencoded"
                class="form-horizontal write-panel" action="/article/make">

                <div class="form-group">
                    <textarea class="img-rounded" id="content" name="content" data-provide="markdown"
                              rows="5"></textarea>
                </div>

                <div class="form-group">
                    <button type="button" id="publish" class="btn btn-normal text-right">发表评论</button>
                </div>
            </form>

        </div>

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

<script>

    ;
    (function ($) {

        var content = [];
        <?php
        $c = explode("\n", $article['content']);
        foreach ($c as $value) {
            $value = str_replace(array("\r\n", "\r", "\n"), "", $value);
            echo "content.push('" . $value . "');\n";
        }?>

        $("div.article-content").html(markdown.toHTML(content.join('\r\n')));


        var _count = 1200;
        $("#content").markdown({
            savable: false,
            language: '<?= $map['currentLang'] ?>',
            disabledButtons: ['cmdIPre'],
            hiddenButtons: ['cmdImage'],
            onChange: function (e) {
                if (e.$isFullscreen && e.$isPreview) {
                    $('.md-preview').html(e.parseContent());
                }
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

    })(jQuery);

</script>
</body>
</html>

