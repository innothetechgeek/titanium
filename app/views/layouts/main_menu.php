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
        <ul class="navbar-nav mr-auto">

            <?php

            foreach ($menu as $key => $val):
                    $active = ''; ?>
                    <?php  if(is_array($val)):  $i = 0; ?>

                            <?php foreach ($val as $k => $v):
                                $active =  ($v == $current_page) ? 'active' : 'ddddd'; ?>
                                <?php if($k == 'separator')  :   ?>
                                    <div class="dropdown-divider"></div>
                                <?php else : ?>
                                    <?php if($i == 0) {?>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?=$key?>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <?php } ?>
                                            <a class="dropdown-item" href="#"><?=$k?></a>
                                    <?php if($i == count($val)) { ?>

                                            </div>
                                        </li>

                                    <?php }?>
                                <?php endif; ?>
                            <?php $i++; endforeach; ?>

                    <?php else:
                        $active =  ($key == $current_page) ? 'active' : ''; ?>
                        <li class="nav-item active">
                            <a class="nav-link <?=$active?>" href="<?=$key?>"><?=$key?><span class="sr-only">(current)</span></a>
                        </li>
                    <?php endif; ?>

            <?php
            endforeach; ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <ul>
            </ul>
        </form>
    </div>
</nav>