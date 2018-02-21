<?php
	require_once('DB_Functions.php');
	$db = new DB_Functions();
	$response = array("error"=>FALSE);

	$category = $_POST['category'];
	$id = $_POST['id'];
	
	$result = $db->DeleteFeature($id,$category);

	if($result){
		$response["error"] = false;
		$response["error_message"] = "Feature Deleted";
		echo json_encode($response);
	}else{
		$response["error"] = TRUE;
		$response["error_message"] = "Unknown error";
		echo json_encode($response);
	}

?>
