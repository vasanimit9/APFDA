<?php

	session_start();

	include "dbconnect.php";

	include "classes.php";


	$html = new html("Dashboard");

	include "navbar.php";
?>

<!-- <div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 align="center">Hare Krishna!</h3>
		</div>
	</div>
</div> -->

<?php
	//Driver file added by Rohit, edit if necessary
	if ($_SESSION['type'] == 5) {
		include 'driver.php';
	} elseif ($_SESSION['type'] == 4) {
		include 'principal.php';
	}
?>
