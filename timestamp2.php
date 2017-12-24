<?php

  session_start();

  if(!isset($_SESSION['user_email'])) {
		header("Location: ./");
	} elseif ($_SESSION['type'] < 4) {
    header("Location: ./cpanel.php");
  }

  include "dbconnect.php";

  if (isset($_POST['submit'])) {
    $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
    date_default_timezone_set('Asia/Kolkata');
    $driver_ctime = date('Y-m-d g:i:s');

    $sql = "UPDATE `delivery_time_table` SET `driver_ctime`='$driver_ctime' WHERE `school_id`='$school_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: ./dashboard.php?m=3");
    } else {
      header("Location: ./dashboard.php?m=4");
    }
    
  } else {
    header("Location: ./dashboard.php");
  }
?>
