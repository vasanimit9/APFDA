<?php
  if(empty($_SESSION))
    header("Location: ./");
?>

<div class="container">
  <br><br>
  <div class="row">
    <div class="col-xs-6 col-md-6 table-responsive">

<?php
  //routeDriver will be the property name of that particular user and the property value will be the route id
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM `users_meta` WHERE `user_id`='$id' AND `property_name`='routeDriver'";
  $result = mysqli_query($conn, $sql);
  //Only one row/route should be the output of this querry.
  if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $route_no = $row['property_value'];
        //To get the route for that particular driver
        $sql2 = "SELECT * FROM `routes` WHERE `route_no`='$route_no'";
        $result2 = mysqli_query($conn, $sql2);
      ?>
      <table class="table table-striped">
        <tr>
          <td align="center"><strong>School List</strong></td>
          <td align="center"><strong>Delivery Status</strong></td>
        </tr>
      <?php
      //loop to get the route
      while ($row2 = mysqli_fetch_assoc($result2)) {
        $school_id = $row2['school_id'];
        //Splitting the school in an array of different ids. The school array taken from routes.
        $school_id_list = explode(",", $school_id);
        //
        $i = 0;
        //Edit ids and shit for the delivery time table change this from that to school table for names.
        while (isset($school_id_list[$i]) != NULL) {
          //Display school names from schools table using id.
          $sil = $school_id_list[$i];
          //Changed school_id to id
          $sql3 = "SELECT * FROM `schools` WHERE `id`='$sil'";
          $result3 = mysqli_query($conn, $sql3);
          //Loop to check and display
          while ($row3 = mysqli_fetch_assoc($result3)) {
            $school_name = $row3['school_name'];
            $sql4 = "SELECT * FROM `delivery_time_table` WHERE `school_id` ='$sil'";
            $result4 = mysqli_query($conn, $sql4);
            //When there are no records in the delivery time table for that particular school
            //Then we add that record
            if (mysqli_num_rows($result4) == 0) {
              ?>
                <tr>
                  <td align="center"><?php echo $school_name; ?></td>
                  <td align="center">
                    <!-- what to do about the redirection - solved, just redirect again -->
                    <form action="timestamp1.php" method="post">
                      <!-- Making the first input readonly, hidden and send it to the form as school id -->
                      <!-- nvm the above process was not required, it was stupid. -->
                      <input type="hidden" name="school_id" value="<?php echo $sil ?>">
                      <button type="submit" class="btn btn-warning" name="submit">Delivered</button>
                    </form>
                  </td>
                </tr>
              <?php
              //When there is a record for that particular school
            } elseif (mysqli_num_rows($result4) == 1) {
              while ($row4 = mysqli_fetch_assoc($result4)) {
                //To check if the the records found have driver ctime entered
                if ($row4['driver_ctime'] == NULL) {
                  ?>
                    <tr>
                      <td align="center"><?php echo $school_name; ?></td>
                      <td align="center">
                        <!-- what to do about the redirection - solved, just redirect again -->
                        <form action="timestamp2.php" method="post">
                          <!-- Making the first input readonly, hidden and send it to the form as school id -->
                          <!-- nvm the above process was not required, it was stupid. -->
                          <input type="hidden" name="school_id" value="<?php echo $sil ?>">
                          <button type="submit" class="btn btn-warning" name="submit">Delivered</button>
                        </form>
                      </td>
                    </tr>
                  <?php
                } else {
                  // I dont know why i made this either, i guess this is do nothing as well.
                }
              }
            } else {
              // Do Nothing, or something, i domt know why i made this else statement.
            }
          }
          $i = $i + 1;
        }
      }
    }
  } else {
    echo "Something Went wrong, please inform the maintenence team.";
  }
?>

    </div>
  </div>
</div>
<script type="text/javascript">
  <?php
    if(isset($_GET['m'])) {
      if($_GET['m'] == 1) {
        ?>
        $.notify("Time Registered!",{position:"right bottom",className:"success"});
        <?php
      } else if($_GET['m']==2) {
        ?>
        $.notify("Time registeration \nfailed. Contact \nmaintenance",{position: "right bottom"});
        <?php
      } else if($_GET['m']==3) {
        ?>
        $.notify("Time Registered!",{position:"right bottom",className:"success"});
        <?php
      } else if($_GET['m']==4) {
        ?>
        $.notify("Time registeration \nfailed. Contact \nmaintenance",{position: "right bottom"});
        <?php
      }
    }
  ?>
</script>
