<?php
require_once("database.php");

class User {
	public function find_all() {
		global $database;
		$result_set = $database->query("select * from a_poin");
		return $result_set;
	}
	public static function find_by_id($id=0) {
		global $database;
		$result_set = $database->query("select * from a_poin where code=4");
		
		return $result_set;

	}
	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		return $result_set;
	}

	public static function find_by_idku($id="") {
		global $database;
	
		$result_set = $database->query("select * from a_user where email='{$id}'");
		
		return $result_set;

	}

	
}
?>