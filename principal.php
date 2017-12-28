<?php
  if(empty($_SESSION)) {
    header("Location: ./");
  } elseif($_SESSION['type']==5 || $_SESSION['type']==3) {
    header("Location: ./dashboard.php");
  }
  $schools = array();
  $schoolsID = array()
?>
<div class="container">
  <div class="row justify-content-center">
    <h3>Welcome Principal <?php echo $_SESSION['user_name']; ?></h3>
  </div>
  <?php
  $principal_id = $_SESSION['id'];

  $sql1 = "SELECT * from `schools` where `principal_user_id`='$principal_id'";
  $result1 = mysqli_query($conn, $sql1);
  if (mysqli_num_rows($result1) == 1) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $school_id = $row1['school_id'];
      $school_name = $row1['school_name'];
    }
  } else {
    echo "There is something wrong with the database, please contact maintenance.";
  }

  date_default_timezone_set('Asia/Kolkata');
  $today = date('Y-m-d');

  $sql2 = "SELECT * from `food_qty_deliver` where `school_id`='$school_id' and `deliveryDate`='$today'";
  $result2 = mysqli_query($conn, $sql2);

  if (mysqli_num_rows($result2) == 0) {
    ?>
    <p><strong><i>The Food delivery list has not yet been updated.</i></strong></p>
    <p><strong><i>Please inform the executives or the maintenence team.</i></strong></p>
    <?php
  } else {
    while ($row2 = mysqli_fetch_assoc($result2)) {
      $ris = $row2['ris'];
      $rim = $row2['rim'];
      $ril = $row2['ril'];
      $das = $row2['das'];
      $dam = $row2['dam'];
      $dal = $row2['dal'];
      $rom = $row2['rom'];
      $rol = $row2['rol'];
      $rnum = $row2['rnum'];
      $rkg = $row2['rkg'];
      $dkg = $row2['dkg'];
      //will make a separate table for menu, including side item
      $sideItem = $row2['sideItem'];
    }
    ?>
    <div class="row justify-content-center">
      <h5><i>Here is today's menu for your school, <?php echo "$school_name"; ?>!</i></h5>
    </div>
    <table align="center" class="table table-striped">
      <tr>
        <td align="center"><strong>Item</strong></td>
        <td align="center"><strong>Small</strong></td>
        <td align="center"><strong>Medium</strong></td>
        <td align="center"><strong>Large</strong></td>
        <td align="center"><strong>Num/Kg</strong></td>
        <td align="center"><strong>Total(in M)</strong></td>
      </tr>
      <tr>
        <td align="center"><strong>Rice</strong></td>
        <td align="center"><?php echo "$ril"; ?></td>
        <td align="center"><?php echo "$rim"; ?></td>
        <td align="center"><?php echo "$ris"; ?></td>
        <td align="center"><?php echo "$rkg"; ?></td>
        <td align="center"><?php $totri = $ril*1.5 + $rim + $ris*0.33; echo "$totri"; ?></td>
      </tr>
      <tr>
        <td align="center"><strong>Dal</strong></td>
        <td align="center"><?php echo "$das"; ?></td>
        <td align="center"><?php echo "$dam"; ?></td>
        <td align="center"><?php echo "$dal"; ?></td>
        <td align="center"><?php echo "$dkg"; ?></td>
        <td align="center"><?php $totda = $dal*1.5 + $dam + $das*0.33; echo "$totda"; ?></td>
      </tr>
      <tr>
        <td align="center"><strong>Roti</strong></td>
        <td align="center">0</td>
        <td align="center"><?php echo "$rom"; ?></td>
        <td align="center"><?php echo "$rol"; ?></td>
        <td align="center"><?php echo "$rnum"; ?></td>
        <td align="center"><?php $totro = $rnum; echo "$totro"; ?></td>
      </tr>
      <tr>
        <td align="center"><strong>SideDish</strong></td>
        <td align="center"><?php echo "$sideItem"; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="center"><?php echo "$sideItem"; ?></td>
      </tr>
    </table>
  <?php } ?>
  <div class="container">
    <div class="row justify-content-center">
      <h3>Your Foodback Please!</h3>
    </div>
    <div class="row justify-content-center">
      <small class="text-muted">Help us make our food better.</small>
    </div>
    <div class="row justify-content-center">
      
    </div>
  </div>
</div>
