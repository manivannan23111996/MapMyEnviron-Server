<?php
/**
* 
*/
class DB_Functions
{
	private $conn;
	function __construct()
	{
		require_once 'DB_Connect.php';
		$db = new DB_Connect();
		$this->conn = $db->connect();
	}

	public function isUsernameExisted($username){
		$sql = "SELECT FROM users WHERE username='".$username."'";
		$result = pg_query($this->conn,$sql);
		$rows = pg_num_rows($result);
		if($rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function isEmailExisted($email){
		$sql = "SELECT FROM users WHERE email='".$email."'";
		$result = pg_query($this->conn,$sql);
		$rows = pg_num_rows($result);
		if($rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function storeUser($name,$email,$username,$password){
		$sql = "INSERT INTO users(name,email,username,password) VALUES('".$name."','".$email."','".$username."','".$password."')";
		//echo $sql;
		$result = pg_query($this->conn,$sql);
		if($result){
			$c_sql = "SELECT * FROM users WHERE email='".$email."'";
			$res = pg_query($this->conn,$c_sql);
			$user = pg_fetch_array($res);
			return $user;
		}else{
			return FALSE;
		}
	}
	public function getUser($username,$password){
		$sql = "SELECT * FROM users WHERE username='".$username."'";
		$result = pg_query($this->conn,$sql);
		$user = pg_fetch_array($result);
		if($user){ 
			$db_password = $user['password'];
			if($db_password == $password){
				return $user;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	public function sendVerificationCode($to,$subject,$message,$name){
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPAuth=true;
		                //$mail->SMTPDebug = 2;

		$mail->Host = "smtp.elasticemail.com";
		$mail->Port = 2525;
		$mail->SMTPSecure = "tls";
		$mail->Username = "manivannan23111996@gmail.com";
		$mail->Password = "5e829181-dbcb-43a2-a2e2-948a00a3bcc1";
		$mail->setFrom('manivannan23111996@gmail.com', 'MapMyEnviron');
		$mail->addReplyTo('manivannan23111996@gmail.com', 'First Last');
		$mail->addAddress($to, $name);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = 'This is a plain-text message body';
		if (!$mail->send()) {
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function generateVerificationCode() {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 5; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function verifyCode($username,$vcode){ 
		$sql = "SELECT * FROM mapxuser WHERE username='".$username."'";
		$result = pg_query($this->conn,$sql);
		$user = pg_fetch_array($result);
		if($user){
			$db_vcode = $user['vcode'];
			$name = $user['name'];
			$email = $user['email'];
			$password = $user['password'];
			if($db_vcode == $vcode){
				$sql = "INSERT INTO verifieduser(name,email,username,password) VALUES('".$name."','".$email."','".$username."','".$password."')";
				$resultv = pg_query($this->conn,$sql);
				if($resultv){
					$c_sql = "SELECT * FROM verifieduser WHERE email='".$email."'";
					$res = pg_query($this->conn,$c_sql);
					$user = pg_fetch_array($res);
					return $user;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
		return FALSE;
	}
	public function isVerifiedUsernameExisted($username){
		$sql = "SELECT * FROM verifieduser WHERE username='".$username."'";
		$result = pg_query($this->conn,$sql);
		$rows = pg_num_rows($result);
		if($rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
	} 

	public function deleteTempUser($email){
		$sql = "DELETE FROM mapxuser WHERE email='".$email."'";
		$result = pg_query($this->conn,$sql);
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function forgotAddCode($email,$fcode){
		$dsql = "DELETE FROM forgotuser WHERE email='".$email."'";
		$result = pg_query($this->conn,$dsql);
		$sql = "INSERT INTO forgotuser(email,fcode) VALUES('".$email."','".$fcode."')";
		$result = pg_query($this->conn,$sql);
		if($result){
			$c_sql = "SELECT * FROM forgotuser WHERE email='".$email."'";
			$res = pg_query($this->conn,$c_sql);
			$user = pg_fetch_array($res);
			return $user;
		}else{
			return FALSE;
		}
	}

	public function verifyForgotCode($email,$fcode){
		$sql = "SELECT * FROM forgotuser WHERE email='".$email."'";
		$result = pg_query($this->conn,$sql);
		$user = pg_fetch_array($result);
		if($user){ 
			$db_fcode = $user['fcode'];
			if($db_fcode == $fcode){
				return $user;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function changePassword($email,$password){
		$sql = "UPDATE verifieduser SET password='$password' WHERE email='$email'";
		$result = pg_query($this->conn,$sql);
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function storeReport($username,$category,$description,$title,$image,$latitude,$longitude){

		$sql = "INSERT INTO ".$category."(username,description,title,image,geom) VALUES('".$username."','".$description."','".$title."','".$image."',ST_GeomFromText('POINT(".$longitude." ".$latitude.")',4326))";

		//echo $sql;

		$result = pg_query($this->conn,$sql);

		if ($result) {

			$c_sql = "SELECT * FROM ".$category." WHERE username='".$username."'";

			$res = pg_query($this->conn,$c_sql);

			$user = pg_fetch_array($res);

			return $user;

		}else{

			return false;

		}

	}

	public function getImage($category,$id){		
		 $query = "SELECT image from ".$category." WHERE id='".$id."'";
                $result = pg_query($this->conn,$query);
                if($result){
                        $array = pg_fetch_array($result);
                        return $array['image'];
                }else

                return "";
}

public function isAdmin($serial_no){

$query = "SELECT * from admin_details";
$result = pg_query($this->conn,$query);
while ($row = pg_fetch_array($result)) {
    if($row["sim_serial"]==$serial_no)
     return $row;
}
return false;
}


public function DeleteUser($username){
		$check= "SELECT * FROM verifieduser WHERE username ='".$username."'";
		$run = pg_query($this->conn, $check);
		$rows = pg_num_rows($run);
		if($rows > 0){
			$sql = "DELETE FROM verifieduser WHERE username ='".$username."'";
		$query = pg_query($this->conn, $sql); 
		if($query){
			return true;
		}else{
			return false;
		}
		}else{
			return false;
		}
		
	}



public function DeleteFeature($id,$category){
		$sql = "SELECT username,description,severity,image,ST_AsText(geom) as geom FROM $category WHERE id='".$id."'";
		$query = pg_query($this->conn, $sql);
		$result = pg_fetch_array($query);
		$username = $result['username'];
		$description = $result['description'];
		$severity = $result['severity'];
		$image = $result['image'];
		$geom = $result['geom'];
		$sql1 = "INSERT INTO deletedfeature(id,username,category,description,severity,image,geom) VALUES ('".$id."','".$username."', '".$category."', '".$description."', ".$severity.", '".$image."',ST_GeomFromText('".$geom."',4326) )";
		$query1 = pg_query($this->conn, $sql1);
if($query1){
		$sql2 = "DELETE FROM $category WHERE id='".$id."'";
		$query2 = pg_query($this->conn, $sql2);
		$sql3 = "SELECT username FROM deletedfeature WHERE id=".$id." and category='".$category."' limit 1";
		$query3 = pg_query($this->conn, $sql3);
		$result3 = pg_fetch_array($query3);
		return $result3;
}
else
return false;
}

}
?>
