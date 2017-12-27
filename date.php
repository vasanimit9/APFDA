
  <div class="col-sm-3 col-md-3">
    <select class="custom-select form-control" name="cYear">
      <option value="" style="display: none;" selected>Year</option>
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
      <option value="" style="display: none;" selected>Month</option>
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
      <option value=""style="display: none;" selected>Date</option>
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
