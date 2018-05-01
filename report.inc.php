<?php

	require_once('DB_Functions.php');

	$db = new DB_Functions();

	$response = array("error"=>FALSE);

	

	$username = $_POST['username'];

	$category = $_POST['category'];

	$description = $_POST['description'];

	$title = $_POST['title'];

	$latitude = $_POST['latitude'];

	$longitude = $_POST['longitude'];

	$fileArray = $_FILES['fileToUpload'];

	$target_path = "photo_upload/"; 

	 

	if (isset($_FILES['fileToUpload']['name'])) {

	    $target_path = $target_path.basename($_FILES['fileToUpload']['name']);

	    $response['file_name'] = basename($_FILES['fileToUpload']['name']);
	 

	    try {

if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {

	            $response['error'] = true;

	            $response['message'] = 'Could not move the file!';
}
	         $img_name = basename( $_FILES["fileToUpload"]["name"]);

	        $file_name = "photo_upload/".$img_name;

//echo $_FILES['fileToUpload']['tmp_name']."\n".$file_name."\n";



			$report = $db->storeReport($username,$category,$description,$title,$target_path,$latitude,$longitude);



			if($report){

				$response["error"] = false;

				$response["error_message"] = "Report sent";

				$response["uid"] = $report["id"];

				$response["report"]["username"] = $report["username"];

				$response["report"]["description"] = $report["description"];

				$response["report"]["title"] = $report["title"];

				echo json_encode($response);

			}else{

				$response["error"] = TRUE;

				$response["error_message"] = "Unknown error";

				echo json_encode($response);

			}

	        $response['message'] = 'File uploaded successfully!';

	        $response['error'] = false;

	    } catch (Exception $e) {

	        $response['error'] = true;

	        $response['message'] = $e->getMessage();

	    }

	} else {

	    $response['error'] = true;

	    $response['message'] = 'Not received any file!F';

	}

?>
