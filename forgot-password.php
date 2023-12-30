<?php
    include('header.php');
?>
<div class="d-flex flex-column h-100 auth-page">
    <!-- ======= Loginup Section ======= -->
    <section class="auth pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center user-auth">
                <div class="col-md-4">
                    <div class="text-center m-4" hidden>
                        <a href="index" ><img class="auth__logo img-fluid" 
                            src="logo.png" alt="logo"> 
                        </a>
                    </div>
                    <div class="card p-0">
                        <h1 class="text-center card-header">Forgot Password</h1>
                        <div class="card-body p-2">
                            <input type="hidden" name="_token" value="rUqlg3fBSBMyLpqnquAHcmZ373Kt9ziPaheNxFcc"> 
                            
                            <div class="form-group ">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" name ="username" value="" id="username" placeholder="name@example.com" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center form-group">
                                <button onclick="ResetPassword(this)" class="btn btn-primary" type="submit"><i class="fa fa-paper-plane mr-2"></i>Reset My Password</button>
                            </div>
    
                            <div class="text-center mb-3">
                                <p class=" text-center mb-2">Already have account <a href="login" class="link ml-1">Login.</a> </p>
                                <p class=" text-center">Dont have an Account yet? <a href="register" class="link ml-1">Sign up.</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script language=javascript>
            function ResetPassword(btn) {
                if (username.value=='') {
                    alert("Please type your username!");
                    username.focus();
                    return false;
                }
                var Username = $('#username').val();
                $(".submit").attr("disabled",true);
                console.log(Username);
                var formData = {
                    Username: Username
                };
                //console.log(formData);
                var oldClass = btn.children[0].className;
                btn.children[0].className = "fa fa-spinner fa-spin mr-2";
                $.ajax({
                    url: 'account/resetpassword.php',
                    type: 'post',
                    data: formData,
                    beforeSend:function(){
                        $('.submit').html('Please wait..');
                        setTimeout(function(){
                            $('.submit').html('Authenticating..');
                        }, 300);
                                
                    },
                    success: function(data) {
                        alert(data); 
                        $(".submit").removeAttr("disabled",true);
                        $('.submit').html('Log In');
                                
                    } 
                });   
                btn.children[0].className = oldClass;
                        
            };

        </script>
    </section>
</div>

<?php
    include('footer.php');
?>