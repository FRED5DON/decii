<?php
session_start();
$path_dir_templates = './public/templates/';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>De'Blog</title>
    <?php

    $path_dir_templates = './public/templates/';
    $map = include_once 'Lang.php';
    $lang = $map['currentLang'];

    ?>
    <link rel="shortcut icon" href="<?php echo $path_dir_templates; ?>favicon.ico"/>
    <link rel="bookmark" href="<?php echo $path_dir_templates; ?>favicon.ico" type="image/x-icon"/>
    <meta name="description" content="Peronal Page of Freddon"/>
    <!-- Bootstrap -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?php echo $path_dir_templates; ?>styles/scss/main.css" rel="stylesheet" type="text/css"/>


    <style>
        body {
            padding-top: 70px;
        }

        .modal {
            z-index: 1250 !important;
        }

        .md-editor.md-fullscreen-mode {
            z-index: 1220 !important;
        }
    </style>


    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo $path_dir_templates; ?>scripts/tools.js"></script>
    <script src="<?php echo $path_dir_templates; ?>scripts/jquery.serializejson.min.js"></script>

