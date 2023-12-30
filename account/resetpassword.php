<?php
    include('config.php');
	if(isset($_POST['Username'])){
	    $username = $_POST['Username'];
        if($username == ''){
            echo 'Username is required!';
        }else{
            $username = validate($conn, $username);
            $qv = $conn->query("SELECT * FROM `users` WHERE (`Username`='$username' Or `Email`='$username')");
            $r = mysqli_fetch_array($qv);
            $active = $r['Active'];
            $e = $r['Email'];
            $username = $r['Username'];
            $Role = $r['Role'];
            if(mysqli_num_rows($qv) >= 1){
                if($active == 1){
                    $_SESSION['Username'] = $username;
                    $_SESSION['Email'] = $e;
                    $guid = GUID();
                    $_SESSION['guid'] = $guid;
                    $stmt = "update `users` set `ResetCode` = '$guid' WHERE `Username`='$username'";
                    
                    if ($conn->query($stmt) === TRUE) {
                    } else {
                        die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                        return;
                    }
                    echo 'Check your email for your Password Reset Code.';
                    mail($e, "Password Reset", "<a href='".$SiteURL."/resetpassword2.php?Username=$username&code=$guid'>Click here to reset your password " .$SiteName."</a>",$headers);
                    if($Role != "Admin"){
                    }
                }else{
                    echo 'An error occured!';
                }
                
            }else{
                echo 'User not found!';
            }
        }
    }
?>