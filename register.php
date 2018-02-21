<?php



?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<div class="container" style="text-align: center; margin-top: 100px;">
<div class="col-md-4"></div>
	<div class="col-md-4">
	<h3>Register</h3>
		<form class="form-vertical" action="register.inc.php" method="POST">
			<input type="text" class="form-control" name="rname" placeholder="Name" style="margin: 10px;" required>
			<input type="email" class="form-control" name="remail" placeholder="Email-ID" style="margin: 10px;" required>
			<input type="text" class="form-control" name="rusername" placeholder="Username" style="margin: 10px;" required>
			<input type="password" class="form-control" name="rpassword" placeholder="Password" style="margin: 10px;" required>
			<button type="submit" name="submit" class="btn btn-default btn-primary" style="margin: 10px;">Register</button>
		</form>
		<div style="margin-top: 20px;"><a href="login.php">Login</a>
	</div>
	<div class="col-md-4"></div>
</div>
</body>
</html>