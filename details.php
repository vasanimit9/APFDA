<?php

	session_start();

	if(!isset($_SESSION['user_email'])) {
		header("Location: ./");
	}
	elseif($_SESSION['type']>3) {
		header("Location: ./");
	}
	elseif(!isset($_POST['uname'])) {
		header("Location: ./cpanel.php");
	}

	include "dbconnect.php";
	include "classes.php";

	$html = new html("User Details");

	include "navbar.php";

?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<input type="text" name="id" value="<?php echo $_POST['uid'] ?>" hidden>
					<table class="table table-responsive table-striped table-bordered">
						<tr>
							<th style="min-width: 250px;">Name</th>
							<td style="min-width: 250px;"><input value="<?php echo $_POST['uname']; ?>" disabled class="form-control"></td>
							<td></td>
							<td></td>
						</tr>

						<?php

						$id = $_POST['uid'];

						$qry = "SELECT * FROM `users_meta` WHERE user_id = '$id' ";

						$run = mysqli_query($conn,$qry);

						while($row = mysqli_fetch_array($run)) {
							?>
						<tr>
							<th><?php echo $row['property_name']; ?></th>
							<td style="min-width: 200px;">
								<form action="changeuser.php" method="post">
									<input type="text" name="id" value="<?php echo $id; ?>" hidden>
									<input type="text" name="property_name" value="<?php echo $row['property_name']; ?>" hidden>
									<input type="text" value="<?php echo $row['property_value']; ?>" name="property_value" class="form-control" required>
							</td>
							<td>
									<button type="submit" class="btn btn-primary">Change</button>
								</form>
							</td>
							<td>
								<form action="deletemeta.php" method="post">
									<input type="text" name="id" value="<?php echo $row['id'] ?>" hidden>
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
							</td>
						</tr>
							<?php
						}

						?>
						<tr>
							<form action="addproperty.php" method="post">
							<td>
								Add property:

							</td>
							<td>
								<select name="property" class="form-control">
									<?php

									$tp = $_POST['type'];

									$qry2 = "SELECT * FROM `users_meta_meta` WHERE `type` = '$tp'";
									$run2 = mysqli_query($conn,$qry2);

									while($row2 = mysqli_fetch_array($run2)) {
										?>

									<option value="<?php echo $row2["property"]; ?>"><?php echo $row2["property"]; ?></option>
										<?php
									}

									?>
								</select>
								<input type="text" name="id" value="<?php echo $_POST['uid'] ?>" hidden>
							</td>
							<td>
								<input type="text" name="property_value" class="form-control" placeholder="Value" style="min-width: 100px;">
							</td>
							<td><button type="submit" class="btn btn-primary">Add</button></td>
							</form>
						</tr>
					</table>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		<?php

		if(isset($_GET['m'])) {
			if($_GET['m'] == 1) {
				?>

		$.notify("User updated.",{position:"right bottom",className:"success"});

				<?php
			}
			else if($_GET['m'] == 2) {
				?>

		$.notify("Update failed.",{position:"right bottom"});
				<?php
			}
		}

		?>
	</script>
