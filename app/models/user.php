<?php


require_once 'Model.php';

class user extends Model{
	public function __construct() {
		global $db;
		$q  = $db -> query("SELECT * FROM users WHERE id = '1' LIMIT 1;");
		$data = $db -> fetch_row($q);
		return ($data);
	}

}