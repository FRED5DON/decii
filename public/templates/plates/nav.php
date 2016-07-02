<nav class="navbar navbar-pills navbar-fixed-top">
    <div class="container-fluid title-bar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                De'Blog
            </a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left" role="tablist">
                <li role="presentation">
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group has-feedback">
                            <input type="search" class="form-control searchBox" placeholder="">
                            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </form>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right <?= isset($_SESSION['token']) && isset($_COOKIE['token']) ? ($_SESSION['token'] == $_COOKIE['token'] ? "" : 'hide') : 'hide' ?>"
                role="tablist">
                <li <?= $_SERVER["REQUEST_URI"] != "/publish.php" ? 'class="active"' : '' ?>>
                    <a href="#"><span class="glyphicon glyphicon-th"
                                      aria-hidden="true"></span><?= $map['nav-feature'][$lang] ?><span
                            class="badge">2</span></a></li>
                <li role="presentation"><a href="#"><span class="glyphicon glyphicon glyphicon-education"
                                                          aria-hidden="true"></span><?= $map['nav-lab'][$lang] ?><span
                            class="badge">2</span></a></li>
                <li role="presentation" <?= $_SERVER["REQUEST_URI"] == "/publish.php" ? 'class="active"' : '' ?>><a
                        href="publish.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true">
                    </span><?= $map['nav-write'][$lang] ?></a></li>

                <li class="dropdown">
                    <div class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                         aria-expanded="false" style="padding: 8px 8px 0 8px;text-align: center;">
                        <img width="36px" style="display: inline;"
                             src="<?php echo $path_dir_templates; ?>resources/icon/icon-male.png" alt="..."
                             class="img-circle img-responsive center-block"/>
                        <span><?php echo "姓名"; ?></span>
                        <span class="caret"></span>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?= $map['nav-usrinfo'][$lang] ?></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><?= $map['nav-signout'][$lang] ?></a></li>
                    </ul>

                </li>

            </ul>


            <ul class="nav navbar-nav navbar-right  <?= isset($_SESSION['token']) && isset($_COOKIE['token']) ? ($_SESSION['token'] == $_COOKIE['token'] ? 'hide' : '') : '' ?>"
                role="tablist">
                <li class="access-entry">
                    <a type="button" href="signup.php"
                       class="btn btn-success navbar-btn"><?= $map['nav-signup'][$lang] ?></a>
                </li>
                <li class="access-entry">
                    <a type="button" href="signin.php"
                       class="btn btn-info navbar-btn"><?= $map['nav-signin'][$lang] ?></a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
    <div id="decii-global-progress" class="progress">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0"
             aria-valuemax="100" style="width: 10%">
            <span class="sr-only">20% Complete</span>
        </div>
    </div>
</nav>
