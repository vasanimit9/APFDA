<?php

	session_start();
	include "dbconnect.php";

	if(isset($_GET['type'])) {
		if($_GET['type']==2 and $_SESSION['type'] != 1) {
			header("Location: ./cpanel.php");
		}
		else if($_SESSION['type']>3) {
			header("Location: ./");
		}
		else {

			include "classes.php";

			$html = new html("Filter results");

			$type = $_GET['type'];

			if($type < 4) {
				$qry = "SELECT * FROM `users` WHERE `user_type` = '$type'";
				$run = mysqli_query($conn,$qry);

				$type = array();
				$i = 0;

				if($run) {
					while($row = mysqli_fetch_array($run)) {
						$type[] = array();
						foreach ($row as $key => $value) {
							if(is_string($key)) {
								$type[$i][] = $value;
							}
						}
						$i++;
					}
				}
				foreach ($type as $key => $value) {
					foreach ($value as $key1 => $value1) {
						echo "$key => $key1 => $value1\n";
					}
				}
				?>

		<div class="container">
			<div class="row">
				<div class="col-md-6">
						<select id="s1">
								<option value="">Select User</option>
								<?php

				for($j=0;$j<$i;$j++) {
					?>
							<option value="<?php echo $j; ?>"><?php echo $type[$j]."\n"; ?></option>
					<?php
				}

								?>
						</select>
				</div>
				<div class="col-md-6">
					<form action="details.php" method="post">
						<input id="uname" type="text" name="uname" value="" hidden>
						<input id="uid" type="text" name="uid" value="" hidden>
						<input id="type" type="text" name="type" value="" hidden>
						<button type="submit">View</button>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				var admins = [];
				<?php
					for($j=0;$j<$i;$j++) {
						?>
				admins.push(["<?php echo $type[$j]["name"]; ?>","<?php echo $type[$j]["id"]; ?>","<?php echo $type[$j]["user_type"]; ?>"]);
						<?php
					}
				 ?>
				 setInterval(function(){
				 	if($("#s1").val() != "") {
				 		$("#uname").val(admins[eval($("#s1").val())][0]);
				 		$("#uid").val(admins[eval($("#s1").val())][1]);
				 		$("#type").val(admins[eval($("#s1").val())][2]);
				 	}
				 } ,100);
			});
		</script>

				<?php

			}
		}
	}