<?php
session_start();

if(!isset($_SESSION['user_email'])) {
  header("./");
}

include "dbconnect.php";

?>
