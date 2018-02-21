<?php
	require_once('DB_Functions.php');
	$db = new DB_Functions();
	$response = array("error"=>FALSE);

	$username = $_POST['username'];

	$result = $db->DeleteUser($username);

	if($result == true){
		$response["error"] = false;
		$response["error_message"] = "User account Removed";
		echo json_encode($response);
	}else{
		$response["error"] = true;
		$response["error_message"] = "Fatal error";
		echo json_encode($response);
	}

?>
