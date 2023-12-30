<?php
include('header.php');
?>
<div class="d-flex flex-column h-100 auth-page">
    <!-- ======= Loginup Section ======= -->
    <section class="auth pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center user-auth mb-5">
                <?php
                    include('login_form.php');
                ?>
            </div>
        </div>
    </section>
</div>

<?php
include('footer.php');
?>