<?php

	session_start();

	if(isset($_SESSION['user_email'])) {
		$qry = array();

		$id = $_POST['id'];

		include "dbconnect.php";

		$m = 1;

		foreach ($_POST as $key => $value) {
			if($key!="id" and is_nan($key)) {
				if($value == "") {
					$qry = "DELETE FROM `users_meta` WHERE `user_id` = '$id' AND `property_name` = '$key'  ";
					$run = mysqli_query($conn,$qry);
					continue;
				}
				else {
					$qry = "UPDATE `users_meta` SET `property_value` = '$value' WHERE `property_name` = '$key' and `user_id` = '$id' ";
					$run = mysqli_query($conn,$qry);
				}
				if(!$run) {
					$m = 0;
					break;
				}
			}
		}
		if($m) {
			header("Location: ./cpanel.php?m=3");
		}
		else {
			header("Location: ./cpanel.php?m=4");
		}
	}
	else {
		header("Location: ./");
	}

?>