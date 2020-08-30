<?php  ?>
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
                        <h1>Add Movie</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6 offset-md-1">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Movie Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action ="add" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" id="mv_title" name = "mv_title" placeholder="movie title">
                                    </div>
                                    <div class="form-group">
                                        <label>Genre</label>
                                        <select class="select2" name = "genres[]" multiple="multiple" data-placeholder="Select movie Genre" style="width: 100%;">
                                             <?php
                                           foreach ($this->genres as $id=>$genre)  { ?>
                                            <option value="<?=$genre['gnr_id']?>"><?=$genre['gnr_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Release Date:</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name = "mv_year_released" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- jQuery -->
    <script src="<?php url('plugins/admin_template/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php url('assets/plugins/admin_template/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- InputMask -->
    <script src="<?php url('assets/plugins/admin_template/moment/moment.min.js') ?>"></script>
    <script src="<?php url('assets/plugins/admin_template/inputmask/min/jquery.inputmask.bundle.min.js') ?>"></script>

    <!-- Select2 -->
    <script src="<?php url('assets/plugins/admin_template/select2/js/select2.full.min.js') ?>"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php url('assets/plugins/admin_template/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php url('assets/plugins/admin_template/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php url('assets/plugins/admin_template/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')?>">
    <!-- bs-custom-file-input -->
    <script src="<?php url('assets/plugins/admin_template/bs-custom-file-input/bs-custom-file-input.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php url('assets/js/admin_template/adminlte.min.js') ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php url('assets/js/admin_template/demo.js')?>"></script>
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            $('[data-mask]').inputmask()


        })
    </script><script src="http://<?= $_SERVER['HTTP_HOST']?>/titanium/assets/js/admin_template/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
<script>

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
</script>

<?php echo '' ?>