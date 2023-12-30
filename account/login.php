<?php
            //echo '3'; return;
    include('config.php');
	if(isset($_POST['Username']) && isset($_POST['Password'])){
		
		$username = validate($conn, $_POST['Username']);
		$password = validate($conn, $_POST['Password']);
		$salt = $password.'bn54bnxys367jd23007';
	    $pass_by = md5($salt);
        //echo $username . " " . $password . " " . $pass_by;
        if($username == '' || $password == ''){
            echo '3';
        }else{
            $qv = $conn->query("SELECT * FROM `users` WHERE `Password`= '$pass_by' AND 
                    (`Username`='$username' Or `Email`='$username')");
            session_destroy();session_start();
            $r = mysqli_fetch_array($qv);
            $active = $r['Active'];
            $e = $r['Email'];
            $Role = $r['Role'];
            if(mysqli_num_rows($qv) >= 1){
                if($active == 1){
                    $_SESSION['Email'] = $e;
                    $_SESSION['Username'] = $username;
                    $_SESSION['Role'] = $Role;
                    echo '1';
                    if($Role != "Admin"){
                        mail($AdminEmail, "Successful Login", $username . " (" . $e . "), <div class='text-success'>Just logged in to " .$SiteName,$headers);
                    }
                }else{
                    echo '2';
                }
                
            }else{
                echo '3';                
            }
        }
    }
?>
