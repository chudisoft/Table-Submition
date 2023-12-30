
        <!-- footer begin -->
        <div class="footer">
            <div class="footer-top">
                <div class="container text-white">
                    <div class="footer_main_wrapper float_left  mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wrapper_second_about">
                                    <div class="wrapper_first_image">
                                        <a href="index">
                                            <img src="logo.png" class="img-responsive img-thumbnail" alt="logo"
                                                style="max-width: 100px;"
                                            >
                                        </a>
                                    </div>
                                    <!-- <p>.com is a .</p> -->
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="wrapper_second_useful">
                                    <h4>Useful Links </h4>
                                    <div class="row">
                                        <div class="m-2">
                                            <ul>
                                                <li><a href="index"><i class="fa fa-angle-right"></i>Home</a>
                                                </li>
                                                <li><a href="about"><i class="fa fa-angle-right"></i>About us</a>
                                                </li>
        
                                                <li><a href="contact"><i class="fa fa-angle-right"></i>Contact </a>
                                                </li>
                                                <li><a href="login"><i class="fa fa-angle-right"></i>Account</a> </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="wrapper_second_useful wrapper_second_useful_2">
                                    <h4>Contact  us</h4>

                                    <ul>
                                        <li hidden><i class="fab fa-whatsapp text-success mr-2"></i><a href="https://wa.me/8160274007">+2348160274007</li>
                                        <li><i class="fa fa-envelope text-primary mr-2"></i><?php echo $SiteEmail ?></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-globe text-primary mr-2"></i><?php echo $SiteURL ?></a>
                                        </li>

                                        <li><i class="flaticon-placeholder"></i>2 Pavilion Court, 60 Pavilion Drive, Northampton, Northants, United Kingdom, NN4 7SL</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="copyright-area">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-8">
                                <p>Copyright © <span href="index" class="text-white"><?php echo $SiteName ?></span> - 2023. All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer end -->
        </div>
        <!-- mobile navbar wrapper end -->

        <div class="d-xl-none d-lg-none d-block">
            <div class="mobile-navigation-bar">
                <ul>
                    <li>
                        <a href="/" class="btn-sm btn-primary shadow border-bottom border-bottom-4">
                            <span alt="" class="fa fa-home h6 text-white"></span>
                        </a>
                    </li>
                    <li>
                        <a href="/login" class="btn-sm btn-primary shadow border-bottom border-bottom-4">
                            <span alt="" class="fa fa-user h6 text-white"></span>
                        </a>
                    </li>
                    <li>
                        <a href="/register" class="btn-sm btn-primary shadow border-bottom border-bottom-4">
                            <span alt="" class="fa fa-user-plus h6 text-white"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#header" class="d-block d-xl-none d-md-none btn-sm btn-primary shadow border-bottom border-bottom-4">
                            <img src="asset/img/svg/arrow.svg" alt="" style="max-height: 23px;">
                        </a>
                    </li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>

        <div class="d-xl-block d-lg-block d-none">
            <div class="back-to-top-btn">
                <a href="#">
                    <img src="asset/img/svg/arrow.svg" alt="">
                </a>
            </div>
        </div>
        <!-- jquery -->
        <script src="asset/js/jquery.js"></script>
        <!-- popper js -->
        <script src="asset/js/popper.min.js"></script>
        <!-- bootstrap -->
        <script src="asset/js/bootstrap.min.js"></script>
        <!-- slick js -->
        <script src="asset/js/slick.min.js"></script>
        <!-- toastr js -->
        <script src="asset/js/toastr.min.js"></script>
        

        <script>
            $("#btnNav").on("click", function() {
                $('#mainmenu').toggleClass('mainmenu');
                $('#navbarSupportedContent').toggleClass('collapse');
            })
            $(document).ready(function() {
                // $("[href]").each(function() {
                //     if (this.href.split("?")[0] == window.location.href.split("?")[0]) {
                //         $(this).addClass("active");
                //     }
                // });
            });
            function changeValue(i, rate,val) {
                var minAmount = document.getElementById("profit" + i);
                var maxAmount = document.getElementById("Treturn" + i);
                var valBox1 = document.getElementById("val" + i);
                var profit = (val * rate / 100).toFixed(2);
                var profit2 = (val * rate / 100);
                //alert(val + "," + profit2);
                profit2 = Number(profit2) + Number(val);
                profit = formatMoney(profit, 2, ".", ",");
                profit2 = formatMoney(profit2, 2, ".", ",");
                minAmount.innerHTML = profit;
                maxAmount.innerHTML =profit2;
                valBox1.innerHTML = formatMoney(val, 2, ".", ",");
                
                
                var x = document.getElementsByClassName("Treturn" + i);
                var y = document.getElementsByClassName("profit" + i);
                var z = document.getElementsByClassName("val" + i);
                var i;
                for (i = 0; i < x.length; i++) {
                x[i].innerHTML = profit2;
                //console.log(profit2);
                }
                for (i = 0; i < x.length; i++) {
                y[i].innerHTML = profit;
                }
                for (i = 0; i < x.length; i++) {
                z[i].innerHTML = formatMoney(val, 2, ".", ",");
                }
                //alert(i);
                //alert(valBox1.innerText);
            }
            function formatMoney(number, decPlaces, decSep, thouSep) {
                decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSep = typeof decSep === "undefined" ? "." : decSep;
                thouSep = typeof thouSep === "undefined" ? "," : thouSep;
                var sign = number < 0 ? "-" : "$";
                var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
                var j = (j = i.length) > 3 ? j % 3 : 0;

                return sign +
                (j ? i.substr(0, j) + thouSep : "") +
                    i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
                    (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
            }
            function checkform(btn) {
                if (document.mainform.name.value == '') {
                    alert("Please type your full name!");
                    document.mainform.name.focus();
                    return false;
                }
                if (document.mainform.email.value == '') {
                    alert("Please enter your e-mail address!");
                    document.mainform.email.focus();
                    return false;
                }
                if (document.mainform.message.value == '') {
                    alert("Please type your message!");
                    document.mainform.message.focus();
                    return false;
                }
        
        
                formData = {
                    Names: names.value,
                    Email: email.value,
                    Body: message.value
                };
                btn.disabled = true;
                btn.Title = "Processing....";
                $.post("account/email", formData,
                    function (data, status) {
                        //alert("Data: " + data + "\nStatus: " + status);
                        if (status == "success") {
                            msgBox.innerHTML = data;
                        } else {
                            alert("Unable to post data... Check your network!");
                        }
                        //document.getElementById("bodyContent").innerHTML = data;
                        //alert(data);
                        btn.Title = "Ready";
                        btn.disabled = false;
                    }
                );
                return true;
            }
            const validateEmail = (email) => {
                return String(email)
                    .toLowerCase()
                    .match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
            };
        </script>
        
    </body>
</html>