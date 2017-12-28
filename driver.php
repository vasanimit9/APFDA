<?php
  if(empty($_SESSION)) {
    header("Location: ./");
  } elseif($_SESSION['type']==4 || $_SESSION['type']==3) {
    header("Location: ./dashboard.php");
  }
  $schools = array();
  $schoolsID = array();
  $routeNo = 0;
?>

<div class="container">
  <div class="row justify-content-center">
    <?php
    //I know the code is repeated but i dont think 1 more query matters
    $id = $_SESSION['id'];
    $user_name = $_SESSION['user_name'];
    $sql9 = "SELECT * FROM `users_meta` WHERE `user_id`='$id' AND `property_name`='routeDriver'";
    $result9 = mysqli_query($conn, $sql9);
    if (mysqli_num_rows($result9) == 1) {
      while ($row = mysqli_fetch_assoc($result9)) {
        $route_number = $row['property_value'];
        ?>
        <h5><b><i>Hello, <?php echo $user_name ?>. You are currently on route number: <?php echo $route_number ?></i></b></h5>
        <?php
      }
    }
    ?>
  </div>
  <br>
  <div class="row">
    <div class="col-sm-6 col-md-6 table-responsive">
      <h3 align="center">Delivery Checkpost</h3>
      <br>
      <?php
      //routeDriver will be the property name of that particular user and the property value will be the route id
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM `users_meta` WHERE `user_id`='$id' AND `property_name`='routeDriver'";
      $result = mysqli_query($conn, $sql);
      //Only one row/route should be the output of this querry.
      if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
          $route_no = $row['property_value'];
          //Route number for later use.
          $routeNo = $route_no;
          //To get the route for that particular driver
          $sql2 = "SELECT * FROM `routes` WHERE `route_no`='$route_no'";
          $result2 = mysqli_query($conn, $sql2);
          ?>
          <table align="center" class="table table-striped">
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
                  //Todays date to be used later
                  $today = date('Y-m-d');
                  //to get if the school id is there or not
                  $sql4 = "SELECT * FROM `delivery_time_table` WHERE `school_id`='$sil' AND `deliveryDate`='$today'";
                  $sql5 = "SELECT * FROM `delivery_time_table` WHERE `school_id`='$sil' AND `deliveryDate`!='$today'";
                  $result4 = mysqli_query($conn, $sql4);
                  $result5 = mysqli_query($conn, $sql5);
                  //When there are no records in the delivery time table for that particular school
                  //Then we add that record
                  if (mysqli_num_rows($result4) == 0) {
                    ?>
                    <tr>
                      <td align="center"><?php echo $school_name; ?></td>
                      <?php $schools[] = $school_name; $schoolsID[] = $sil; ?>
                      <td align="center">
                        <!-- what to do about the redirection - solved, just redirect again -->
                        <!-- <form action="timestamp1.php" method="post"> -->
                        <!-- Making the first input readonly, hidden and send it to the form as school id -->
                        <!-- nvm the above process was not required, it was stupid. -->

                        <!-- <button type="submit" class="btn btn-primary" name="submit">Delivered</button> -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" name="mod_btn">Delivery</button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Delivery Requirements</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <!-- <p>Sample text in the modal for testing.</p> -->
                                <?php
                                $sql6 = "SELECT * FROM `food_qty_deliver` WHERE `school_id`='$sil' AND `deliveryDate`='$today'";
                                $result6 = mysqli_query($conn, $sql6);

                                if (mysqli_num_rows($result6) == 0) {
                                  ?>
                                  <p><strong><i>The Food delivery list has not yet been updated.</i></strong></p>
                                  <p><strong><i>Please inform the executives or the maintenence team.</i></strong></p>
                                  <?php
                                } else {
                                  while ($row6 = mysqli_fetch_assoc($result6)) {
                                    $ris = $row6['ris'];
                                    $rim = $row6['rim'];
                                    $ril = $row6['ril'];
                                    $das = $row6['das'];
                                    $dam = $row6['dam'];
                                    $dal = $row6['dal'];
                                    $rom = $row6['rom'];
                                    $rol = $row6['rol'];
                                  }
                                  ?>
                                  <table align="center" class="table table-striped">
                                    <tr>
                                      <td align="center"><strong>Item</strong></td>
                                      <td align="center"><strong>Small</strong></td>
                                      <td align="center"><strong>Medium</strong></td>
                                      <td align="center"><strong>Large</strong></td>
                                    </tr>
                                    <tr>
                                      <td align="center"><strong>Rice</strong></td>
                                      <td align="center"><?php echo "$ris"; ?></td>
                                      <td align="center"><?php echo "$rim"; ?></td>
                                      <td align="center"><?php echo "$ril"; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="center"><strong>Dal</strong></td>
                                      <td align="center"><?php echo "$das"; ?></td>
                                      <td align="center"><?php echo "$dam"; ?></td>
                                      <td align="center"><?php echo "$dal"; ?></td>
                                    </tr>
                                    <tr>
                                      <td align="center"><strong>Roti</strong></td>
                                      <td align="center">-</td>
                                      <td align="center"><?php echo "$rom"; ?></td>
                                      <td align="center"><?php echo "$rol"; ?></td>
                                    </tr>
                                  </table>
                                </div>
                              <?php } ?>
                              <div class="modal-footer">
                                <form action="timestamp1.php" method="post">
                                  <input type="hidden" name="school_id" value="<?php echo $sil ?>">
                                  <button type="submit" class="btn btn-success" name="submit">Delivered</button>
                                </form>
                              </div>
                            </div>

                          </div>
                        </div>

                        <!-- </form> -->
                      </td>
                    </tr>
                    <?php
                    //When there is a record for that particular school
                  } elseif (mysqli_num_rows($result4) == 1) {
                    while ($row4 = mysqli_fetch_assoc($result4)) {
                      //To check if the the records found have driver dtime entered
                      if ($row4['driver_dTime'] == NULL) {
                        ?>
                        <tr>
                          <td align="center"><?php echo $school_name; ?></td>
                          <td align="center">
                            <!-- what to do about the redirection - solved, just redirect again -->
                            <!-- <form action="timestamp2.php" method="post"> -->
                            <!-- Making the first input readonly, hidden and send it to the form as school id -->
                            <!-- nvm the above process was not required, it was stupid. -->
                            <!-- <button type="submit" class="btn btn-primary" name="submit">Delivered</button> -->

                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" name="mod_btn">Delivery</button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Delivery Requirements</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <?php
                                    $sql7 = "SELECT * FROM `food_qty_deliver` WHERE `school_id`='$sil' AND `deliveryDate`='$today'";
                                    $result7 = mysqli_query($conn, $sql7);

                                    if (mysqli_num_rows($result7) == 0) {
                                      ?>
                                      <p><strong><i>The Food delivery list has not yet been updated.</i></strong></p>
                                      <p><strong><i>Please inform the executives or the maintenence team.</i></strong></p>
                                      <?php
                                    } else {
                                      while ($row6 = mysqli_fetch_assoc($result7)) {
                                        $ris = $row6['ris'];
                                        $rim = $row6['rim'];
                                        $ril = $row6['ril'];
                                        $das = $row6['das'];
                                        $dam = $row6['dam'];
                                        $dal = $row6['dal'];
                                        $rom = $row6['rom'];
                                        $rol = $row6['rol'];
                                      }
                                      ?>
                                      <table align="center" class="table table-striped">
                                        <tr>
                                          <td align="center"><strong>Item</strong></td>
                                          <td align="center"><strong>Small</strong></td>
                                          <td align="center"><strong>Medium</strong></td>
                                          <td align="center"><strong>Large</strong></td>
                                        </tr>
                                        <tr>
                                          <td align="center"><strong>Rice</strong></td>
                                          <td align="center"><?php echo "$ris"; ?></td>
                                          <td align="center"><?php echo "$rim"; ?></td>
                                          <td align="center"><?php echo "$ril"; ?></td>
                                        </tr>
                                        <tr>
                                          <td align="center"><strong>Dal</strong></td>
                                          <td align="center"><?php echo "$das"; ?></td>
                                          <td align="center"><?php echo "$dam"; ?></td>
                                          <td align="center"><?php echo "$dal"; ?></td>
                                        </tr>
                                        <tr>
                                          <td align="center"><strong>Roti</strong></td>
                                          <td align="center">-</td>
                                          <td align="center"><?php echo "$rom"; ?></td>
                                          <td align="center"><?php echo "$rol"; ?></td>
                                        </tr>
                                      </table>
                                    <?php } ?>
                                  </div>
                                  <div class="modal-footer">
                                    <form action="timestamp2.php" method="post">
                                      <input type="hidden" name="school_id" value="<?php echo $sil ?>">
                                      <button type="submit" class="btn btn-success" name="submit">Delivered</button>
                                    </form>
                                  </div>
                                </div>

                              </div>
                            </div>

                          <!-- </form> -->
                          </td>
                        </tr>
                        <?php
                      } else {
                        // I dont know why i made this either, i guess this is do nothing as well.
                      }
                    }
                  } elseif (mysqli_num_rows($result5) > 0 && false) {
                    //This part has been deemed unnecessary, so instead of deliting this or commenting this, i have added false
                    //so that it never executes, hope it might be helpful somewhere

                    while ($row5 = mysqli_fetch_assoc($result5)) {
                      if ($row5['driver_dTime'] == NULL) {
                        ?>
                        <tr>
                          <td align="center"><?php echo $school_name; ?></td>
                          <td align="center">
                            <!-- what to do about the redirection - solved, just redirect again -->
                            <!-- <form action="timestamp3.php" method="post"> -->
                            <!-- Making the first input readonly, hidden and send it to the form as school id -->
                            <!-- nvm the above process was not required, it was stupid. -->
                            <!-- <input type="hidden" name="school_id" value="<?php //echo $sil ?>"> -->
                            <!-- <button type="submit" class="btn btn-primary" name="submit">Delivered</button> -->

                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" name="mod_btn">Delivery</button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Delivery Requirements</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <!-- <p>Sample text in the modal for testing.</p> -->
                                    <?php
                                    $sql7 = "SELECT * FROM `food_qty_deliver` WHERE `school_id`='$sil' AND `deliveryDate`='$today'";
                                    $result7 = mysqli_query($conn, $sql7);

                                    if (mysqli_num_rows($result7) == 0) {
                                      ?>
                                      <p><strong><i>The Food delivery list has not yet been updated.</i></strong></p>
                                      <p><strong><i>Please inform the executives or the maintenence team.</i></strong></p>
                                      <?php
                                    } else {
                                      while ($row6 = mysqli_fetch_assoc($result7)) {
                                        $ris = $row6['ris'];
                                        $rim = $row6['rim'];
                                        $ril = $row6['ril'];
                                        $das = $row6['das'];
                                        $dam = $row6['dam'];
                                        $dal = $row6['dal'];
                                        $rom = $row6['rom'];
                                        $rol = $row6['rol'];
                                      }
                                      ?>
                                      <table align="center" class="table table-striped">
                                        <tr>
                                          <td align="center"><strong>Item</strong></td>
                                          <td align="center"><strong>Small</strong></td>
                                          <td align="center"><strong>Medium</strong></td>
                                          <td align="center"><strong>Large</strong></td>
                                        </tr>
                                        <tr>
                                          <td align="center"><strong>Rice</strong></td>
                                          <td align="center"><?php echo "$ris"; ?></td>
                                          <td align="center"><?php echo "$rim"; ?></td>
                                          <td align="center"><?php echo "$ril"; ?></td>
                                        </tr>
                                        <tr>
                                          <td align="center"><strong>Dal</strong></td>
                                          <td align="center"><?php echo "$das"; ?></td>
                                          <td align="center"><?php echo "$dam"; ?></td>
                                          <td align="center"><?php echo "$dal"; ?></td>
                                        </tr>
                                        <tr>
                                          <td align="center"><strong>Roti</strong></td>
                                          <td align="center"><?php echo "$ros"; ?></td>
                                          <td align="center"><?php echo "$rom"; ?></td>
                                          <td align="center"><?php echo "$rol"; ?></td>
                                        </tr>
                                      </table>
                                    </div>
                                    </div>
                                  <?php } ?>
                                  <div class="modal-footer">
                                    <form action="timestamp3.php" method="post">
                                      <input type="hidden" name="school_id" value="<?php echo $sil ?>">
                                      <button type="submit" class="btn btn-success" name="submit">Delivered</button>
                                    </form>
                                  </div>
                                </div>

                              </div>
                            </div>

                            <!-- </form> -->
                          </td>
                        </tr>
                        <?php
                      } else {
                        //Do nothing.
                      }
                    }
                  } else {
                    //Dont really know what to do in here.
                  }
                }
                $i = $i + 1;
              }
            }
          }
          ?>
          </table>
          <?php
        } else {
          echo "Something Went wrong, please inform the maintenence team.";
        }
        ?>
    </div>
    <div class="col-sm-6 col-md-6">
      <h3 align="center">Requirement Feedback</h3>
        <form action="requirement.php" method="POST" onsubmit="return validate()">
          <br>
            <div class="row justify-content-center">
              <div class="col-sm-9 col-md-9">
                <select class="custom-select form-control" id="select" name='school'>
                  <option style="display: none;" selected value="">Select School</option>
                  <?php
                  $i = 0;
                  while ($schools[$i] != NULL) {
                    $name = $schools[$i];
                    $id = $schoolsID[$i];
                  ?>
                  <option value="<?php echo $id ?>"><?php echo $name; ?></option>
                  <?php $i = $i +1; } ?>
                </select>
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="select1">Rice</label>
              <div class="col-sm-8 col-md-8">
                <select class="custom-select form-control" name="selectRice" id="select1">
                  <option style="display: none;" selected value="">Open this select menu</option>
                  <option value="rice">Rice</option>
                  <option value="jRice">Jeera Rice</option>
                  <option value="khichdi">Khichdi</option>
                  <option value="mPulav">Mutter Pulav</option>
                  <option value="vPulav">Veg. Pulav</option>
                </select>
              </div> -->
              <h5>Rice</h5>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="ris">Small</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="ris" value="Small">
              </div>
              <div class="col-md-6 col-sm-6">
                <input type="number" id="ris" name="qris" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="rim">Medium</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="rim" value="Medium">
              </div>
              <div class="col-md-6 col-sm-6">
                <input type="number" id="rim" name="qrim" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="ril">Large</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="ril" value="Large">
              </div>
              <div class="col-md-6 col-sm-6">
                <input type="number" id="ril" name="qril" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="select2">Dal</label>
              <div class="col-sm-8 col-md-8">
                <select class="custom-select form-control" name="selectDal" id="select2">
                  <option style="display: none;" selected value="">Select Dal/Sabji</option>
                  <option value="dal">Dal</option>
                  <option value="sabji">Sabji</option>
                </select>
              </div> -->
              <h5>Dal/Sabji</h5>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-lable" for="das">Small</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="das" value="Small">
              </div>
              <div class="col-md-6 col-sm-6">
                <input type="number" id="das" name="qdas" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-lable" for="dam">Medium</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="dam" value="Medium">
              </div>
              <div class="col-md-6 col-sm-6">
                <input type="number" id="dam" name="qdam" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-lable" for="dal">Large</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="dal" value="Large">
              </div>
              <div class="col-md-6 col-sm-6">
                <input type="number" id="dal" name="qdal" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="select3">Roti</label>
              <div class="col-sm-8 col-md-8">
                <select class="custom-select form-control" name="selectRoti" id="select3">
                  <option style="display: none;" selected value="">Select Roti Type</option>
                  <option value="roti">Roti</option>
                  <option value="thepla">Thepla</option>
                </select>
              </div> -->
              <h5>Roti</h5>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-lable" for="ros">Small</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="ronum" value="Number">
              </div>
              <div class="col-md-6 col-sm-6">
                <input type="number" id="rnum" name="rnum" class="form-control" min="0" max="5000" value="0" placeholder="Number of Rotis">
              </div>
            </div>
            <br>
            <input type="hidden" name="routeNo" value="<?php echo $routeNo; ?>" readonly disabled>
            <div class="row justify-content-center">
              <!-- <label><input type="checkbox" id="customDate" name="customDate" onclick="checkboxCheck()">Enter Custom Date</label> -->
              <button type="button" class="btn btn-primary" id="customDate" name="customDate">Use custom date</button>
            </div>
            <br>

            <!-- Block for custom date input -->
            <div class="row justify-content-center" id="date" style="display: none;">
              <div class="col-sm-3 col-md-3">
                <select class="custom-select form-control" name="cYear">
                  <option value="0" style="display: none;" selected>Year</option>
                  <?php
                  date_default_timezone_set('Asia/Kolkata');
                  $today = getdate();
                  $year = $today[year];
                  $i = $year + 3;
                  $year = $year - 1;
                  while ($year < $i) {
                    ?>
                    <option value="<?php echo "$year"; ?>"><?php echo "$year"; ?></option>
                    <?php
                    $year = $year + 1;
                  }
                  ?>
                </select>
              </div>
              <div class="col-sm-3 col-md-3">
                <select class="custom-select form-control" name="cMonth">
                  <option value="0" style="display: none;" selected>Month</option>
                  <?php
                  $a = 1;
                  while ($a <= 12) {
                    ?>
                    <option value="<?php echo "$a"; ?>"><?php echo "$a"; ?></option>
                    <?php
                    $a = $a + 1;
                  }
                  ?>
                </select>
              </div>
              <div class="col-sm-3 col-md-3">
                <select class="custom-select form-control" name="cDate">
                  <option value="0" style="display: none;" selected>Date</option>
                  <?php
                  $a = 1;
                  while ($a <= 31) {
                    ?>
                    <option value="<?php echo "$a"; ?>"><?php echo "$a"; ?></option>
                    <?php
                    $a = $a + 1;
                  }
                  ?>
                </select>
              </div>
              <br><br>
            </div>

            <div class="row justify-content-center">
              <input class="btn btn-success col-sm-6 col-md-6 form-control" type="submit" name="submit" value="Send">
            </div>
        </form>
        <br>
    </div>
  </div>
</div>
<script type="text/javascript">
  //Currently not in use, their servers are too slow
  <?php
    if(isset($_GET['m'])) {
      if($_GET['m'] == 1) {
        ?>
        $.notify("Time Registered!", {position:"left bottom",className:"success"});
        <?php
      } elseif($_GET['m'] == 2) {
        ?>
        $.notify("Time registeration \nfailed. Contact \nmaintenance", {position: "left bottom"});
        <?php
      } elseif($_GET['m'] == 3) {
        ?>
        $.notify("Feedback Recieved!", {position:"right bottom",className:"success"});
        <?php
      } elseif($_GET['m'] == 4) {
        ?>
        $.notify("Foodback failed. \nContact maintenance.", {position: "right bottom"});
        <?php
      } elseif($_GET['m'] == 5) {
        ?>
        $.notify("Incorrect Date Format.", {position: "right bottom"});
        <?php
      }
    }
  ?>
</script>
<script type="text/javascript">
  function validate() {
    if ($("#select").val() == "") {
      $.notify("Select school\nbefore submission. ", {position: "right bottom"});
      return false;
    } else if (eval($("#ris").val())=="0" && eval($("#rim").val())=="0" && eval($("#ril").val())=="0") {
      $.notify("Select rice qty\nbefore submission. ", {position: "right bottom"});
      return false;
    } else if (eval($("#das").val())=="0" && eval($("#dam").val())=="0" && eval($("#dal").val())=="0") {
      $.notify("Select dal qty\nbefore submission. ", {position: "right bottom"});
      return false;
    } else if (eval($("#rnum").val())=="0") {
      $.notify("Select roti qty\nbefore submission. ", {position: "right bottom"});
      return false;
    } else {
      return true;
    }
  }

  $(document).ready(function(){
    $("#customDate").click(function(){
        $("#date").toggle();
    });
  });

</script>
