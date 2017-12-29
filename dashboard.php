<?php

	session_start();

	include "dbconnect.php";

	include "classes.php";

	$html = new html("Dashboard");

	include "navbar.php";

	if (isset($_COOKIE['username'])) {
		?>
		<div class="modal fade" id="Modal" role="dialog">
    	<div class="modal-dialog modal-lg">

      	<!-- Modal content-->
      	<div align="center" class="modal-content">
					<div class="modal-header justify-content-center">
						<h1><b>Hare Krishna</b></h1>
					</div>
					<div class="modal-body">
          	<p><i>Hare Krishna Hare Krishna, Krishna Krishna, Hare Hare!</i></p>
						<p><i>Hare Rama Hare Rama, Rama Rama, Hare Hare!</i></p>
        	</div>
        	<div class="modal-footer justify-content-center">
          	<button type="button" class="btn btn-danger" data-dismiss="modal">Hare Krishna!</button>
        	</div>
      	</div>

    	</div>
  	</div>
		<?php
		setcookie('username', 'Chaku', time()-10000);
	}

	//Driver file added by Rohit, edit if necessary
	if ($_SESSION['type'] == 5) {
		include 'driver.php';
	} elseif ($_SESSION['type'] == 4) {
		include 'principal.php';
	}

?>
<script type="text/javascript">
    $(window).load(function(){
        $('#Modal').modal('show');
    });
</script>
