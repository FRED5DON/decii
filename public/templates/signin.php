<?php
$path_dir_templates = './public/templates/';
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
            <form class="form-horizontal">
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
                        <input type="email" class="form-control circle-corner" id="inputEmail3"
                               placeholder="<?= $map['username'][$lang] . ' / ' . $map['email'][$lang] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control circle-corner" id="inputPassword3"
                               placeholder="<?= $map['password'][$lang] ?>">
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 16px;">
                    <input type="text" class="form-control circle-corner" placeholder="<?= $map['vcode'][$lang] ?>"
                           aria-describedby="basic-addon2">
                    <span class="input-group-addon verify-code" id="basic-addon2">
                        <img width="120" height="32" class="img-sm" src="/vcode?index=<?=time() ?>"
                             alt="..." class="img-rounded"></span>
                </div>
                <div class="form-group has-feedback hide">
                    <div class="col-sm-12">
                        <div class="bg-danger alert circle-corner">
                            <p><span class="glyphicon glyphicon-remove"
                                     aria-hidden="true"></span> <?= $map['verify-error-user'][$lang] ?></p>
                        </div>
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
                        <button type="submit"
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
</body>
</html>

