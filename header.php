<?php
    include('account/config.php');
?>

<!DOCTYPE html>
<html lang="en-US">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 
        <?php
            $p = "Home";
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $link = "$_SERVER[REQUEST_URI]";
            $start = strrpos($link, '/') + 1;
            $end = strlen($link);
            $p = substr($link, $start, $end - $start);

            $p = strtoupper(str_replace(".php", "", $p));
            if($p=="index") 
                $p = "Home";
            echo $p;
        ?> 
     - Dashboard</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <!-- fontawesome icon  -->
    <link rel="stylesheet" href="asset/css/fontawesome.min.css">
    <link href="preloader.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="asset/css/slick.css">
    <link rel="stylesheet" href="asset/css/slick-theme.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="asset/css/responsive.css">
    <style>
        .bg-primary-dark {
            background-color: #525e6a !important;
        }
        
        .goog-logo-link {
            display:none !important;
        } 
        
        .goog-te-gadget{
           color: transparent !important;
        }
        
        .goog-te-banner-frame{
            visibility: hidden !important;
            margin-top: -200px !important;
        }
        .goog-te-gadget select{
           font-size: 14px;
           padding: 4px;
           border-radius: 6px;
           text-align: center;
           background:#3268cc;
           color: #fff;
           border: 1px solid #adcc32;
        }
        .goog-te-combo {
            float: right !important;
            margin-right: 5px;
        }
        /* selected link */
        a:hover,
        a:focus,
        a:active {
          border-radius: .25rem !important;
            border: 1px solid #dee2e6 !important;
        }
    </style>
</head>

    <body style="top: 0px;" id="bd" onload='HideLoader()'>

        <script type="text/javascript">
        setTimeout(function () {
              document.getElementById("loader12").hidden = true;
              document.getElementById("loader12").style.display = "none";
        }, 5000);
        //   bd.onload = HideLoader;
          function HideLoader() {
              //alert("das");
              document.getElementById("loader12").hidden = true;
              document.getElementById("loader12").style.display = "none";
              document.getElementById("bd").style = "top:0px; position: relative; min-height: 100%;";
              //document.getElementById("plans").style = "row w3-animate-left";
          }
            function HideNav(ulr) {
                var btnNav = document.getElementById('btnNav');
                btnNav.click(); // this will trigger the click event
                setTimeout(function () {document.location.href = ulr;}, 500);
                
            };
        </script>
        <div class="preloader preloader-alt" id="loader12">
          <div class="justify-content-center">
              <span class="spinner spinner-alt">
          </span>
          </div>
        </div>
        <div class="notification-alert">
            <div class="notice-list">
                
            </div>
        </div>

       
        <div class="mobile-navbar-wrapper">
            <!-- header begin -->
            <div class="header" id="header" style="background: #5e6375;">
                <div class="text-center" style="justify-content: end;display: flex;gap: 0.5em;padding: 0.5em;"> 
                    <button class="navbar-toggler" type="button" id="btnNav">
                        <span class="dag"></span>
                        <span class="dag2"></span>
                        <span class="dag3"></span>
                    </button>     
                </div>
                <div class="bottom pt-0">
                    <div class="">
                        <div class="row justify-content-center">
                            <div class="d-xl-flex d-lg-flex d-block">
                                <div class="d-xl-block d-lg-block d-flex">
                                    <div class="logo">
                                        <a href="index">
                                            <img src="asset/img/logo.png" alt="" style="max-height: 40px;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-10">
                                <!-- <div class="mainmenu" style="background: linear-gradient(-19deg, #8c8c8c 10%, #1a1a1a);"> -->
                                <div class="mainmenu" style="background: #5e6375;" id="mainmenu">
                                    <nav class="navbar navbar-expand-lg nav-light" id="navbarSupportedContent" style="padding: 5px 0;"> 
                                        <div class="collapse navbar-collapse">
                                            <ul class="navbar-nav ml-auto pl-2">
                                                <li class="nav-item  show">
                                                   <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="about">About  </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="contact">Contact</a>
                                                </li>
                                                <?php
                                                    if(isset($_SESSION['Username'])){
                                                        echo '
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="account/dashboard">
                                                                    <i class="fas fa-arrow-right"></i> Dashboard
                                                                </a>
                                                            </li>
                                                        ';
                                                    }else{
                                                        echo '
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="login">Login </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="register">Register</a>
                                                            </li>
                                                        ';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header end -->
