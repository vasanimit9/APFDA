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
    $y = mysqli_real_escape_string($conn, $_POST['cYear']);
    $m = mysqli_real_escape_string($conn, $_POST['cMonth']);
    $d = mysqli_real_escape_string($conn, $_POST['cDate']);
    $driver_id = $_SESSION['id'];
    $routeNo = mysqli_real_escape_string($conn, $_POST['routeNo']);

    //To check if the custom date is standardized
    //$y==0 || $m==0 || $d==0 || ($m==2 && $d>29) || ($m==4 && $d>30) || ($m==6 && $d>30) || ($m==9 && $d>30) || ($m==11 && $d>30)
    if ($y==0 && $m==0 && $d==0) {
      //Tommorow edit, almost done, use localtime, date time showing GMT
      date_default_timezone_set('Asia/Kolkata');
      $datetime = new DateTime();
      $today = $datetime->format('Y-m-d');
      $to_day = $datetime->format('l');

      if ($to_day == "Saturday") {
        $datetime = new DateTime('tomorrow+1day');
        $tommorow = $datetime->format('Y-m-d');
      } else {
        $datetime = new DateTime('tomorrow');
        $tommorow = $datetime->format('Y-m-d');
      }
    } elseif ($y==0 || $m==0 || $d==0 || ($m==2 && $d>29) || ($m==4 && $d==31) || ($m==6 && $d==31) || ($m==9 && $d==31) || ($m==11 && $d==31)) {
      header("Location: ./dashboard.php?m=5");
    } else {
      
    }

    $sql4 = "SELECT * FROM `holidays` WHERE `date`='$tommorow' AND `school_id`='$school_id'";
    $result4 = mysqli_query($conn, $sql4);
    $x = 0;

    while (mysqli_num_rows($result4) != 0) {
      $x = $x + 1;
      $datetime = new DateTime('tomorrow+'.$x.'day');
      $tommorow = $datetime->format('Y-m-d');
      $sql4 = "SELECT * FROM `holidays` WHERE `date`='$tommorow' AND `school_id`='$school_id'";
      $result4 = mysqli_query($conn, $sql4);
    }

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
    } else {
    //Nothing
  }
?>
