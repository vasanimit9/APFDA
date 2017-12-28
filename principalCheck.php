<!-- For validating the food requirement for the principal -->
<?php
  session_start();

  if(!isset($_SESSION['user_email'])) {
    header("./");
  } elseif ($_SESSION['type'] == 5) {
    header("./dashboard.php");
  }

  include "dbconnect.php";

?>
