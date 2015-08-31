<?php

class BBCode {

	public function __construct(){
	}


	public static function code2text($string)
	{
		$search  = array('@\[(?i)url=(.*?)\](.*?)\[/(?i)url\]@si', '@\[(?i)b\](.*?)\[/(?i)b\]@si', '@\[(?i)i\](.*?)\[/(?i)i\]@si', '@\[(?i)u\](.*?)\[/(?i)u\]@si', '@\[(?i)quote\=(.*?)](.*?)\[/(?i)quote\]@si');
		$replace = array('<a href="\\1">\\2</a>','<b>\\1</b>','<i>\\1</i>','<u>\\1</u>','<table class="chat_quote"><tr ><td><b>\\1</b> <big><big><b>"</b></big></big></td></tr><tr><td><center>\\2</center></td></tr><trstyle="border-width:0; border-style:none"><td style="text-align:right;"><big><big><b>"</b></big></big></td></tr></table>');

		$string = preg_replace($search, $replace, $string);

		$search2  = array(":)", ":(", "(:", "):");
		$replace2 = array("&#9786;", "&#9785;", "&#9786;", "&#9785;");
		$string = str_replace($search2, $replace2, $string);
		return ($string);
	}

}