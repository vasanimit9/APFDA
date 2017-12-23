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
						<th>Name</th>
						<td><?php echo $_POST['uname']; ?></td>
					</tr>
					<?php

					$id = $_POST['uid'];

					$qry = "SELECT * FROM `users_meta` WHERE user_id = '$id' ";

					$run = mysqli_query($conn,$qry);

					while($row = mysqli_fetch_array($run)) {
						?>
					<tr>
						<th><?php echo $row['property_name']; ?></th>
						<td><?php echo $row['property_value'] ?></td>
					</tr>
						<?php
					}

					?>
				</table>
			</div>
		</div>
	</div>