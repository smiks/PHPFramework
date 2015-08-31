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

}