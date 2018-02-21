<?php
require_once('DB_Functions.php');
$db = new DB_Functions();
$response = array("error"=>FALSE);
if($_POST['femail']!="" &&  $_POST['fpassword']!=""){
	$email = $_POST["femail"];
	$fpassword = $_POST["fpassword"];
	if($db->changePassword($email,$fpassword)){
		$response["error"] = FALSE;
		$response["error_message"] = "Password reset success";
		echo json_encode($response);
	}else{
		$response["error"] = TRUE;
		$response["error_message"] = "Error while changing password";
		echo json_encode($response);
	}
}else{
	$response["error"] = TRUE;
	$response["error_message"] = "Enter all parameters";
	echo json_encode($response);
}
?>