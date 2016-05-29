<nav class="navbar navbar-pills navbar-fixed-top">
    <div class="container-fluid">
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
            <ul class="nav navbar-nav navbar-right" role="tablist">
                <li class="active">
                    <a href="#"><span class="glyphicon glyphicon-th"
                                      aria-hidden="true"></span><?= $map['nav-feature'][$lang] ?><span
                            class="badge">2</span></a></li>
                <li role="presentation"><a href="#"><span class="glyphicon glyphicon glyphicon-education"
                                                          aria-hidden="true"></span><?= $map['nav-lab'][$lang] ?><span
                            class="badge">2</span></a></li>
                <li role="presentation"><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true">
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
                <li class="access-entry hide">
                    <button type="button"
                            class="btn btn-success navbar-btn"><?= $map['nav-signup'][$lang] ?></button>
                </li>
                <li class="access-entry hide">
                    <button type="button" class="btn btn-info navbar-btn"><?= $map['nav-signin'][$lang] ?></button>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>