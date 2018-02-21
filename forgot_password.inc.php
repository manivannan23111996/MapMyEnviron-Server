<?php
require_once('DB_Functions.php');
$db = new DB_Functions();
$response = array("error"=>FALSE);
if(isset($_POST["femail"])){
	$email = $_POST["femail"];
	if($db->isEmailExisted($email)){
		$fcode = $db->generateVerificationCode();
		$to= $email;
		$name = "";
		$subject = 'Password Reset: Verification code for MapMyEnviron';
		$message = 'Hello Sir/Madam, <br><br>You have requested for password reset. This is your Activation code <b>'.$fcode.'</b>';
		$sendMail = $db->sendVerificationCode($to,$subject,$message,$name);
		//$sendMail=TRUE;
		if($sendMail){
			$user = $db->forgotAddCode($email,$fcode);
			if($user){
				$response["error"] = FALSE;
				$response["error_message"] = "Verification code Successfully sent";
				$response["uid"] = $user["id"];
				$response["user"]["email"] = $user["email"];
				$response["user"]["fcode"] = $user["fcode"];
				echo json_encode($response);
			}else{
				//unknown error...
				$response["error"] = TRUE;
				$response["error_message"] = "Unknown error occured";
				echo json_encode($response);
			}
		}else{
			//cnt send mail...
			$response["error"] = TRUE;
			$response["error_message"] = "Error while sending Verification code";
			echo json_encode($response);
		}
	}else{
		//not registered...
		$response["error"] = TRUE;
		$response["error_message"] = "This Email-ID is not registered";
		echo json_encode($response);		
	}
}else{
	//missing params...
	$response["error"] = TRUE;
	$response["error_message"] = "Missing Parameters";
	echo json_encode($response);	
}
?>