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

			include "navbar.php";

			$type = $_GET['type'];

			if($type < 4) {
				$qry = "SELECT * FROM `users` WHERE `user_type` = '$type'";
				$run = mysqli_query($conn,$qry);

				$arr = array();
				$i = 0;

				if($run) {
					while($row = mysqli_fetch_array($run)) {
						$arr[] = array();
						foreach ($row as $key => $value) {
							if(is_string($key)) {
								$arr[$i][$key] = $value;
							}
						}
						$i++;
					}
				}
				foreach ($arr as $key => $value) {
					foreach ($value as $key1 => $value1) {
						echo "$key => $key1 => $value1 <br>";
					}
				}
				?>

		<div class="container">
			<div class="row">
				<div class="col-md-4">
						<select id="s1" class="form-control">
								<option value="" style="display: none;">Select User</option>
								<?php

				for($j=0;$j<$i;$j++) {
					?>
							<option value="<?php echo $j; ?>">
								<?php echo $arr[$j]["name"]; ?>
							</option>
					<?php
				}

								?>
						</select>
				</div>
				<div class="col-md-4">
					<div class="row">
						<form action="details.php" method="post" class="col-md-12" onsubmit="return validate2()">
							<input id="uname" type="text" name="uname" class="form-control" value="" hidden>
							<input id="uid" type="text" name="uid" value="" class="form-control" hidden>
							<input id="type" type="text" name="type" value="" class="form-control" hidden>
							<button type="submit" class="btn btn-primary form-control">View</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				var admins = [];
				<?php
					for($j=0;$j<$i;$j++) {
						?>
				admins.push(["<?php echo $arr[$j]["name"]; ?>","<?php echo $arr[$j]["id"]; ?>","<?php echo $arr[$j]["user_type"]; ?>"]);
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
			function validate2() {
				if($("#s1").val() == "") {
					$.notify("Select a user");
					return false;
				}
			}
		</script>

				<?php

			}
			if($type == 4) {
				
			}
		}
	}