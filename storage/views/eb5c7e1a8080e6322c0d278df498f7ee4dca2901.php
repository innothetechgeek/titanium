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
                        <ul class="pagination pagination-sm m-0 float-right">
                            <style>
                                .pagination .active{
                                    background: #007bff;
                                }
                            </style>
                            <?= $this->pagination_links; ?>
                        </ul>
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
                                    <td><?=$movie['genres']?></td>
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
<!-- jQuery -->
<script src="<?php url('plugins/admin_template/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php url('assets/plugins/admin_template/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php url('assets/plugins/admin_template/toastr/toastr.min.js') ?>"></script>
<script src="<?php url('assets/plugins/admin_template/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- bs-custom-file-input -->
<script src="<?php url('assets/plugins/admin_template/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php url('assets/js/admin_template/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php url('assets/js/admin_template/demo.js') ?>"></script>
<?php   if($this->movie_added){ ?>
<script>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    Toast.fire({
        type: 'success',
        title: ' Movie Successfully added!.'
    })});
</script>
<?php } ?>