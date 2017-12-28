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
  <div class="row">
    <div class="col-md-7 col-sm-7 justify-content-center table-responsive">
      <h3 align="center">Attendance Review</h3>
      <br>
      <?php
      $id = $_SESSION['id'];
      $sql1 = "SELECT * FROM `schools` WHERE `principal_user_id`='$id'";
      $result1 = mysqli_query($conn, $sql1);

      ?>
      <table align="center" class="table table-striped">
        <tr>
          <td align="center"><b>School Name</b></td>
          <td align="center"><b>Taluka Name</b></td>
          <td align="center"><b>Shift</b></td>
          <td align="center"><b>Category</b></td>
          <td align="center"><b>Enter Attendance</b></td>
        </tr>
      <?php
        if (mysqli_num_rows($result1) > 0) {
          //Unlike driver the principal may have multiple schools under him
          while ($row1 = mysqli_fetch_assoc($result1)) {
            $school_id = $row1['school_id'];
            $school_name = $row1['school_name'];
            $taluka_id = $row1['taluka_id'];
            //shift: 0-morning, 1-afternoon
            //$shift = $row1['category'];
            if ($row1['category'] == 0) {
              $shift = "Morning";
            } else {
              $shift = "Afternoon";
            }
            //category: 0-primary, 1-upper primary
            //$category = $row1['category'];
            if ($row1['category'] == 0) {
              $category = "Primary";
            } else {
              $category = "Upper Primary";
            }

            $sql2 = "SELECT * FROM `taluka` WHERE `taluka_id`='$taluka_id'";
            $result2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($result2) == 1) {
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $taluka_name = $row2['taluka_name'];
              }
            } else {
              //Some error statement, because one-one relation b/w id and name
            }

            //Table from here onward
            ?>
            <tr>
              <td align="center"><?php echo $school_name; ?></td>
              <td align="center"><?php echo $taluka_name; ?></td>
              <td align="center"><?php echo $shift; ?></td>
              <td align="center"><?php echo $category; ?></td>
              <td align="center"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">Enter</button></td>
            </tr>
            <div class="modal fade" id="myModal2" role="dialog">
              <div class="modal-dialog">

                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php echo "$school_name"; ?></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <!-- <p>Some text in the body.</p> -->
                    <form action="attendance.php" method="post" onsubmit="return validateAtnd()">
                      <input type="hidden" name="school_id" value="<?php echo $school_id ?>">
                      <input type="hidden" name="taluka_id" value="<?php echo $taluka_id ?>">
                      <input type="hidden" name="shift" value="<?php echo $shift ?>">
                      <input type="hidden" name="category" value="<?php echo $category ?>">
                      <label for="nob">Number of boys attended:</label>
                      <input type="number" class="form-control" id="nob" name="nob" value="0" min="1" max="500">
                      <br>
                      <label for="nobm">Number of boys taking MDM:</label>
                      <input type="number" class="form-control" id="nobm" name="nobm" value="0" min="1" max="500">
                      <!-- <br>
                      <label for="nog">Number of girls attended:</label>
                      <input type="number" class="form-control" id="nog" name="nog" value="0" min="1" max="500">
                      <br>
                      <label for="nogm">Number of girls taking MDM:</label>
                      <input type="number" class="form-control" id="nogm" name="nogm" value="0" min="1" max="500"> -->
                      <br>
                      <input type="submit" class="btn btn-default" name="submit" value="Submit">
                      <!-- <button type="submit" class="btn btn-default" data-dismiss="modal">Submit</button> -->
                    </form>
                  </div>
                </div>

              </div>
            </div>
          <?php

        }//end of while loop

        ?></table><?php

      } else {
        //Do nothing, i guess
      }

      ?>
    </div>
    <div class="col-md-5 col-sm-5">
      <h3 align="center">Requirement Feedback</h3>
        <form action="principalCheck.php" method="POST" onsubmit="return validate()">
          <br>
            <div class="row justify-content-center">
              <div class="col-sm-10 col-md-10">
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
              <div class="col-md-7 col-sm-7">
                <input type="number" id="ris" name="qris" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="rim">Medium</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="rim" value="Medium">
              </div>
              <div class="col-md-7 col-sm-7">
                <input type="number" id="rim" name="qrim" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-label" for="ril">Large</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="ril" value="Large">
              </div>
              <div class="col-md-7 col-sm-7">
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
              <div class="col-md-7 col-sm-7">
                <input type="number" id="das" name="qdas" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-lable" for="dam">Medium</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="dam" value="Medium">
              </div>
              <div class="col-md-7 col-sm-7">
                <input type="number" id="dam" name="qdam" class="form-control" min="0" max="5" value="0" placeholder="Number of Vessels">
              </div>
            </div>
            <br>
            <div class="row justify-content-center">
              <!-- <label class="col-form-lable" for="dal">Large</label> -->
              <div class="col-md-3 col-sm-3">
                <input type="text" style="border: none;" readonly name="dal" value="Large">
              </div>
              <div class="col-md-7 col-sm-7">
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
              <div class="col-md-7 col-sm-7">
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

            <div class="row justify-content-center" id="date"></div>
            <div class="row justify-content-center">
              <input class="btn btn-success col-sm-6 col-md-6 form-control" type="submit" name="submit" value="Send">
            </div>
        </form>
      <br>
    </div>
  </div>
</div>

<script type="text/javascript">
<?php
if(isset($_GET['m'])) {
  if($_GET['m'] == 1) {
    ?>
    $.notify("Attendance Registered!", {position:"left bottom",className:"success"});
    <?php
  } elseif($_GET['m'] == 2) {
    ?>
    $.notify("Attendance registeration \nfailed. Contact \nmaintenance", {position: "left bottom"});
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
  if($("#select").val() == "") {
    $.notify("Select school\nbefore submission. ", {position: "right bottom"});
    return false;
  } else if (eval($("#ris").val())=="0" && eval($("#rim").val())=="0" && eval($("#ril").val())=="0") {
    $.notify("Select rice qty\nbefore submission. ", {position: "right bottom"});
    return false;
  } else if (eval($("#das").val())=="0" && eval($("#dam").val())=="0" && eval($("#dal").val())=="0") {
    $.notify("Select dal qty\nbefore submission. ", {position: "right bottom"});
    return false;
  } else if (eval($("#rnum").val())=="0")  {
    $.notify("Select roti qty\nbefore submission. ", {position: "right bottom"});
    return false;
  } else {
    return true;
  }
}

function validateAtnd() {
  // if (eval($("nobm").val()) > eval($("nob").val())) {
  //   $.notify("Please check boy's\n input fields.", {position: "right bottom"});
  //   return false;
  // } else if (eval($("nogm").val()) > eval(eval($("nog").val())) {
  //   $.notify("Please check girl's\n input fields.", {position: "right bottom"});
  //   return false;
  // } else if ($("nob").val())==0 || $("nobm").val()) || $("nog").val()) || $("nogm").val())) {
  //   $.notify("Please check \n input fields.", {position: "right bottom"});
  //   return false;
  // } else {
  //   return true;
  // }
  var w, x, y, z;
  w = document.getElementById('nob');
  x = document.getElementById('nobm');
  //y = document.getElementById('nog');
  //z = document.getElementById('nogm');
  if (x>w) {
    alert("What the Fuck");
    $.notify("Please check \n input fields.", {position: "right bottom"});
    return false;
  } else {
    return true;
  }
}

</script>
