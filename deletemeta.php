<?php

	session_start();

	include "dbconnect.php";

	if(isset($_SESSION['user_email'])) {
		if($_SESSION['type']>2) {
			header("Location: ./cpanel.php");
		}
		else {
			$id = $_POST['id'];

			$qry = "DELETE FROM `users_meta` WHERE id = '$id' ";
			$run = mysqli_query($conn,$qry);

			if($run) 
				header("Location: ./cpanel.php?m=3");
			else
				header("Location: ./cpanel.php?m=4");
		}
	}
	else
		header("Location: ./");

?>