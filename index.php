<?php
include('header.php');

if (isset($_GET['ref'])) {
    $_SESSION['ref'] = $_GET['ref'];
} elseif (isset($_POST['ref'])) {
    $_SESSION['ref'] = $_POST['ref'];
}

?>

<!-- banner begin -->
<div class="banner">
    <div class="container">
        <div class="row justify-content-xl-between justify-content-lg-between justify-content-md-center justify-content-sm-center">
            <div class="col-md-8 align-items-center d-banner-tamim">
                <div class="banner-content pb-2">
                    <h4>Welcome to <?php echo $SiteName ?></h4>
                    <h2 class="gold">Quickly track your order deliveries.</h2>
                    <p>Select a table number and submit to register the time of order delivery.</p>
                    <a href="register" class="btn btn-primary border">Create New Account</a>
                </div>
            </div>
            <div class="col-md-3 mb-5 card p-4">
                <?php
                include('table-record.php');
                ?>
            </div>
        </div>
    </div>
</div>
<!-- banner end -->
</div>

<?php
include('footer.php');
?>