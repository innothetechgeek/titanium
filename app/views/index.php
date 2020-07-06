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
<?php include('layouts/main_menu.php') ?>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Welcome to Titanium
        </div>
        <div class="title m-b-md" style="font-size:35px;">
            Theee Best PHP Framework Ever!
        </div>
        <div class="alert alert-info" role="alert" style="margin-top:5px;">

            Don't try to break the framework :( , this is only the beta version!
        </div>
        <div class="links">
            <a target="_blank" href="http://www.tapandsell.co.za/thebookoflife" ?>"Documentation</a>
            <a target="_blank" href="https://github.com/innothetechgeek/titanium">GitHub</a>
        </div>
    </div>
</div>
<?php $this->end() ?>
