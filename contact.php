<?php
    include('header.php');
?>
            <!-- contact begin -->
            <div class="contact contact-page" id="contact">
                <div class="container container-contact">
                    
        <!-- contact begin -->
        
            <div class="row" id="support">
                <div class="col-md-6 left-support">
                    <h2 class="title">
                        <span class="pink">
                        <abbr>O</abbr>ur
                        </span>
                        Contacts:
                    </h2>
                    <div class="contacts">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:<?php echo $SiteEmail ?>">
                        <?php echo $SiteEmail ?>
                        </a>
                        
                        <div>
                            <i class="fab fa-whatsapp text-success"></i>
                            <a href="https://wa.me/2348160274007">
                                +2348160274007
                            </a>
                        </div>
                        <div>
                            <i class="fa fa-map-marker-alt icon-location"></i>
                            Representative office in Australia:
                        </div>
                        
                    </div>
                    <div class="">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4758.7877275033225!2d-1.478087!3d53.389894!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4879788836cbf5fb%3A0xf6b6b18d515ef85e!2sThe%20House%20Skate%20Park!5e0!3m2!1sen!2sid!4v1703869667834!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-6 form p-2">
                    <h2 class="title">
                        <span class="yellow">
                        <abbr>F</abbr>eedback
                        </span>
                        Form
                    </h2>
                    <div class="row text-center">
                        <p class="lh-lg">
                            Feel free to contact our team to get you started and/or attend your questions quickly.
                        </p>
                    </div>
                    <hr/>
                    <form action="#" class="row" method="post" name="mainform" onsubmit="return checkform()">
                        <div class="col-lg-12 col-md mb-3">
                            <input type="text" placeholder="Your Names" id="names" class="shadow form-control form-control-lg">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="email" placeholder="Email address" id="email" class="shadow form-control form-control-lg">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <textarea name="message" placeholder="Message" id="message" rows="8" class="shadow form-control form-control-lg"></textarea>
                        </div>
                        <div class="text-center col-12 mt-1">
                            <button type="button" class="btn btn-primary w-100" 
                                onclick="checkform(this)">
                                submit
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <!-- contact end -->
                </div>
            </div>
            <!-- contact end -->

<?php
    include('footer.php');
?>