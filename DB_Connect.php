<?php
class DB_Connect{
	private $conn;
	public function connect(){
		$this->conn = pg_connect("host=localhost port=5432 dbname=irs user=postgres password=manichan");
		if($this->conn){
			return $this->conn;
		}else{
			return FALSE;
		}
	}
}
?>
