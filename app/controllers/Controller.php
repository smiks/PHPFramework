<?php

class Controller {
	
	public $_CSRF_TOKEN;



	public function show($view, $data = array()){
		
		foreach ( $data as $key => $value ) {
			$$key = $value;
		}
	
		// works
		ob_start();
			$file = "app/views/".$view;
			if(file_exists($file)){
				$content = file_get_contents($file);
				$search  = array("{%", "%}", "{{", "}}");
				$replace = array(" <?php ", " ?> ", '<?php echo"{$','}"; ?>'); 
				$content = str_replace($search, $replace, $content);

				$search  = array('@\[(?i)include\](.*?)\[/(?i)include\]@si');
				$replace = array("<?php if(file_exists('\\1')){include_once('\\1');} ?>");

				$content = preg_replace($search, $replace, $content);
				$output = eval("?>$content");
			}
			else{
				echo "File [{$file}] not found!";
			}
			$output = ob_get_contents();


		
		ob_end_clean();
	
		// also works
		/*$file = file_get_contents("../app/views/".$view);
			$output = eval("?>$file");*/
	
		echo $output;
	
	}
	
}