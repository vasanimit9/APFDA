<?php

	//saving the database connection in a variable
	$conn = mysqli_connect("localhost","root","","apfda");

	if(isset($_SESSION['user_email'])) {

		$useremail = $_SESSION['user_email'];
	    $qry0 = "SELECT * FROM `users` WHERE `user_email` = '$useremail'";

	    $run0 = mysqli_query($conn,$qry0);

	    while ($row0 = mysqli_fetch_array($run0)) {
	      $_SESSION['type'] = $row0['user_type'];
	    }

	}