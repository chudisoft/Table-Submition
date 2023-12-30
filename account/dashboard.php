
<?php
    include("config.php");
    $SearchString = ""; $successMessage = ""; $errorMessage = ''; $fetchedResult; $user = "";
    $TReferredUsers = 0; $Username = "";

    include("me.php");    
    include("header.php");
    
    if(isset($_SESSION["Username"])){
        
        if($_SESSION["Role"] == "Admin"){
            $IdR = "Defualt";
        }
    }
?>

<style>
    .card-dashboard {
        margin: 5px;
        padding: 25px 5px 25px 5px;
        border: solid;
        border-radius: 10px;
        min-width: 320px;
        max-width: 420px;
        text-align: center;
    }

    .primary-bg {
        background-image: linear-gradient(to right, #24b8fb, #648291);
        color: #fff;
    }

    .secondary-bg {
        background-image: linear-gradient(to right, #464a4d, #63d3ff);
        color: #fff;
    }

    .info-bg {
        background-image: linear-gradient(to right, #9b2c2c, #4a4d4d);
        color: #fff;
    }

    .warning-bg {
        /* background-image: linear-gradient(to right, #ffa011, #a6e101); */
        background-image: linear-gradient(to right, #f11, #016ee1);
        color: #fff;
    }

    .success-bg {
        background-image: linear-gradient(to right, #00b03b, #586d5a);
        color: #fff;
    }
    .t-Light{
        color: #d4dbe1 !important;
    }
</style>
<div class="">
    <div class="bg-light text-center">
        <h3 class="text-primary text-center">Welcome <?php echo $Username; ?></h3>
        <hr/>
    </div>
    <div class="col-12 mt-2 justify-content-left ml-0 pl-0">
        <div class="col-md-3 mb-5 card p-4">
                    <?php
                    include('../table-record.php');
                    ?>
                </div>
    </div>

    <?php
        include("footer.php");
    ?>
</div>