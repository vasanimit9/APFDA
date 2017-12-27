<?php
  session_start();

  if(!isset($_SESSION['user_email'])) {
    header("./");
  } elseif ($_SESSION['type'] != 5) {
    header("./dashboard.php");
  }

  include "dbconnect.php";

  if (isset($_POST['submit'])) {
    $school_id = mysqli_real_escape_string($conn, $_POST['school']);
    $qris = mysqli_real_escape_string($conn, $_POST['qris']);
    $qrim = mysqli_real_escape_string($conn, $_POST['qrim']);
    $qril = mysqli_real_escape_string($conn, $_POST['qril']);
    $qdas = mysqli_real_escape_string($conn, $_POST['qdas']);
    $qdam = mysqli_real_escape_string($conn, $_POST['qdam']);
    $qdal = mysqli_real_escape_string($conn, $_POST['qdal']);
    $qros = mysqli_real_escape_string($conn, $_POST['qros']);
    $qrom = mysqli_real_escape_string($conn, $_POST['qrom']);
    $qrol = mysqli_real_escape_string($conn, $_POST['qrol']);
    $driver_id = $_SESSION['id'];
    $routeNo = mysqli_real_escape_string($conn, $_POST['routeNo']);
    //Tommorow edit, almost done, use localtime, date time showing GMT
    date_default_timezone_set('Asia/Kolkata');
    $datetime = new DateTime('tomorrow');
    $tommorow = $datetime->format('Y-m-d');
    $datetime = new DateTime();
    $today = $datetime->format('Y-m-d');
    $rice = $qris.' S '.$qrim.' M '. $qril.' L ';
    $dal = $qris.' S '.$qrim.' M '. $qril.' L ';
    $roti = $qris.' S '.$qrim.' M '. $qril.' L ';

    $sql1 = "SELECT * FROM `requirements` WHERE `school_id`='$school_id' AND `registeredDate`='$today'";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows(result1) == 0) {
      $sql2 = "INSERT INTO `requirements` SET `school_id`='$school_id', `driver_id`='$driver_id', `route_no`='$routeNo', `reqRice`='$rice', `reqDal`='$dal', `reqRoti`='$roti', `registeredDate`='$today', `requiredDate`='$tommorow'";
      $result2 = mysqli_query($conn, $sql2);
      if ($result2) {
        header("Location: ./dashboard.php?m=3");
      } else {
        header("Location: ./dashboard.php?m=4");
      }
    } elseif (mysqli_num_rows(result1) == 1) {
      $sql3 = "UPDATE `requirements` SET `driver_id`='$driver_id', `route_no`='$routeNo', `reqRice`='$rice', `reqDal`='$dal', `reqRoti`='$roti', `requiredDate`='$tommorow' WHERE `school_id`='$school_id' AND `registeredDate`='$today'";
      $result3 = mysqli_query($conn, $sql3);
      if ($result3) {
        header("Location: ./dashboard.php?m=3");
      } else {
        header("Location: ./dashboard.php?m=4");
      }
    }
  } else {
    //Nothing
  }
?>
