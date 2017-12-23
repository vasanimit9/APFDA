<?php
	
	session_start();

	if(!isset($_SESSION['user_email'])) {
		header("Location: ./");
	}
	else if($_SESSION['type']>3) {
		header("Location: ./dashboard.php");
	}

	include "dbconnect.php";
	include "classes.php";

	$html = new html("Admin Panel");

	include "navbar.php";

?>

	<div class="container">
		<br>
		<br>
		<br>

		<div class="row">
			<div class="col-md-9">
				
<?php

		$qry = "SELECT * FROM `users`";
		$run = mysqli_query($conn,$qry);

		$qry2 = "SELECT * FROM `user_type`";
		$run2 = mysqli_query($conn,$qry2);

		$type = array();

		while($row2 = mysqli_fetch_array($run2)) {
			$type[] = $row2['type'];
		}

?>

				<table class="table table-responsive table-striped">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Type</th>
						<th></th>
					</tr>

<?php
		while($row = mysqli_fetch_array($run)) {

					?>

					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['user_email']; ?></td>
						<td><?php echo $type[$row['user_type']-1]; ?></td>
						<td><form action="details.php" method="post">
								<input type="text" name="uname" value="<?php echo $row['name'];  ?>" hidden>
								<input type='text' value="<?php echo $row['id']; ?>" name="uid" hidden>
								<button type="submit" class="btn btn-warning">More Details</button>
							</form>
						</td>
					</tr>
					<?php

		}

?>

				</table>

			</div>
			<div class="col-md-3" style="text-align: center;">
				<h3>Add User</h3>
				<form action="adduser.php" method="post" onsubmit="return valid()">
					<input type="email" name="email" placeholder="Email" class="form-control" required>
					<input type="password" name="password" placeholder="Password" class="form-control" required="">
					<select name="user_type" class="form-control" onfocus="hid('hidop')" id="s1">
						<option id="hidop" value="">--type--</option>
						<option value="5">Driver</option>
						<option value="4">School Principal</option>
						<?php	if($_SESSION["type"]<3) { ?>
						<option value="3">Executive</option>
						<?php }
								if($_SESSION["type"]==1) { ?>
						<option value="2">Admin</option>
						<option value="1">SuperAdmin</option>
						<?php } ?>
					</select><br>
					<button type="submit" class="btn btn-success form-control">Add</button>
				</form>
			</div>
		</div>

	</div>

	<script type="text/javascript">
		function hid(x) {
			$("#"+x).css("display","none");
		}
		<?php
			if(isset($_GET['m'])) {
				if($_GET['m'] == 1) {
					?>

						$.notify("User added successfully.",{position:"right bottom",className:"success"});
					<?php
				}
				else {
					?>
		$.notify("User addition failed \n for some reason.","error");

					<?php
				}
			}
		?>
		function valid() {
			if( document.getElementById("s1").value == "") {
				$.notify("Select the type.");
				return false;
			}
			else
				return true;
		}
	</script>