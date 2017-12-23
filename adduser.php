<?php

	session_start();

	if(!isset($_SESSION['user_email'])) {
		header("./");
	}

	include "dbconnect.php";

	if(isset($_POST['email'])) {
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password_hash = md5(mysqli_real_escape_string($conn,$_POST['password']));
		$type = mysqli_real_escape_string($conn,$_POST["user_type"]);

		$qry = "INSERT INTO `users` SET user_email = '$email', password_hash = '$password_hash', user_type = '$type'";

		$run = mysqli_query($conn,$qry);

		if($run) {
			header("Location: ./cpanel.php?m=1");
		}
		else {
			header("Location: ./cpanel.php?m=2");
		}
	}
	else {
		header("Location: ./cpanel.php");
	}

?>