<?php

class Controller{
	
	public $_CSRF_TOKEN;


	private function sum($a) {
		return array_sum(str_split($a));
	}

	public function generateCSRF() {
		$ok = false;
		while(!$ok) {
			$num = rand(10000000,90000000);
			if($this->sum($num) % 7 == 0) {
				$ok = true;
				$this->_CSRF_TOKEN = $num;
			}
		}
		return $this -> _CSRF_TOKEN;
	}

	public function checkCSRF($token, $forceStop = false) {
		global $_Domain, $_RefererDomain, $_CSRF;
		$sumToken = $this->sum($token);
		$result = $sumToken % 7 == 0 && $_Domain == $_RefererDomain && $sumToken > 0;
		if($_CSRF && !$result && $forceStop) {
			echo"CSRF ERROR";
			exit(1);
		}
		if($_CSRF && !$result && !$forceStop) {
			return false;
		}		
		return true;
	}

	public function show($view, $data = array()){
		$CSRF = $this -> _CSRF_TOKEN;
		$CSRFFORM = "<input type='hidden' name='csrf' value='{$CSRF}'>";
		if(is_array($data)){
			foreach ( $data as $key => $value ) {
				$$key = $value;
			}
		}
	
		ob_start();
			$file = "app/views/".$view;
			if(file_exists($file)){
				$content = file_get_contents($file);
				$search  = array("{%", "%}", "{{", "}}");
				$replace = array(" <?php ", " ?> ", '<?php echo"{$','}"; ?>'); 
				$content = str_replace($search, $replace, $content);
				$search  = array(
					'@\[(?i)include\](.*?)\[/(?i)include\]@si', 
					);
				$replace = array(
					"<?php if(file_exists('\\1')){include_once('\\1');} ?>", 
					);
				$content = preg_replace($search, $replace, $content);
				$output = eval("?>$content");
			}
			else{
				echo "File [{$file}] not found!";
			}
			$output = ob_get_contents();

		ob_clean();
		
		echo $output;
	
	}

	public function render($view, $data = array()){

		$file = "app/views/".$view;

		if(!file_exists($file)){
			echo "View [{$view}] not found!";
			ob_end_flush();
			return;
		}

		$cache = "cache/views/".filemtime($file).$view;

		$CSRF = $this -> _CSRF_TOKEN;
		$CSRFFORM = "<input type='hidden' name='csrf' value='{$CSRF}'>";
		if(is_array($data)){
			foreach ($data as $key => $value) {
				$$key = $value;
			}
		}
	
		if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
			ob_start("ob_gzhandler");	
		} 
		else{
			ob_start();
		}

		if(file_exists($cache)){
			$content = file_get_contents($cache);
		}
		else{
			$content = file_get_contents($file);
			$search  = array("{%", "%}", "{{", "}}", "\n", "  ", "\t", "	");
			$replace = array(" <?php ", " ?> ", '<?php echo"{$','}"; ?>', "", " ", "",""); 
			$content = str_replace($search, $replace, $content);
			$search  = array(
				'@\[(?i)include\](.*?)\[/(?i)include\]@si', 
				);
			$replace = array(
				"<?php if(file_exists('\\1')){include_once('\\1');} ?>", 
				);
			$content = preg_replace($search, $replace, $content);
			file_put_contents($cache, $content);

		}
		$output = eval("?>$content");

		$output = ob_get_contents();

		ob_end_flush();
	}	
	
}