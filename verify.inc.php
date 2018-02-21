<?php 
require_once('DB_Functions.php'); 
$db = new DB_Functions();
$response = array("error"=>FALSE);
$username = $_POST['vusername'];
$vcode = $_POST['vcode'];
if ($db->isVerifiedUsernameExisted($username)) {
		$response["error"] = TRUE;
		$response["error_message"] = "Username already existed";
		echo json_encode($response);
}else{
	$user = $db->verifyCode($username,$vcode); 
	if($user){
		$db->deleteTempUser($user["email"]);
		$response["error"] = FALSE;
		$response["error_message"] = "Verification Success";
		$response["uid"] = $user["id"];
		$response["user"]["name"] = $user["name"];
		$response["user"]["email"] = $user["email"];
		$response["user"]["username"] = $user["username"];
		echo json_encode($response);
	}else{
		$response["error"] = TRUE;
		$response["error_message"] = "Wrong verification code";
		echo json_encode($response);
	}
}
?>