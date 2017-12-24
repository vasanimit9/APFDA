<?php

	session_start();

	include "dbconnect.php";

	if(isset($_SESSION['user_email'])) {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$property_name = mysqli_real_escape_string($conn,$_POST['property_name']);
			$property_value = mysqli_real_escape_string($conn,$_POST['property_value']);

			if($_POST['property_value'] = "") {
				$qry1 = "SELECT * FROM `users_meta` WHERE `user_id` = '$id' and `property_name` = '$property_name' ";
				$run1 = mysqli_query($conn,$qry1);
				while($row = mysqli_fetch_array($run1)) {
					$id1 = $row['id'];
					$qry = "DELETE FROM `users_meta` WHERE id ='$id1' ";
					$run = mysqli_query($conn,$qry);
				}
			}
			else {
				$qry = "UPDATE `users_meta` SET `property_value` = '$property_value' WHERE `user_id` = '$id' and `property_name` = '$property_name' ";
				$run = mysqli_query($conn,$qry);
			}

			if($run)
				header("Location: ./cpanel.php?m=3");
			else
				header("Location: ./cpanel.php?m=4");
		}
	}
	else {
		header("Location: ./");
	}

?>