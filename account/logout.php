<?php
    include('config.php');
	$code = $_SESSION['Username'];

    $comand = $conn->query("UPDATE `users` SET `Status`=0 WHERE `Username` = '$code';");
    if($comand == true){
    	session_destroy();
    	echo '<script>window.location = "../"</script>';
    }

    echo "You are logged out now!";
?>
