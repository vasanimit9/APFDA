<!-- For validating the food requirement for the principal -->
<?php
  session_start();

  if(!isset($_SESSION['user_email'])) {
    header("./");
  } elseif ($_SESSION['type'] == 5) {
    header("./dashboard.php");
  }

  include "dbconnect.php";

  if (isset($_POST['submit'])) {
    $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
    date_default_timezone_set('Asia/Kolkata');
    $deliveryDate = date('Y-m-d');
    $principal_dTime = date('H:i:s');

    $sql1 = "SELECT * FROM `delivery_time_table` WHERE `school_id`='$school_id' AND `deliveryDate`='$deliveryDate'";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) == 0) {
      $sql2 = "INSERT INTO `delivery_time_table` SET `deliveryDate`='$deliveryDate', `principal_dTime`='$principal_dTime', `school_id`='$school_id'";
      $result2 = mysqli_query($conn, $sql2);

      if ($result2) {
        header("Location: ./dashboard.php?m=1");
      } else {
        header("Location: ./dashboard.php?m=2");
      }

    } elseif (mysqli_num_rows($result1) == 1) {
      while (mysqli_fetch_assoc($result1)) {
        $sql3 = "UPDATE `delivery_time_table` SET `principal_dTime`='$principal_dTime'";
        $result3 = mysqli_query($conn, $result3);

        if ($result3) {
          header("Location: ./dashboard.php?m=1");
        } else {
          header("Location: ./dashboard.php?m=2");
        }
      }

    } else {
      echo "Database crash, because a record with multiple fields of same value should not be possible.";
    }
  }
?>
