<?php
    session_start();
	include('config.php');
    $date = date('Y/m/d H:i:s');
	$Id = substr(GUID(),0,8);
	$qvID = $conn->query("SELECT * FROM `users` WHERE `Id`='$Id'");
	while(mysqli_num_rows($qvID) >= 1){
	    $Id = substr(GUID(),0,8);
	}
    $username = "Administrator";
    $email = "adminemail@gmail.com"; $Phone = "+32 81345543";
    $password="Admin2023"; $Address = "N/A"; $ref = "N/A"; $name = "Admin";
	$salt = $password.'bn54bnxys367jd23007'; $role = "Admin";
	$pass_by = md5($salt);

    $qvo = $conn->query("SELECT * FROM `users` WHERE `Username`='$username'");
    if(mysqli_num_rows($qvo) >= 1){
        echo 'Admin account already exist!';
    }else{
    	$sql = "INSERT INTO `users`(`Id`, `Username`, `Names`, `Email`, `Password`, `Address`, 
            `Active`, `Ref`, `Phone`, `Role`) VALUES ('$Id','$username','$name','$email','$pass_by',
            '$Address'," . true . ",'$ref','$Phone','$role')";
    		
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully for: Administrator";
            try{
    		    // mail_to($name, $email, $ref, $password, $username);
            } catch(Exception $e){
                //error_log("Error sending email" . $e);
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>
