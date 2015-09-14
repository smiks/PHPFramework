<?php

class Model {

	private $_sql;
	private $usedOrAnd;

	/* function returns ID of insert */
	public function insertID($sql){
		global $c;
		mysqli_query($c, $sql);
		$id = mysqli_insert_id($c);
		return $id;
	}

	public function sql($sql, $return="array", $key=null){
		global $db;
		$q  = $db -> query($sql);
		if($return == "single"){
			return $db -> fetch_single($q);
		}
		elseif($return == "array"){
			$acc = array();

			while($r = $db -> fetch_row($q)){
				if(array_key_exists($key, $r)){
					$k = $r[$key];
					$acc[$k] = $r;
				}
				else{
					throw new Exception("SQL_ARRAY_KEY_NOTFOUND");
				}
			}
			return $acc;
		}
		else{
			throw new Exception("SQL_ARRAY_RETURN_METHOD_NOTFOUND");
		}

	}

	public function orm($query){
		$query = strtolower($query);
		if($query == "select"){
			$this->_sql = "SELECT <select> FROM `<table>` ";
		}
		elseif($query == "insert"){
			$this->_sql = "INSERT INTO `<table>` (<insertfields>) VALUES (<insertvalues>) ";
		}
		elseif($query == "update"){
			$this->_sql = "UPDATE `<table>` SET <set> ";
		}
		elseif($query == "remove"){
			$this->_sql = "DELETE FROM `<table>` ";
		}

		return $this;
	}

	public function table($table){
		$sl = $this->_sql;
		$sl = str_replace("<table>", $table, $sl);
		$this->_sql = $sl;
		return $this;
	}

	public function select($select){
		$sl = $this->_sql;
		$sl = str_replace("<select>", $select, $sl);
		$this->_sql = $sl;
		return $this;
	}

	public function selectAll(){
		$sl = $this->_sql;
		$sl = str_replace("<select>", "*", $sl);
		$this->_sql = $sl;
		return $this;
	}

	public function count($count){
		$sl = $this->_sql;
		$sl = str_replace("<select>", "COUNT({$count})", $sl);
		$this->_sql = $sl;
		return $this;
	}

	public function insert($data){
		$tmpInsert = "";
		$tmpValues = "";
		foreach ($data as $key => $value) {
			$tmpInsert .= $key.", ";
			$tmpValues .= "'".$value."', ";
		}
		$tmpInsert = rtrim($tmpInsert, ", ");
		$tmpValues = rtrim($tmpValues, ", ");
		$sl = $this->_sql;
		$sl = str_replace("<insertfields>", $tmpInsert, $sl);
		$sl = str_replace("<insertvalues>", $tmpValues, $sl);
		$this->_sql = $sl;
		return $this;
	}

	public function update($data){
		$tmpSet = "";
		foreach ($data as $key => $value) {
			$tmpSet .= "`".$key."` = '".$value."', ";
		}
		$tmpSet = rtrim($tmpSet, ", ");
		$sl = $this->_sql;
		$sl = str_replace("<set>", $tmpSet, $sl);
		$this->_sql = $sl;
		return $this;

	}

	public function where($what, $op, $toWhat){
		$sl = $this->_sql;
		$sl .= " <where> ";
		if($this->usedOrAnd){
			$sentence = "`".$what."`".$op."'".$toWhat."' ";
		}
		else{
			$sentence = "WHERE `".$what."`".$op."'".$toWhat."' ";	
		}
		
		$sl = str_replace("<where>", $sentence, $sl);
		$this->_sql = $sl;
		return $this;
	}

	public function whereAnd($what, $op, $toWhat){
		$sl = $this->_sql;
		$sl .= " <where> ";
				if($this->usedOrAnd){
			$sentence = "`".$what."`".$op."'".$toWhat."' AND ";
		}
		else{
			$sentence = "WHERE `".$what."`".$op."'".$toWhat."' AND ";	
		}
		$sl = str_replace("<where>", $sentence, $sl);
		$this->_sql = $sl;
		$this->usedOrAnd = true;
		return $this;
	}

	public function whereOr($what, $op, $toWhat){
		$sl = $this->_sql;
		$sl .= " <where> ";
				if($this->usedOrAnd){
			$sentence = "`".$what."`".$op."'".$toWhat."' OR ";
		}
		else{
			$sentence = "WHERE `".$what."`".$op."'".$toWhat."' OR ";
		}
		$sl = str_replace(" <where> ", $sentence, $sl);
		$this->_sql = $sl;
		$this->usedOrAnd = true;
		return $this;
	}

	public function limit($limit){
		$sl = $this->_sql;
		$sl .= "<limit>";
		$sentence = " LIMIT {$limit} ";
		$sl = str_replace("<limit>", $sentence, $sl);
		$this->_sql = $sl;
		return $this;
	}

	public function sqlRaw($sql){
		$this->_sql = $sql;
		return $this;
	}

	public function toSql(){
		$sl = $this->_sql;
		$sl .= ";";
		return $sl;
	}

	public function commit(){
		global $db;
		$sl = $this->_sql;
		$sl .= ";";
		$db->query($sl);
	}

	public function fetchRow(){
		global $db;
		$sl = $this->_sql;
		$sl .= ";";
		$q  = $db -> query($sl);
		$data = $db -> fetch_row($q);
		return ($data);
	}

	public function fetchSingle(){
		global $db;
		$sl = $this->_sql;
		$sl .= ";";
		$q  = $db -> query($sl);
		$data = $db -> fetch_single($q);
		return ($data);
	}

	public function execute($sql){
		global $db;
		$db -> query($sql);
	}

	public function __construct() {

	}


}