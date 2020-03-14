<?php
$menu = Router::getMenu('menu_acl');
$current_page = currentPage();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php foreach ($menu as $key => $val):
                $active = ''; ?>
                <?php  if(is_array($val)): ?>
                    <ul class="navbar-nav mr-auto">
                        <?php foreach ($val as $k => $v):
                            $active =  ($v == $current_page) ? 'active' : 'ddddd'; ?>
                            <?php if($k == 'separator') : ?>

                            <?php else : ?>
                                <li class="nav-item active">
                                    <a class="nav-link <?=$active?>" href="<?=$k?>"><?=$v?><span class="sr-only">(current)</span></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else:
                    $active =  ($key == $current_page) ? 'active' : ''; ?>
                    <li class="nav-item active">
                        <a class="nav-link <?=$active?>" href="<?=$key?>"><?=$val?><span class="sr-only">(current)</span></a>
                    </li>
                <?php endif; ?>
        <?php endforeach; ?>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <ul>
<!--                --><?php //if(currentUser()) : ?>
<!--                    <li class="nav-item dropdown show">-->
<!--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">-->
<!--                        Hello currentUser()->usr_name;-->
<!--                    </a>-->
<!--                    <div class="dropdown-menu show" aria-labelledby="navbarDropdown">-->
<!--                        <a class="dropdown-item" href="#">Action</a>-->
<!--                        <a class="dropdown-item" href="#">Another action</a>-->
<!--                        <div class="dropdown-divider"></div>-->
<!--                        <a class="dropdown-item" href="#">Something else here</a>-->
<!--                    </div>-->
<!--                    </li>-->
<!--                --><?php //endif; ?>
            </ul>
        </form>
    </div>
</nav>