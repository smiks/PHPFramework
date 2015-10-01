<?php

class Time {

	public function __construct(){
	}

	/* returns date in SQL format yyyy-mm-dd */
	public static function dateDB(){
		$day = date('d');
		$month = date('m');
		$year  = date('Y');

		$date = $year."-".$month."-".$day;

		return ($date);
	}

	public static function dateTime(){
		return (date("H:i, d/M, Y"));
	}

	public static function secondsToTimeString($seconds)
	{
		if($seconds < 60)
		{
			return "{$seconds} s";
		}

		/* more than a day */
		if($seconds > 86400)
		{
			$days  = (int)($seconds / 86400);
			$diffd = $seconds - ($days * 86400);

			$hour  = (int)($diffd / 3600);
			$diffh = $diffd - ($hour * 3600);

			$min   = (int)($diffh / 60);
			$diffs = $diffh - ($min * 60);

			return "{$days} d &nbsp; {$hour} h &nbsp; {$min} min";			
		}

		/* more than an hour */
		if($seconds > 3600)
		{
			$hour  = (int)($seconds / 3600);
			$diffh = $seconds - ($hour * 3600);

			$min   = (int)($diffh / 60);
			$diffs = $diffh - ($min * 60);

			return "{$hour} h &nbsp; {$min} min &nbsp; {$diffs} s";
		}

		/* more than a minute */
		if($seconds > 60)
		{
			$min  = (int)($seconds / 60);
			$diff = $seconds - ($min * 60);

			return "{$min} min &nbsp; {$diff} s";
		}
	}

	/* works in combination with date format yyyy-mm-dd */
	public static function yesterday($date)
	{
		$da = explode("-", $date);
		$y = $da[0];
		$m = $da[1];
		$d = $da[2];

		/* if not first of the month, return only one day less*/
		if($d > 1){
			return($y."-".$m."-".($d-1));
		}
		
		/* check how many days has previous month */
		switch($m){
			case "01": $pd = 31; break;
			case "02": $pd = 28; break;
			case "03": $pd = 31; break;
			case "04": $pd = 31; break;
			case "05": $pd = 30; break;
			case "06": $pd = 31; break;
			case "07": $pd = 30; break;
			case "08": $pd = 31; break;
			case "09": $pd = 31; break;
			case "10": $pd = 30; break;
			case "11": $pd = 31; break;
			case "12": $pd = 30; break;
		}
		if(is_leap_year($y) && $m == "03"){
			$pd += 1;
		}

		/* check for previous month */
		switch($m){
			case "01": $pm = "12"; break;
			case "02": $pm = "01"; break;
			case "03": $pm = "02"; break;
			case "04": $pm = "03"; break;
			case "05": $pm = "04"; break;
			case "06": $pm = "05"; break;
			case "07": $pm = "06"; break;
			case "08": $pm = "07"; break;
			case "09": $pm = "08"; break;
			case "10": $pm = "09"; break;
			case "11": $pm = "10"; break;
			case "12": $pm = "11"; break;
		}

		/* check if it is 1st January to lower year */
		if($m == "01" && $d = "01"){
			$y -= 1;
		}

		return($y."-".$pm."-".($pd));
	}

}