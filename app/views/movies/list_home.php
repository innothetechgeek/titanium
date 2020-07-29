<?php $this->start('head') ?>
<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 78vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
<?php $this->end() ?>

<?php $this->start('body') ?>
<?php include(ROOT . DS . 'app' . DS . 'views'. DS .'layouts'. DS .'main_menu.php') ?>
<div class="flex-center position-ref" style="padding-top: 35px">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cool Movies</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?=$this->rows_found?> movies
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <style>
                                            .pagination .active{
                                                background: #007bff;
                                            }
                                        </style>
                                        <?= $this->pagination_links; ?>
                                    </ul>
                                </h3>
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
                                    $offset = $this->offset+1;
                                    foreach ($movies as $movie){ ?>
                                        <tr>
                                            <td><?=$offset?>.</td>
                                            <td><?=$movie['mv_title']?></td>
                                            <td>
                                                <?= format_date('d F Y',$movie['mv_year_released']) ?>
                                            </td>
                                            <td>_</td>
                                        </tr>
                                    <?php $offset++; } ?>
                                    </tbody>
                                </table>
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
<?php $this->end() ?>
