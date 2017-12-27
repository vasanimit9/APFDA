<?php

	session_start();

	include "dbconnect.php";

	if($_SESSION['type'] > 3) {
		header("Location: ./");
	}

	$qry = "SELECT * FROM `users` WHERE `user_type` = 4";
	$run = mysqli_query($conn,$qry);

	$principals = array();

	while($row = mysqli_fetch_array($run)) {
		$principals[] = array($row['id'],$row['name']);
	}

	$qry1 = "SELECT * FROM `taluka`";
	$run1 = mysqli_query($conn,$qry1);

	$taluka = array();

	while ($row1 = mysqli_fetch_array($run1)) {
		$taluka[] = array($row1['taluka_id'],$row1['taluka_name']);
	}

	include "classes.php";

	$html = new html("Schools &#038; Principals");

	include "navbar.php";

?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<form action="addst.php?t=1" method="post">
				<h3>Add Taluka</h3>
				<input type="text" name="taluka" class="form-control" placeholder="Taluka"><br>
				<button type="submit" class="btn btn-primary form-control">Add</button>
			</form>
		</div>
		<div class="col-md-6"></div>
		<div class="col-md-3">
			<form action="addst.php?t=2" method="post">
				<h3>Add School</h3>
				<input type="text" name="school" class="form-control" placeholder="School Name">
				<input type="text" name="school_id" class="form-control" placeholder="School ID">
				<select type="text" name="taluka_id" class="form-control">
					<option value="" style="display: none;">--taluka--</option>
					<?php

					for($i=0;$i<sizeof($taluka);$i++) {
						echo "<option value='".$taluka[$i][0]."'>".$taluka[$i][1]."</option>";
					}

					?>
				</select>
				<select class="form-control" name="category" id="s1">
					<option value="" style="display: none;">--category--</option>
					<option value="0">Primary</option>
					<option value="1">Upper Primary</option>
					<option value="2">Both</option>
				</select>
				<select class="form-control" name="shift" id="s2">
					<option value="" style="display: none;">--shift--</option>
					<option value="0">Morning</option>
					<option value="1">Afternoon</option>
					<option value="2">Both</option>
				</select>
				<select class="form-control" name="principal_user_id" id="s3">
					<option>--principal--</option>
					<?php 

					for($i = 0;$i<sizeof($principals);$i++) {
						echo "<option value='".$principals[$i][0]."'>".$principals[$i][1]."</option>";
					}

					?>
				</select><br>
				<button type="submit" class="btn btn-primary form-control">Add</button>
			</form>
		</div>
	</div>
</div>