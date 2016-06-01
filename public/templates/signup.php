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
        #agreement{
            color: #00b3ee;
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
                        <h4 class="center"><?= $map['nav-signup'][$lang] ?></h4>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" class="form-control circle-corner" id="inputEmail3"
                               placeholder="<?= $map['username'][$lang] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" class="form-control circle-corner" id="inputEmail3"
                               placeholder="<?= $map['email'][$lang] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control circle-corner"
                               placeholder="<?= $map['password'][$lang] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control circle-corner"
                               placeholder="<?= $map['confirmPassword'][$lang] ?>">
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 16px;">
                    <input type="text" class="form-control circle-corner" placeholder="<?= $map['vcode'][$lang] ?>"
                           aria-describedby="basic-addon2">
                    <span class="input-group-addon verify-code" id="basic-addon2">
                        <img width="120" height="32" class="img-sm" src="/vcode?index=<?=time() ?>"
                             alt="..." class="img-rounded"></span>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12">
                        <div class="alert alert-warning alert-dismissible fade in circle-corner" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <?= $map['verify-error-user'][$lang] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"><?= $map['agree'][$lang] ?>
                            </label><?= '<a id="agreement" data-toggle="modal" data-target="#myModal" href="javascript:;">'.$map['agreement'][$lang].'</a>' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit"
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
</body>
</html>

