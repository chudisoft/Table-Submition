<div class="text-center m-4" hidden>
    <a href="index" ><img class="auth__logo img-fluid" 
        src="logo.png" alt="logo"> 
    </a>
</div>
<div class="card p-0">
    <h1 class="text-center card-header">User Login</h1>
    <div class="card-body p-2">
        <input type="hidden" name="_token" value="rUqlg3fBSBMyLpqnquAHcmZ373Kt9ziPaheNxFcc"> 
        
        <div class="form-group ">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name ="username" value="" id="username" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-center form-group">
            <button onclick="Login(this)" class="btn btn-primary w-50" type="submit"><i class="fa fa-paper-plane mr-2"></i>Login</button>
        </div>

        <div class="text-center mb-3">
            <p class=" text-center mb-2">Forgot your Password? <a href="forgot-password" class="link ml-1">Reset.</a> </p>
            <p class=" text-center">Dont have an Account yet? <a href="register" class="link ml-1">Sign up.</a> </p>
        </div>
    </div>
</div>
<script language=javascript>
    function Login(btn) {
        if (username.value=='') {
            alert("Please type your username!");
            username.focus();
            return false;
        }
        if (password.value=='') {
            alert("Please type your password!");
            password.focus();
            return false;
        }
        var  Password= $('#password').val();
        var Username = $('#username').val();
        $(".submit").attr("disabled",true);
        console.log(Password);
        console.log(Username);
        var formData = {
            Username: Username,
            Password: Password,
            Remember: true
        };
        //console.log(formData);
        var oldClass = btn.children[0].className;
        btn.children[0].className = "fa fa-spinner fa-spin mr-2";
        $.ajax({
            url: 'account/login.php',
            type: 'post',
            data: formData,
            beforeSend:function(){
                $('.submit').html('Please wait..');
                setTimeout(function(){
                    $('.submit').html('Authenticating..');
                }, 300);
                        
            },
            success: function(data) {
                //alert(data); 
                if(data == 1){
                    //setTimeout(function(){
                        window.location = 'account/dashboard';
                        //window.location = 'success';
                    //}, 200);
                    //alert("Successful login");
                }else if(data == 2){                                
                    alert('Inactive User!');
                }else{
                    alert('Invalid Username or Password!');
                }
                $(".submit").removeAttr("disabled",true);
                $('.submit').html('Log In');
                btn.children[0].className = oldClass;
                        
            } 
        });   
                
    };

</script>