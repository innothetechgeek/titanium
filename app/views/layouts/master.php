<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Titanium - Theee best php framework ever!</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<?php
use core\Router;
$menu = Router::getMenu('menu_acl');
$current_page = currentPage();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php url('')?>">Titanium</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
              <a class="nav-link " href="<?php url('') ?>">Home</a>
          </li>
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
                                            <a class="nav-link dropdown-toggle" href="<?php url($v) ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?=$key?>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <?php } ?>
                                            <a class="dropdown-item" href="<?php url($v) ?>"><?=$k?></a>
                                    <?php if($i == count($val)) { ?>

                                            </div>
                                        </li>

                                    <?php }?>
                                <?php endif; ?>
                            <?php $i++; endforeach; ?>

                    <?php else:
                        $active =  ($key == $current_page) ? 'active' : ''; ?>
                        <li class="nav-item active">
                            <a class="nav-link <?=$active?>" href="http://<?= $_SERVER['HTTP_HOST']?>/titanium/<?=$val?>"><?=$key?><span class="sr-only">(current)</span></a>
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

 @yield('content')
</body>
</html>
