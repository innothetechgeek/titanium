<?php $this->start('head') ?>
<!-- Styles -->
<style>
    html, body {
      background-color: #F9F9F9;
      color: #222;
      font: 14px/1.4 Helvetica, Arial, sans-serif;
      margin: 0;
      padding-bottom: 45px;
    }
    .exception-summary {
      background: #B0413E;
      border-bottom: 2px solid rgba(0, 0, 0, 0.1);
      border-top: 1px solid rgba(0, 0, 0, .3);
      flex: 0 0 auto;
      margin-bottom: 30px;
    }
    .exception-message, .exception-message a {
      color: #FFF;
      font-size: 21px;
      font-weight: 400;
      margin: 0;
    }
    .container {
      max-width: 1024px;
      margin: 0 auto;
      padding: 0 15px;
    }
    .exception-message {
      flex-grow: 1;
      display: inline;
    }
    .content {
        text-align: center;
    }
    .exception-illustration {
    flex-basis: 111px;
    flex-shrink: 0;
    margin-left: 15px;
    opacity: .7;
}
.hidden-xs-down{
  display: inline;
  float: right;
  margin-top: -15px;
}
.hidden-xs-down i{
  color: #fff;
  font-size: 59px;
}
.exception-message-wrapper{
  padding:30px; 0px;
}
</style>
<?php $this->end() ?>

<?php $this->start('body') ?>
      <div class="exception-summary">
          <div class="container">
              <div class="exception-message-wrapper">
                  <h1 class="break-long-words exception-message">Sorry, the page you are looking for could not be found.</h1>
                  <div class="exception-illustration hidden-xs-down">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  </div>
              </div>
          </div>
      </div>
<?php $this->end() ?>
