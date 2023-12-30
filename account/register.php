<?php 
	include('config.php');
    $ref = 'N/A';
    
	if(isset($_POST['Username']) && isset($_POST['Password']) && 
        isset($_POST['Email'])){
		$name = validate($conn, $_POST['Names']);
		$username = validate($conn, $_POST['Username']);
		$email = validate($conn, $_POST['Email']);
 
        if(isset($_POST['Address'])){
            $Address = $_POST['Address'];
            $Address = validate($conn, $Address);
        }
        
        if(isset($_POST['Phone'])){
            $Phone = $_POST['Phone'];
            $Phone = validate($conn, $Phone);
        }
        
        if(isset($_POST['Password'])){
             $password= $_POST['Password'];
             $password= validate($conn, $password);
        }
        
        if(isset($_POST['Ref'])){
             $ref= $_POST['Ref'];
             $ref= validate($conn, $ref);
        }
        
        $date = date('Y/m/d H:i:s');
		$Id = substr(GUID(),0,8);
    	$qvID = $conn->query("SELECT * FROM `users` WHERE `Id`='$Id'");
    	while(mysqli_num_rows($qvID) >= 1){
		    $Id = substr(GUID(),0,8);
    	}

		$salt = $password.'bn54bnxys367jd23007';
	    $pass_by = md5($salt);

		
    	$qv = $conn->query("SELECT * FROM `users` WHERE `Email`='$email'");
    		
    	$qvo = $conn->query("SELECT * FROM `users` WHERE `Username`='$username'");
    	if(mysqli_num_rows($qv) >= 1){
            echo '1';
    	}else if(mysqli_num_rows($qvo) >= 1){
            echo '2';
    	}else{
    		$sql = "INSERT INTO `users`(`Id`, `Username`, `Names`, `Email`, `Password`, `Address`, `Active`, `Ref`, `Phone`, `Role`) VALUES ('$Id','$username','$name','$email','$pass_by',
                '$Address'," . true . ", '$ref','$Phone','Client')";
    		
            if ($conn->query($sql) === TRUE) {
              //echo "New record created successfully";
                echo '3';
                try{
    		        mail_Reg($name, $email, $ref, $password, $username);
    		        mail_Reg(", new User registration from: " . $name, $AdminEmail, $ref, $password, $username);
                } catch(Exception $e){
                    //error_log("Error sending email" . $e);
                }
            } else {
              //echo "Error: " . $sql . "<br>" . $conn->error;
                echo '4';
            }

            $conn->close();
    	}
    }
    else {
        //header('Location: '.$SiteURL.'/register.php');
        echo '<script type="text/javascript">
                   window.location = "'.$SiteURL.'/register.php";
              </script>';
        die ("Required data is missing");
	}
?>
