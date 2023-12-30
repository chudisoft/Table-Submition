<?php 
	include('config.php');
	$password="Vouch_2022";
	$salt = $password.'bn54bnxys367jd23007';
    $pass_by = md5($salt);

	echo $pass_by;
?>
