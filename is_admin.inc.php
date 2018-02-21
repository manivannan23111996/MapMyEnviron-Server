<?php

require_once('DB_Functions.php');
$db = new DB_Functions();
$serial_no = $_POST['sim_serial'];
$response = array("error"=>FALSE);
$is_admin = $db->isAdmin($serial_no);
if($is_admin){ 
$response["error"] = FALSE;
$response["name"] = $is_admin["name"];
$response["category"] = $is_admin["category"];
echo json_encode($response);
}else{
$response["error"] = TRUE;
$response["error_message"] = "You are not admin";
echo json_encode($response);
}
?>


