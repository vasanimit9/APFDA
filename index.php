<?php
	
	//carrying the session varaibles from other pages
	session_start();

	if(!isset($_SESSION['user_email'])) {
		header("Location: ./dashboard.php");
	}

	include "classes.php";
	$html = new html("APFDA - log in");

?>

	<div class="container">

      <form class="form-signin" action="login_check.php" method="post">
        <h2 class="form-signin-heading" align="center">LOG IN</h2>
        <?php
        	if(isset($_GET['m'])) {
        		if($_GET['m']==1) {
        			?>
        			<span style="text-align: center" class="text-danger">Invalid credential combination</span>
        			<?php
        		}
        	}
        ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

<style type="text/css">
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

    </style>