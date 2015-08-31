<?php

class Response {

	var $data;

	public function __construct($data = array()){
		$this->data = json_encode($data);
	}

	public function send(){
		header('Cache-Control: no-cache, must-revalidate');
    	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    	header('Content-type: application/json');

    	echo $this->data;
	}

}