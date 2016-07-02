<?php include_once 'plates/head.php' ?>
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

        <div class="col-sm-8">

            <ul class="media-list">
                <?php

                $currentPage = 0;
                if (isset($_REQUEST['page'])) {
                    $currentPage = $_REQUEST['page'];
                }
                $cookie = "";
                if ($_COOKIE) {
                    foreach ($_COOKIE as $key => $value) {
                        $cookie = $cookie . $key . '=' . $value . '; ';
                    }
                }
                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/article/get' . '?' . 'page=' . $currentPage;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_COOKIE, $cookie);
                $result = curl_exec($ch);
                curl_close($ch);
                $datas = json_decode($result, true);
                if (isset($datas['data'])) {
                    foreach ($datas['data'] as $value) {
                        $li = [];
                        preg_match("/(http[s]?:\\/\\/([\\w-]+.)+([:\\d+])?(\\/[\\w-\\.\\/\\?%&=]*)?)/i",
                            $value['content'], $matches
                        );
                        $remark = $value['desc'] ? $value['desc'] : $value['content'];
                        $li[] = ('<li class="media note-item-li" data-id="' . $value['id'] . '">');
                        $li[] = ('<div class="media-body">');
                        $li[] = ('<h3 class="media-heading">' . $value["title"] . '</h3>');
                        $li[] = ('<p class="text-left"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>' . (explode(" ", $value['createTime'])[0]));
                        $li[] = (' by <a href="#">' . $value['usrName'] . '</a></p>');
                        $li[] = ('<p class="lead">' . $remark . '</p>');
                        $li[] = ('<p>阅读' . $value['viewCount'] . ' | 赞' . $value['loveCount'] . ' | 转发' . $value['forwardCount'] . ' | 评论' . $value['discussCount'] . '</p>');
                        $li[] = ('</div><div class="media-right media-middle">');
                       if($matches && $matches[0]){
                            $li[] = ('<img class="media-object img-rounded" width=128 src="' . $matches[0] . '" alt="">');
                        }
                        $li[] = ('</div></li>');
                        echo implode('', $li);
                    }

                }
                $pageData = [];
                if (isset($datas['page'])) {
                    $pageData = $datas['page'];
                }
                ?>

                <!-- <li class="media page-header" data-id="">
                     <div class="media-body">
                         <h3 class="media-heading">关于浏览器跨域问题Access-Control-Allow-Origin</h3>
                         <p>阅读1209 | 赞68 | 收藏165 | 评论15</p>
                         <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                             ante.</p>
                     </div>
                     <div class="media-right">

                         <p class="text-right"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>2016-02-23
                         </p>
                         <img class="media-object" src="resources/empty140x140.svg"
                              alt="...">
                     </div>
                 </li>-->
            </ul>


            <nav>
                <ul class="pagination">
                    <?php
                    $pageCount = 0;
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
                    ?>
                </ul>
            </nav>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>热门搜索</h4>
                <div>

                    <span class="label label-default">Default</span>
                    <span class="label label-primary">Primary</span>
                    <span class="label label-success">Success</span>
                    <span class="label label-info">Info</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>

            </div>
            <div class="sidebar-module">
                <h4>默认分类</h4>
                <ol class="list-unstyled">
                    <li><a href="#">March 2014</a></li>
                    <li><a href="#">February 2014</a></li>
                    <li><a href="#">January 2014</a></li>
                    <li><a href="#">December 2013</a></li>
                    <li><a href="#">November 2013</a></li>
                    <li><a href="#">October 2013</a></li>
                    <li><a href="#">September 2013</a></li>
                    <li><a href="#">August 2013</a></li>
                    <li><a href="#">July 2013</a></li>
                    <li><a href="#">June 2013</a></li>
                    <li><a href="#">May 2013</a></li>
                    <li><a href="#">April 2013</a></li>
                </ol>
            </div>
        </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</div><!-- /.container -->

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php include_once 'plates/footer.php' ?>


<script>

    $(document).ready(function () {

        $("li.note-item-li").click(function (e) {
            var id = e.currentTarget.getAttribute('data-id');
            location.href='article.php?id='+id;
        });


        var reqList = function () {
            envir.httpProxy.ajax('/article/get', 'page=0', 'GET',
                function (xhr, res, o) {

                    var json = $.parseJSON(o.responseText);
                    if (json['data']) {
                        console.log(json['data'][0]);
                    }

//                        localStorage.clear();
//                            showNotify($.parseJSON(o.responseText)['msg']['msg']);
                },
                function (xhr, res, o) {
                }
            );
        }
        reqList();
    });

</script>
</body>
</html>

