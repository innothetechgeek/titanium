<?php $__env->startSection('content'); ?>
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
                                <h3 class="card-title"><?=$rows_found?> movies
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <style>
                                            .pagination .active{
                                                background: #007bff;
                                            }
                                        </style>
                                        <?= $pagination_links; ?>
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
                                    $movies = $movies;
                                    $offset = $offset+1;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', [], 'C:\wamp64\www\titanium\app\views\layouts/master.php'); ?>