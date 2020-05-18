<?php $this->start('head') ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Titanium | Add Movie</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php url('assets/plugins/admin_template/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/titanium/assets/css/admin_template/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<?php $this->end() ?>
<?php $this->start('body'); ?>
<div class="wrapper">
<!-- Navbar -->
<?php include(ROOT . DS . 'app' . DS . 'views'. DS .'layouts'. DS .'admin_nav_bar.php') ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include(ROOT . DS . 'app' . DS . 'views'. DS .'layouts'. DS .'admin_side_bar.php') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cool Movies</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Simple Tables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?=$this->rows_found?> movies</h3>
                    </div>
<!--                     /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Movie Title</th>
                                <th>Year released</th>
                                <th style="width: 40px">Genre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $movies = $this->movies;
                                foreach ($movies as $movie){ ?>
                                <tr>
                                    <td><?=$movie['mv_id']?>.</td>
                                    <td><?=$movie['mv_title']?></td>
                                    <td>
                                        <?= format_date('d F Y',$movie['mv_year_released']) ?>
                                    </td>
                                    <td><?=$movie['genres']?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <style>
                                .pagination .active{
                                    background: #007bff;
                                }
                            </style>
                            <?= $this->pagination_links; ?>
                        </ul>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
</div>
</div>
<!-- jQuery -->
<script src="<?php url('plugins/admin_template/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php url('assets/plugins/admin_template/js/bootstrap.bundle.min.js') ?>"></script>
<!-- bs-custom-file-input -->
<script src="<?php url('assets/plugins/admin_template/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php url('assets/js/admin_template/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php url('assets/js/admin_template/demo.js') ?>"></script>
<?php $this->end() ?>