<?php

	session_start();

	if(!isset($_SESSION['user_email'])) {
		header("Location: ./");
	}
	else if($_SESSION['type']>3) {
		header("Location: ./");
	}

	if(!isset($_POST['uname'])) {
		header("Location: ./cpanel.php");
	}

	include "dbconnect.php";
	include "classes.php";

	$html = new html("User Details");

	include "navbar.php";

?>

	<div class="container">
		<br><br><br>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-responsive table-striped">
					<tr>
						<th style="min-width: 250px;">Name</th>
						<td style="min-width: 250px;"><?php echo $_POST['uname']; ?></td>
					</tr>
					<form>
					<?php

					$id = $_POST['uid'];

					$qry = "SELECT * FROM `users_meta` WHERE user_id = '$id' ";

					$run = mysqli_query($conn,$qry);

					while($row = mysqli_fetch_array($run)) {
						?>
					<tr>
						<th><?php echo $row['property_name']; ?></th>
						<td><input type="text" value="<?php echo $row['property_value'] ?>" name="<?php echo $row['property_name']; ?>" class="form-control"></td>
					</tr>
						<?php
					}

					?>
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-primary">Change</button>
						</td>
					</tr>
					</form>
				</table>
			</div>
		</div>
	</div>