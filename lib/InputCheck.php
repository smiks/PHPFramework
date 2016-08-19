<?php

class InputCheck {

	public function __construct(){
	}


	public static function checkType($input, $type)
	{
		$type = strtolower($type);
		switch($type){
			case "email":
				return (filter_var($input, FILTER_VALIDATE_EMAIL));
			break;

			case "number":
				return (is_numeric($input));
			break;

			default:
				throw new Exception("INPUTCHECK_TYPE_NOT_FOUND");
			break;
		}
	}


	public static function checkLength($input, $requirement)
	{
		return strlen($input) >= $requirement;
	}


	public static function same($input1, $input2){
		if(gettype($input1) == gettype($input2) && $input1 == $input2)
			return true;
		return false;
	}


}