<?php



?>
<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<div class="container" style="text-align: center; margin-top: 100px;">
<div class="col-md-4"></div>
	<div class="col-md-4">
	<h3>Register</h3>
		<form enctype="multipart/form-data" class="form-vertical" action="report.inc.php" method="POST">
			<input type="text" class="form-control" name="username" placeholder="username" style="margin: 10px;" value="manichan" required>
			<input type="text" class="form-control" name="category" placeholder="category" style="margin: 10px;" value="hospital"  required>
			<input type="text" class="form-control" name="description" placeholder="description" style="margin: 10px;" value="desc"  required>
			<input type="text" class="form-control" name="title" placeholder="severity" style="margin: 10px;" value="tile"  required>
			<input type="text" class="form-control" name="latitude" placeholder="latitude" style="margin: 10px;" value="13"  required>
			<input type="text" class="form-control" name="longitude" placeholder="longitude" style="margin: 10px;" value="80"  required>
<input type="File" name="fileToUpload" id="fileToUpload">
			<button type="submit" name="submit" class="btn btn-default btn-primary" style="margin: 10px;">Report</button>
		</form>
		<div style="margin-top: 20px;"><a href="login.php">Login</a>
	</div>
	<div class="col-md-4"></div>
</div>
</body>
</html>
