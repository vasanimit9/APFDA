<div class="container">
  <br><br><br>
  <div class="row">
    <div class="col-xs-6 com-md-6">

<?php
  //routeDriver will be the property name of that particular user and the property value will be the route name
  $sql = "SELECT * FROM `users_meta` WHERE `user_id`='$_SESSION['id']' AND `property_name`='routeDriver'";
  $result = mysqli_query($conn, $sql);
  //Only one row/route should be the output of this querry.
  if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $route_no = $row['property_value'];
        //To get the route for that particular driver
        $sql2 = "SELECT * FROM `routes` WHERE `route_no`='$route_no'";
        $result2 = mysqli_query($conn, $sql2);
      ?>
      <table class="table table-responsive table-striped">
        <tr>
          <th>School List</th>
          <th>Delivery Status</th>
        </tr>
      <?php
      //loop to get the route
      while ($row2 = mysqli_fetch_assoc($result2)) {
        $school_id = $row2['school_id'];
        //Splitting the school in an array of different ids.
        $school_id_list = explode("," $school_id);
        //To check if the school has had the food delivered or not, checking the schiil id list
        //one by one
        $i = 0;
        //Edit ids and shit for the delivery time table change this from that to school table for names.
        while ($school_id_list[$i] != NULL) {
          $school_id_list[$i] = $sil;
          $sql3 = "SELECT * FROM `delivery_time_table` WHERE `school_id`='$sil'";
          $result3 = mysqli_query($conn, $sql3);
          //Loop to check and display
          while ($row3 = mysqli_fetch_assoc($result3)) {
            $deliveryTime = $row3['driver_ctime'];
            if ($deliveryTime != NULL) {
              ?>
              <tr>
                <td><?php echo $row['school_id']; ?></td>
                <td>
                  <!-- what to do about the redirection? -->
                  <form action="timestamp.php" method="post">
                    <button type="submit" class="btn btn-warning" name="button">Delivered</button>
                  </form>
                </td>
              </tr>
              <?php
            }
          }
          $i += 1;
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
