<?php

	session_start();

	include "dbconnect.php";

	include "classes.php";


	$html = new html("Dashboard");

	include "navbar.php";
	//Driver file added by Rohit, edit if necessary
	if ($_SESSION['type'] == 5) {
		include 'driver.php';
	}
?>
