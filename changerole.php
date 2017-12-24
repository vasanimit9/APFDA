<?php

	session_start();

	if(!isset($_SESSION['user_email'])) {
		header("Location: ./");
	}

	include "dbconnect.php";

	if(isset($_POST["role"])) {

		$role = $_POST["role"];
		$id = $_POST["id"];

		if($role == 1 and $_SESSION['type']!=1) {
			header("Location: ./cpanel.php");
		}

		else {

			if($role == 1) {
				$qry2 = "UPDATE `users` SET user_type = '2' WHERE user_type = '1'";
				$run2 = mysqli_query($conn,$qry2);
			}

			if($role!=1 or ($role == 1 and $run2)) {
				$qry = "UPDATE `users` SET user_type = '$role' WHERE id = '$id'";

				$run = mysqli_query($conn,$qry);

				if($run) {
					//echo $role;
					header("Location: ./cpanel.php?m=3");
				}
				else {
					header("Location: ./cpanel.php?m=4");
				}
			}
			else {
				header("Location: ./cpanel.php?m=4");
			}
		}
	}

?>