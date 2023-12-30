<?php
    include('config.php');
    if(isset($_POST['Password'])){
        $username = $_SESSION['Username'];
        $code = $_SESSION['code'];
        $username = validate($conn, $username);
        $code = validate($conn, $code);
        
        $password= $_POST['Password'];
        $password= validate($conn, $password);
        
		$salt = $password.'bn54bnxys367jd23007';
	    $pass_by = md5($salt);

        $qv = $conn->query("SELECT * FROM `users` WHERE (`Username`='$username' Or `Email`='$username') and ResetCode = '$code'");
                
        $r = mysqli_fetch_array($qv);
        $active = $r['Active'];
        $e = $r['Email'];
        $Role = $r['Role'];
        if(mysqli_num_rows($qv) >= 1){
            if($active == 1){
                $stmt = "update `users` set `Password` = '$pass_by', `ResetCode` = '' WHERE `Username`='$username'";
                    
                if ($conn->query($stmt) === TRUE) {
                } else {
                    die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                    return;
                }
                echo 'Password Reset was successful!';
                if($Role != "Admin"){
                }
            }else{
                echo 'An error occured!';
            }
            
        }else{
            echo 'User not found!';
        }
        return;
    }
    echo 'Password is required!';
?>