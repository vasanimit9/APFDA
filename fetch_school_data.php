<?php

	session_start();

	include "dbconnect.php";

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$today = date("Y-m-d");

		$qry = "SELECT * FROM `food_qty_deliver` WHERE `id` = $id AND `deliveryDate` = '$today'";

		$run = mysqli_query($conn,$qry);

		if(!$run)
			echo "N";

		while($row = mysqli_fetch_array($run)) {
			foreach ($row as $key => $value) {
				if(!is_int($key))
					echo "$value,";
			}
		}

	}

?>