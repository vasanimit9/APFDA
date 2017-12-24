<?php

	session_start();

	include "dbconnect.php";

	if(isset($_POST['id'])) {
		$id = $_POST['id'];
		$property_name = mysqli_real_escape_string($conn,$_POST['property']);
		$property_value = mysqli_real_escape_string($conn,$_POST['property_value']);

		$qry = "INSERT INTO `users_meta` SET `user_id` = '$id', `property_name` = '$property_name', property_value = '$property_value' ";
		$run = mysqli_query($conn,$qry);

		if($run)
			header("Location: ./cpanel.php?m=3");
		else
			header("Location: ./cpanel.php?m=4");
	}

?>