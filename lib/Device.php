<?php

class Device {

	var $data;

	public function __construct(){
	}

	/* if save is set - it will save result in session*/
	public static function isMobile($save = false){
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$iPhone = false;
		$operaMini = false;
		$android = false;
		$iPhonetext="iPhone";
		$androidtext="Android";
		$operaminitext="Opera Mini";

		/* step 1 */
		for($i=0; $i<strlen($browser);$i++){
			if(substr($browser,$i,strlen($operaminitext)) == $operaminitext){
				if($save)
					$_SESSION['mobile'] = true;
				return true;
			}
			elseif(substr($browser,$i,strlen($androidtext)) == $androidtext){
				if($save)
					$_SESSION['mobile'] = true;
				return true;
			}
			elseif(substr($browser,$i,strlen($iPhonetext)) == $iPhonetext){
				if($save)
					$_SESSION['mobile'] = true;
				return true;
			}
		}

		/* if step 1 can not detect it try with step 2 */
		/* step 2 */
		$pattern = "/(Android|Mobile|iPhone|iPad|(Windows Phone)|BlackBerry|(Opera Mini)|symbian)/i";
		if(preg_match($pattern, $browser)){
			return true;
		}

		if($save)
			$_SESSION['mobile'] = false;
		return false;
	}

}