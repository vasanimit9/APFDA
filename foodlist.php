<?php 

	session_start();

	include "dbconnect.php";

	if($_SESSION['type']>3) {
		header("Location: ./");
	}

	include "classes.php";

	$html = new html("Food list");

	include "navbar.php";

	$taluka = array();
	$schools = array();

	$qry0 = "SELECT * FROM `taluka`";
	$run0 = mysqli_query($conn,$qry0);

	while($row0 = mysqli_fetch_array($run0)) {
		$taluka[$row0['taluka_id']] = $row0['taluka_name'];
	}

	$qry00 = "SELECT * FROM `schools`";
	$run00 = mysqli_query($conn,$qry00);

	while ($row00 = mysqli_fetch_array($run00)) {
		$schools[$row00['id']] = array("taluka_id"=>$row00['taluka_id'],"school_id"=>$row00['school_id'],"school_name"=>$row00['school_name']);
	}


 ?>


 <div class="container">
 	<div class="row">
 		<div class="col-md-3"></div>
 		<div class="col-md-6">

 			<!-- form to select route for reviewing -->

 			<form method="post" action="foodlist.php" class="row">
 				<div class="col-md-6">
		 			<select name="route_id" class="form-control" >
		 				<option value="" style="display: none;">--route no.--</option>

					<?php


			$qry = "SELECT * FROM `routes`";
			$run = mysqli_query($conn,$qry);

			while($row = mysqli_fetch_array($run)) {
				echo "\t<option value='".$row['id']."'>".$row['route_no']."</option>";
			}


					?> 
					</select>
				</div>
				<div class="col-md-6">
 					<button type="submit" class="btn btn-success">View</button>
 				</div>
 			</form>

 			<!-- end form -->


 		</div>
 	</div><br>

 	<!-- div for online reviewing of today's deliveries -->

 	<div class="row">
 		<form action="changedelivery.php" method="post" onsubmit="return validate()" class="col-md-12">
 			<table class="table table-striped table-responsive table-bordered">
 				<tr>
 					<th rowspan="2">Taluka</th>
 					<th rowspan="2">School No.</th>
 					<th rowspan="2">Total Students</th>
 					<th rowspan="2">Biscuit</th>
 					<th rowspan="2">Sukhadi</th>
 					<th rowspan="2" style="min-width: 100px;">Roti</th>
 					<th colspan="2">Roti</th>
 					<th colspan="3">Rice</th>
 					<th colspan="3">Dal</th>
 					<th rowspan="2">Total</th>
 				</tr>
 				<tr>
 					<th  style="min-width: 100px;">Big</th>
 					<th style="min-width: 100px;">Medium</th>
 					<th style="min-width: 100px;">Big</th>
 					<th style="min-width: 100px;">Medium</th>
 					<th style="min-width: 100px;">Small</th>
 					<th style="min-width: 100px;">Big</th>
 					<th style="min-width: 100px;">Medium</th>
 					<th style="min-width: 100px;">Small</th>
 				</tr>
 		<?php

 		if(isset($_POST['route_id'])) {
 			$rid = $_POST['route_id'];

 			$qry1 = "SELECT * FROM `routes` WHERE `id` = '$rid' ";
 			$run1 = mysqli_query($conn,$qry1);

 			while($row1 = mysqli_fetch_array($run1)) {
 				$route = $row1["school_id"];
 			}
 			$schoolids = explode(",", $route);

 			for($i=0;$i<sizeof($schoolids);$i++) {
 				?>
 				<tr>
 					<td><?php echo $taluka[$schools[$schoolids[$i]]["taluka_id"]]; ?></td>
 					<td><?php echo $schools[$schoolids[$i]]["school_name"]; ?></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td><input type="text" name="roti_num_<?php echo $schoolids[$i]; ?>" id="roti_num_<?php echo $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="roti_b_vessel_<?php echo $schoolids[$i]; ?>" id="roti_b_vessel_<?php echo $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="roti_m_vessel_<?php $schoolids[$i]; ?>" id="roti_m_vessel_<?php $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="rice_b_vessel_<?php echo $schoolids[$i]; ?>" id="rice_b_vessel_<?php echo $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="rice_m_vessel_<?php $schoolids[$i]; ?>" id="rice_m_vessel_<?php $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="rice_s_vessel_<?php $schoolids[$i]; ?>" id="rice_s_vessel_<?php $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="dal_b_vessel_<?php $schoolids[$i]; ?>" id="dal_b_vessel_<?php $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="dal_m_vessel_<?php $schoolids[$i]; ?>" id="dal_m_vessel_<?php $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="dal_s_vessel_<?php $schoolids[$i]; ?>" id="dal_s_vessel_<?php $schoolids[$i]; ?>" class="form-control"></td>
 					<td><input type="text" name="total_<?php echo $schoolids[$i]; ?>" id="total_<?php echo $schoolids[$i]; ?>" class="form-control"></td>
 				</tr>
 				<?php
 			}

 		}

 		?>
 			</table>
 		</form>
 	</div>

 	<!-- online review div ends -->

</div>
<span id="check"></span>
<script type="text/javascript">
<?php

for($i=0;$i<sizeof($schoolids);$i++) {
	?>

setInterval(function(){

	var xhttp<?php echo $schoolids[$i]; ?> = new XMLHttpRequest();

	xhttp<?php echo $schoolids[$i]; ?>.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			var iptab<?php echo $schoolids[$i]; ?> = this.responseText.split(",");
			$("#roti_num_<?php echo $schoolids[$i]; ?>").val(iptab<?php echo $schoolids[$i]; ?>[11]);
			// $("#roti_num_")
		}
	};

	xhttp<?php echo $schoolids[$i]; ?>.open("GET","fetch_school_data.php?id=<?php echo $schoolids[$i]; ?>",true);
	xhttp<?php echo $schoolids[$i]; ?>.send();

} ,10000);

	<?php
}

?>
</script>