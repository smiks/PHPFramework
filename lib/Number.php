<?php

class Numbers {

	public function __construct(){
	}

	public static function numberPostfix($number)
	{
		$postfix = "";
		if($number > 1000000000){
			$number /= 1000000000;
			$number = self::limitDecimal($number, 1);
			return $number."b";
		}
		elseif($number > 1000000){
			$number /= 1000000;
			$number = self::limitDecimal($number, 1);
			return $number."m";
		}
		elseif($number > 1000){
			$number /= 1000;
			$number = self::limitDecimal($number, 1);
			return $number."k";
		}
		else{
			return $number;
		}
	}


	public static function limitDecimal($number, $decimals)
	{
		$shift   = pow(10, $decimals);
		$number *= $shift; 
		$number  = (int)($number);
		return ($number/$shift);
	}
}