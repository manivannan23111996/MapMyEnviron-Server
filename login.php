<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<div class="container" style="text-align: center; margin-top: 100px;">
<div class="col-md-4"></div>
	<div class="col-md-4">
	<h3>Login</h3>
		<form class="form-vertical" action="login.inc.php" method="POST">
			<input type="text" class="form-control" name="lusername" placeholder="Username" style="margin: 10px;" required>
			<input type="password" class="form-control" name="lpassword" placeholder="Password" style="margin: 10px;" required>
			<button class="btn btn-default btn-primary" style="margin: 10px;">Login</button>
		</form>
		<div style="margin-top: 20px;"><a href="register.php">Register</a><span style="display: inline-block;width: 50px;"></span>
		<a href="#">Forgot Password</a></div>
	</div>
	<div class="col-md-4"></div>
</div>
</body>
</html>