<?php
$path_dir_templates = './public/templates/';
$lang = 'jp';
$map = include_once 'plates/lang.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php include_once 'plates/head.php' ?>
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

        <div class="col-sm-8 col-md-6 center-block panel-sign">
            <form class="form-horizontal">
                <input name="title" type="text" placeholder="Title?" />
                <textarea id="content" name="content" data-provide="markdown" rows="10"></textarea>
                <label class="checkbox">
                    <input name="publish" type="checkbox"> Publish
                </label>
                <hr/>
                <button type="submit" class="btn">Submit</button>
            </form>


            <div data-provide="markdown-editable">
                <h3>This is some editable heading</h3>
                <p>Well, actually all contents within this "markdown-editable" context is really editable. Just click anywhere!</p>
            </div>
            </div>

    </div><!-- /.row -->

</div><!-- /.container -->

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php include_once 'plates/footer.php'?>

<script>

    $(document).ready(function(){

        $("#content").markdown({autofocus:false,savable:false})
    });

</script>

</body>
</html>

