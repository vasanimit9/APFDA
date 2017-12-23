<?php
	
	session_start();

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