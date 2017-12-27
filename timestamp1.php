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
    $deliveryDate = date('Y-m-d');
    $driver_dTime = date('H:i:s');

    $sql = "INSERT INTO `delivery_time_table` SET `deliveryDate`='$deliveryDate', `driver_dTime`='$driver_dTime', `school_id`='$school_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: ./dashboard.php?m=1");
    } else {
      header("Location: ./dashboard.php?m=2");
    }

  } else {
    header("Location: ./dashboard.php");
  }

?>
