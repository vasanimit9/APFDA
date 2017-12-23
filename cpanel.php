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
			<div class="col-md-3" style="font-size: 2em;">
				<i class="fa fa-user-plus"></i> Add User<hr>
			</div>
			<div id="vr"></div>
			<div class="col-md-9" id="win">
				
			</div>
		</div>

	</div>

	<script type="text/javascript">
			$("#vr").css("height",$("#win").height);
			$("#win").css("height",window.innerHeight);
	</script>