<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<div class="container" style="text-align: center; margin-top: 100px;">
<div class="col-md-4"></div>
	<div class="col-md-4">
	<h3>Reset Password code verification</h3>
		<form class="form-vertical" action="change_password.inc.php" method="POST">
			<input type="text" class="form-control" name="femail" placeholder="Enter Email-ID" style="margin: 10px;" required>
			<input type="text" class="form-control" name="fpassword" placeholder="Enter password" style="margin: 10px;" required>
			<button class="btn btn-default btn-primary" style="margin: 10px;">Reset password</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>
</body>
</html>