<!DOCTYPE html>
<html>
<head>
        <title>Verify</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<div class="container" style="text-align: center; margin-top: 100px;">
<div class="col-md-4"></div>
        <div class="col-md-4">
        <h3>Verification</h3>
                <form class="form-vertical" action="get_image.inc.php" method="POST">
                        <input type="text" class="form-control" name="category" placeholder="Cate" style="margin: 10px;" required>
                        <input type="text" class="form-control" name="id" placeholder="Id" style="margin: 10px;" required>
                        <button type="submit" name="submit" class="btn btn-default btn-primary" style="margin: 10px;">Verify code</button>
                </form>
                <div style="margin-top: 20px;"><a href="login.php">Login</a>
        </div>
        <div class="col-md-4"></div>
</div>
</body>
</html>
