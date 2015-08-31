<?php

class String {

	public function __construct(){
	}

	/* returns text with first letter in capital */
	public static function Capital($text)
	{
		$first = strtoupper(substr($text, 0, 1));
		$rest  = substr($text, 1);
		return ($first.$rest);
	}


	public static function getStringBetween($string, $start, $end)
	{
		$string = " ".$string;
		$ini = strpos($string,$start);
		if ($ini == 0) return "";
		$ini += strlen($start);
		$len = strpos($string,$end,$ini) - $ini;
		return substr($string,$ini,$len);
	}

	/* splits text at $splitAt length */
	public static function splitText($text, $splitAt)
	{
		if(strlen($text) < $splitAt){
			return ($text);
		}
		return self::splitTextHelper($text, $splitAt, "");
	}

	private static function splitTextHelper($text, $splitAt, $acc)
	{
		$textLen = strlen($text);
		if($textLen > $splitAt){
			$space = strpos($text, ' ', $splitAt);
		}
		else{
			return $acc.$text;
		}
		
		if($textLen > $splitAt && $space > 0){
			$partA  = substr($text, 0, $space);
			$partB .= substr($text, $space);
			$partA  = $partA."<br>";
			$acc    = $acc.$partA;
			return self::splitTextHelper($partB, $splitAt, $acc);
		}
		if($textLen > $splitAt && $space == 0){
			$text  = substr($text, 0, $splitAt);
			$text .= "...";
			return ($text);
		}
	}

}