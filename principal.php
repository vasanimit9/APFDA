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
    <div class="row justify-content-center">
      <p><strong><i>The Food delivery list has not yet been updated.</i></strong></p>
    </div>
    <div class="row justify-content-center">
      <p><strong><i>Please inform the executives or the maintenence team.</i></strong></p>
    </div>
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
    <div class="row justify-content-center">
      <div class="col-sm-9 col-md-9">
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
            <td align="center"><?php echo "$ris"; ?></td>
            <td align="center"><?php echo "$rim"; ?></td>
            <td align="center"><?php echo "$ril"; ?></td>
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
      </div>
    </div>

  <?php } ?>

  <div class="row justify-content-center">
    <form action="principalCheck.php" method="post">
        <input type="submit" class="btn btn-outline-success" name="submit" value="Time Check!">
    </form>
  </div>
  <div class="row justify-content-center">
    <small class="text-muted">Click here if your food has been delivered!</small>
  </div>
  <br>

  <div class="container">
    <div class="row justify-content-center">
      <h3>Your Foodback Please!</h3>
    </div>
    <div class="row justify-content-center">
      <small class="text-muted">Help us make our food better.</small>
    </div>
    <br>
    <div class="row justify-content-center">
      <form action="feedback.php" method="post">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="quality" value="good" checked>
            The food was good.
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="quality" value="ngood">
            The food was not good.
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="quality" value="nwarm">
            The food was not warm.
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="quality" value="ncook">
            The wasn't cooked properly.
          </label>
        </div>
        <div class="form-group">
          <label for="textarea">Remarks: </label>
          <textarea class="form-control" name="textfeed" id="textarea" rows="5" placeholder="Enter your remarks here!"></textarea>
        </div>
        <div class="row justify-content-center">
          <input type="submit" name="submit" class="btn btn-outline-success" value="Submit Feedback!?">
        </div>
      </form>
    </div>
  </div>
  <br>

  <div class="container">
    <div class="row justify-content-center">
      <h3>Please enter the today's attendance.</h3>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-8">
        <form action="attendance.php" method="post">
          <div class="form-group row justify-content-center">
              <label class="row justify-content-center" for="pb">Primary Boys</label>
              <input type="number" class="form-control" id="pb" placeholder="Number">
              <small class="form-text row justify-content-center text-muted">Enter the number of boys in Primary that took the MDM today.</small>
          </div>
          <div class="form-group row justify-content-center">
              <label class="row justify-content-center" for="upb">Upper Primary Boys</label>
              <input type="number" class="form-control" id="upb" placeholder="Number">
              <small class="form-text row justify-content-center text-muted">Enter the number of boys in Upper Primary that took the MDM today.</small>
          </div>
          <div class="form-group row justify-content-center">
              <label class="row justify-content-center" for="pg">Primary Girls</label>
              <input type="number" class="form-control" id="pg" placeholder="Number">
              <small class="form-text row justify-content-center text-muted">Enter the number of girls in Primary that took the MDM today.</small>
          </div>
          <div class="form-group row justify-content-center">
            <label class="row justify-content-center" for="upg">Upper Primary Girls</label>
            <input type="number" class="form-control" id="upg" placeholder="Number">
            <small class="form-text row justify-content-center text-muted">Enter the number of girls in Upper Primary that took the MDM today.</small>
          </div>
          <div class="row justify-content-center">
            <button type="submit" class="btn btn-outline-success">Register Attendance</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <br>

  <div class="container">
    <div class="row justify-content-center">
      <h3>Please enter the food requirements for the next day.</h3>
    </div>
  </div>
  <div class="row justify-content-center">
    <form action="requirement2.php" method="post">
      <div class="row justify-content-center">
        <p>Do you want food for tommorow?</p>
      </div>
      <div class="row justify-content-center">
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="holiday" id="yesCheck" onclick="holidayCheck()" value="yes" checked>Yes
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="holiday" id="noCheck" onclick="holidayCheck()" value="no">No
          </label>
        </div>
      </div>
      <div class="row justify-content-center" id="ifNo" style="display: none;">
        <div class="row form-group">
          <textarea class="form-control" id="textArea" rows="5" placeholder="Please tell us the reason for your holiday!"></textarea>
        </div>
        <div class="row justify-content-center" id="date">
          <div class="col-sm-4 col-md-4">
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
          <div class="col-sm-4 col-md-4">
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
          <div class="col-sm-4 col-md-4">
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
      </div>
      <br>
      <div class="row justify-content-center">
        <div class="col-sm-9 col-md-9 row justify-content-center">
          <h4><?php echo "$school_name"; ?></h4>
        </div>
      </div>
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

      <!-- Block for custom date input, shifted on top -->

      <div class="row justify-content-center">
        <input class="btn btn-outline-success col-sm-6 col-md-6 form-control" type="submit" name="submit" value="Send">
      </div>
      <br>
    </form>

  </div>
</div>

<script type="text/javascript">

function holidayCheck() {
    if (document.getElementById('noCheck').checked) {
        document.getElementById('ifNo').style.display = 'block';
    }
    else document.getElementById('ifNo').style.display = 'none';
}
</script>
