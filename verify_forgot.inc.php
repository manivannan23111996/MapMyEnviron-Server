<?php
require_once('DB_Functions.php');
$db = new DB_Functions();
$response = array("error"=>FALSE);
if($_POST['femail']!="" &&  $_POST['fcode']!=""){
	$email = $_POST["femail"];
	$fcode = $_POST["fcode"];
	if($db->verifyForgotCode($email,$fcode)){
		$response["error"] = FALSE;
		$response["error_message"] = "Code verify success";
		$response["email"] = $email;
		echo json_encode($response);
	}else{
		$response["error"] = TRUE;
		$response["error_message"] = "Wrong code";
		echo json_encode($response);
	}
}else{
	$response["error"] = TRUE;
	$response["error_message"] = "Enter all parameters";
	echo json_encode($response);
}
?>