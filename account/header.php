<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>
        <?php
            $p = "DashBoard";
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $link = "$_SERVER[REQUEST_URI]";
            $start = strrpos($link, '/') + 1;
            $end = strlen($link);
            $p = substr($link, $start, $end - $start);

            if(isset($_SESSION['Username']))
            {
                if(isset($_GET["Plan"])){
                    $pPlan = $_GET["Plan"];
                }
                if(isset($_GET["Amount"])){
                    $pAmount = $_GET["Amount"];
                }
                
            }
            $p = strtoupper(str_replace(".php", "", $p));
            echo $p;
        ?> 
    - <?php echo $SiteName ?></title>

    <!-- Site favicon -->
    <link rel="icon" type="image/png" href="../favicon.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../DBoard/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../DBoard/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../DBoard/vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="../DBoard/dboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- <link href="..assets/css/main.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../asset/css/font-awesome.css" rel="stylesheet" />
    <script src="../asset/js/fontawesome.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="../DBoard/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../DBoard/src/plugins/datatables/css/responsive.bootstrap4.min.css"> -->
    
    <style>
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
        body{
            top: 0 !important;                    
        }
        .goog-te-gadget select{
            font-size: 19px;
            padding: 4px;
            border-radius: 6px;
            text-align: center;
            background:#32B30E;
            color: #fff;
            border: 1px solid #cc326e;
        }
        /* selected link */
        a:active {
          color: white;
        }
	</style>
        <script type="text/javascript">
          function HideLoader() {
              document.getElementById("loader").hidden = true;
              //document.getElementById("plans").style = "row w3-animate-left";
          }
          window.onload = HideLoader;
        </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link href="dboard.css" rel="stylesheet" id="bootstrap-css">
    
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <link href="../preloader.css" rel="stylesheet" type="text/css">
        
</head>

<body style="padding-top:unset">
    <div class="pre-loader bg-secondary" id="progress_div">
        <div class="preloader preloader-alt no-split" id="loader">
          <span class="spinner spinner-alt">
              <img hidden class="spinner-brand" src="images/tenor.gif" alt="">
          </span>
            <!-- <div class="loader-logo"><img src="../asset/img/logo.png" alt=""></div> -->
        </div>
    </div>

    <div class="text-white header" style="background-color:rgb(0, 0, 0)">
        <a href="../"  class="d-block d-md-none">
            <img src="../asset/img/logo.png" alt="" class="light-logo" style="max-width:3em; margin-top: 0.5em; margin-left: 0.2em;">
        </a>
        <div class="header-right col-9 col-md-11">
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown" onclick="deleteNotification();">
                        <i class="icon-copy dw dw-notification" id="msgNotArea"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll" id="msgNotAreaP" style="overflow: auto;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon fa fa-user">
                            <img src="../DBoard/vendors/images/photo1.jpg" alt="" hidden>
                        </span>
                        <span class="text-white user-name">
                            <?php
                                echo $_SESSION['Username'];
                            ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="update">
                            <i class="dw dw-user1"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#"><i class="dw dw-settings2"></i> Setting</a>
                        <a class="dropdown-item" hidden href="#" onclick="document.location = '../contact.php'">
                            <i class="dw dw-help"></i> Help
                        </a>
                        <a class="dropdown-item" href="logout"><i class="dw dw-logout"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
    include("sidebar.php");
?>


    <div class="main-container">
        <div class="">
            <div class="">
                <div id="bodyContent">
