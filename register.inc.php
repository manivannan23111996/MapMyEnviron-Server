<?php
require_once('DB_Functions.php');
$db = new DB_Functions();
$response = array("error"=>FALSE);
if($_POST['rname']!="" &&  $_POST['remail']!="" && $_POST['rusername']!="" &&  $_POST['rpassword']!=""){
	$name = $_POST['rname'];
	$email = $_POST['remail'];
	$username = $_POST['rusername'];
	$password = $_POST['rpassword'];
	$db->deleteTempUser($email);
	if ($db->isUsernameExisted($username)) {
		$response["error"] = TRUE;
		$response["error_message"] = "Username already existed";
		echo json_encode($response);
	}else if($db->isEmailExisted($email)){
		$response["error"] = TRUE;
		$response["error_message"] = "Email already existed";
		echo json_encode($response);
	}else{
		$vcode = $db->generateVerificationCode();
		$to= $email;
		$subject = 'Verification code for MapMyEnviron';
		$message = 'Hello '.$name.'. <br><br>Welcome to MapMyEnviron. This is your Activation code <b>'.$vcode.'</b>';
		$sendMail = $db->sendVerificationCode($to,$subject,$message,$name);
		//$sendMail = TRUE;
		if ($sendMail) {
			$user = $db->storeUser($name,$email,$username,$password,$vcode);
			if($user){
				$response["error"] = FALSE;
				$response["error_message"] = "Register Success";
				$response["uid"] = $user["id"];
				$response["user"]["username"] = $user["username"];
				$response["user"]["name"] = $user["name"];
				$response["user"]["email"] = $user["email"];
				$response["user"]["vcode"] = $user["vcode"];
				echo json_encode($response);
			}else{
				$response["error"] = TRUE;
				$response["error_message"] = "Unknown error";
				echo json_encode($response);
			}
		}else{
			$response["error"] = TRUE;
			$response["error_message"] = "Cannot send Verification code";
			echo json_encode($response);
		}
	}
}else{
	$response["error"] = TRUE;
	$response["error_message"] = "Required [parameters missing";
	echo json_encode($response);
}
?>