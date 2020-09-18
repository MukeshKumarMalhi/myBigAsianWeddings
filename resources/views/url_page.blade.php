<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="RTzFOMYRDI36WBVX8x4p9BA5IYylxG2C1WNTujuO" />
    <meta name="userId" content="">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>myBigAsianWedding | Wedding planner</title>

    <!-- Latest compiled and minified CSS -->
    <meta name="theme-color" content="#533063">
    <link rel="shortcut icon" href="http://127.0.0.1:8000/web_asset/images/favicon.png" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" href="http://127.0.0.1:8000/web_asset/images/favicon.png">
    <meta name="msapplication-TileImage" content="http://127.0.0.1:8000/web_asset/images/favicon.png">

    <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/web_asset/vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/web_asset/vendor/animate3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/web_asset/vendor/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/web_asset/vendor/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/css/app.css">
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/web_asset/css/custom-style.css">
    <script type="text/javascript" src="http://127.0.0.1:8000/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/web_asset/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/web_asset/vendor/jqueryvalidate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/web_asset/vendor/owlcarousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/web_asset/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1:8000/web_asset/js/js-custom.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
</head>

  <!-- Page Content -->
  <!-- Navbar links -->
  <div id="wrapper" class="dashboard-page closed">
      <!-- Page Content -->
      <div class="page-content-wrapper" style="margin-left: 0px;">
              <div class="pt-r10 bg-center-url bg-dark" style="background-image: url('web_asset/images/bg-home.png');">
                  <div class="container bs-search-form text-center link-light text-light py-80">
                      <h2 class="font-weight-bold mb-2 font-playfairdisplay groom_bride" style="display: inline;">{{ ($user->name == "" || $user->partner_name == "" ? "Your Wedding" : $user->name." & ".$user->partner_name) }} </h2>
                      <?php
                      ?>
                      <h5>{{ ($user->weeding_date == "" && $user->location_id == "" ? "No wedding date and location yet" : '') }}</h5>
                      <!-- <h5 class="weeding_date_ajax">{{ ($user->weeding_date == "" ? "No weeding date yet" : $user->weeding_date) }}</h5> -->
                      <h5 class="mb-3 location_change">{{ ($user->location_id == "" ? "No wedding location yet" : $user->location_name) }}</h5>
                      <h5 style="font-size: 16px;" class="weeding_days_count_ajax">{{ ($user->weeding_date == "" ? "No weeding date yet" : $user->weeding_date) }} <i class="fa fa-heart" aria-hidden="true"></i> {{ ($user->weeding_date == "" ? "" : $user->weeding_days_remaining." days to go!") }}</h5>
                  </div>
              </div>
              <div class="container py-4" style="max-width:800px;">
                <div class="row mb-2">
                  <div class="col-md-6">
                    <h5 style="font-size: 16px; font-weight: 600;">Our Wedding Progress</h5>
                  </div>
                  <div class="col-md-6">
                    <h5 style="font-size: 16px; font-weight: 600;">Our Venue</h5>
                  </div>
                </div>
                <div class="row no-gutters-10 text-center">
                  <div class="col-6">
                    <div class="row">
                      <div class="col-6 col-md-4 col-lg">
                        <div class="bg-light p-3 mb-3">
                          <img src="web_asset/images/checklist-icon.png" class="img-fluid m-auto">
                          <h3 class="font-weight-bold font-playfairdisplay">Checklist</h3>
                          <div class="bs-white-box-button"><a href="#">0% complete <i class="far fa-chevron-double-right"></i></a></div>
                        </div>
                      </div>
                      <div class="col-6 col-md-4 col-lg">
                        <div class="bg-light p-3 mb-3">
                          <img src="web_asset/images/budget-icon.png" class="img-fluid m-auto">
                          <h3 class="font-weight-bold font-playfairdisplay">Budget</h3>
                          <div class="bs-white-box-button"><a href="#">Get started <i class="far fa-long-arrow-right"></i></a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
      </div>
  </div>
  <style type="text/css">
    .underline-on-hover{cursor: pointer;}
    .underline-on-hover:hover span{text-decoration: underline;}
    .step3 .typeahead.dropdown-menu a.dropdown-item::first-line,.step3 .typeahead.dropdown-menu a.dropdown-item:first-line {white-space: pre-line; line-height:23px;color:#000000;}
    .step3 .typeahead.dropdown-menu a.dropdown-item{white-space: pre-line; line-height:23px;color:#8a8484;}
    .btn.btn-success{background-color:#2dbaa7 !important; border-color: #2dbaa7 !important;}
    .btn.btn-success:hover{background-color:#57c8b9 !important; border-color: #2dbaa7 !important;
      border-bottom: solid rgb(118, 128, 140) 4px; padding-top: 5px !important}
      .form-control{
        border-radius: 5px;
      }
      .card.help-up.fixed-bottom{
          z-index:9999;
          padding-right: 0px !important;
      }
      .card.help-up.fixed-bottom {width:330px;right:15px;left:auto;bottom:-600px;transition-duration: 250ms;transition-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);transition-property: opacity, top, bottom;}
      .card.help-up.fixed-bottom .card-content{height: 420px;}

      .card.help-up.fixed-bottom.active {bottom:0px;}
      .card.help-up.fixed-bottom .card-content{height: 420px;}

      .card.help-up .bg-primary,.card.help-up .btn.btn-primary{background-color: rgb(83, 125, 215) !important;color: rgb(255, 255, 255) !important;border-color: rgb(83, 125, 215) !important;}
      .card-header:first-child {
          border-radius: calc(0.75rem - 1px) calc(0.75rem - 1px) 0 0;
      }
      .heading_color{
        background-color: rgb(83, 125, 215) !important;
        color: rgb(255, 255, 255) !important;
        border-color: rgb(83, 125, 215) !important;
      }
  </style>
