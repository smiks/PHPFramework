<?php

class Mail {

	var $to;
	var $subject;
	var $body;
	var $headers;
	public function __construct($to, $subject, $body, $headers){
		if(is_null($to)){
			throw new Exception("MAIL_TO_FIELD_NULL");
		}
		elseif(is_null($subject)){
			throw new Exception("MAIL_SUBJECT_FIELD_NULL");
		}
		elseif(is_null($body)){
			throw new Exception("MAIL_BODY_FIELD_NULL");
		}
		elseif(is_null($headers)){
			throw new Exception("MAIL_HEADERS_NULL");
		}
		else{
			$this->to = $to;
			$this->subject = $subject;
			$this->body = $body;
			$this->headers = $headers;
		}
	}

	public function send(){
		return (mail($this->to, $this->subject, $this->body, $this->headers));
	}

}