<?php

// html class for reducing redunduncy

class html {
	//the constructor will add the head of the html page automatically
	function __construct($title="") {
		?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<?php include "css.php"; ?>
</head>
<body>
		<?php
	}

	function __destruct() {
		include "js.php"
		?>
</body>
</html>
		<?php
	}
}