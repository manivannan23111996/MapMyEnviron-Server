<?php
require_once('DB_Functions.php');
$db = new DB_Functions();
$response = array("error"=>FALSE);
if($_POST['lusername']!="" &&  $_POST['lpassword']!=""){
	$username = $_POST['lusername'];
	$password = $_POST['lpassword'];
	$user = $db->getUser($username,$password);
	if($user){
		$response["error"] = FALSE;
		$response["error_message"] = "Login success";
		$response["uid"] = $user["id"];
		$response["user"]["name"] = $user["name"];
		$response["user"]["email"] = $user["email"];
		echo json_encode($response);
	}else{
		$response["error"] = TRUE;
		$response["error_message"] = "Login credentials wrong";
		echo json_encode($response);
	}
}else{
	$response["error"] = TRUE;
	$response["error_message"] = "Required parameters missing";
	echo json_encode($response);
}
?>
