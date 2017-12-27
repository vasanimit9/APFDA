<?php
  if(empty($_SESSION)) {
    header("Location: ./");
  } elseif($_SESSION['type']==5 || $_SESSION['type']==3) {
    header("Location: ./dashboard.php");
  }
?>
<div class="container">
  <h3>Welcome Principal</h3>
</div>
