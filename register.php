<?php
    include('header.php');
    $ref = "";
    if(isset($_GET['ref'])){
        $ref = $_GET['ref'];
    }elseif(isset($_POST['ref'])){
        $ref = $_POST['ref'];
    }elseif(isset($_SESSION['ref'])){
        $ref = $_SESSION['ref'];
    }
    $country = ip_info("Visitor", "Country");
?>
    <!-- ======= signup Section ======= -->
    <section class="auth pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center user-auth pt-5">
                <div class="col-md-4">
                    <div class="text-center m-4" hidden>
                        <a href="index" ><img class="auth__logo img-fluid" 
                            src="logo.png" alt="logo"> 
                        </a>
                    </div>
                    <div class="card p-0">
                        <h1 class="text-center card-header">Create an Account</h1>
                        <div class="card-body p-2">
                            <input type="hidden" name="_token" value="rUqlg3fBSBMyLpqnquAHcmZ373Kt9ziPaheNxFcc"> 
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter full Name">
                            </div>

                            <div class="form-group ">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group ">
                                <!-- <div class="row"> -->
                                    <!-- <div class="col-3 pr-0">
                                        <label for="phone">Code</label>
                                        <input type="text" class="form-control" name="countryCode" id="countryCode" placeholder="+" disabled>
                                    </div> -->
                                    <!-- <div class=" col-9 pl-0"> -->
                                    <div class="pl-0">
                                        <label for="phone">Phone Number</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id       ="addonPhone"><i class="fa fa-phone"    ></i></span>
                                            </div>
                                            <input type="number" class="form-control" aria-label="Username" aria-describedby="addonPhone" name="phone" value="" id="phone" placeholder="Enter Phone number">
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <div class="form-group">
                                <label for="referee">Referee</label>
                                <input type="text" class="form-control" placeholder="Referee (Optional)" name=referee id=referee value='<?php echo $ref; ?>'>
                            </div> -->
                            <div class="form-group">
                                <input type="checkbox" name="agree" id="agree" checked />
                                <span class="col-11 h6">I agree to <a href="/terms">terms</a> of service.</span>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="text-center form-group">
                                <button onclick="Register(this)" class="btn btn-primary w-50" type="submit"><i class="fa fa-paper-plane mr-2"></i>Register</button>
                            </div>
    
                            <div class="text-center mb-3">
                                <p class=" text-center mb-2">Already have an Account  <a href="login">Login.</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script language=javascript>
        
         function Register(btn) {
            if (fullname.value == '') {
                alert("Please enter your full name!");
                fullname.focus();
                return false;
            }
            if (password.value == '') {
                alert("Please enter your password!");
                password.focus();
                return false;
            }
            if (password.value != confirm_password.value) {
                alert("Please check your password!");
                confirm_password.focus();
                return false;
            }
            if (email.value == '' || !validateEmail(email.value)) {
                alert("Please enter a valid email address!");
                email.focus();
                return false;
            }
        
            if (agree.checked == false) {
                alert("You have to agree with the Terms and Conditions!");
                return false;
            }
        
            var formData = {
                Username: email.value,
                Password: password.value,
                Email: email.value,
                Names: fullname.value,
                // Ref: referee.value,
                // Address: country.value,
                Address: 'N/A',
                Phone: phone.value,
                Agreed: agree.checked
            };
            var oldClass = btn.children[0].className;
            btn.children[0].className = "fa fa-spinner fa-spin mr-2";
            $.ajax({
                url: 'account/register.php',
                type: 'post',
                data: formData,
                beforeSend:function(){
                    $("#submit").attr("disabled",true);
                    $('#submit').html('Please wait.....');
                },
                success: function(data) {
                    if(data == 1){                                
                        alert('Email Already exist');
                        //$("#email").css("border-color", "red");
                    }else if(data == 2){                                
                        alert('Username Already exist');
                        //$("#email").css("border-color", "red");
                    }else if(data == 3){
                        //$('#msg').html('<div class="alert alert-success"></div>');
                        setTimeout(function(){
                            window.location = "login.php";
                        }, 200);
                        alert("Success!, Registration was Successful. Redirecting....");
                    }else if(data == '4'){
                        alert('Check internet connection');
                    }else{
                        alert(data);
                    }
                    $("#submit").removeAttr("disabled",true);
                    $('#submit').html('');
                    btn.children[0].className = oldClass;
                } 
            });
            return true;
        }
        
         function IsNumeric(sText) {
          var ValidChars = "0123456789";
          var IsNumber=true;
          var Char;
          if (sText == '') return false;
          for (i = 0; i < sText.length && IsNumber == true; i++) { 
            Char = sText.charAt(i); 
            if (ValidChars.indexOf(Char) == -1) {
              IsNumber = false;
            }
          }
          return IsNumber;
         }
        </script>
    </section>
    <?php
    include('footer.php');
?>