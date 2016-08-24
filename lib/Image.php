<?php

class Image {

	public function __construct(){
	}

	public static function compress($source, $destination, $quality=80, $returnFormat="jpeg"){
		$info = getimagesize($source);
		switch($info['mime']){
			case "image/gif":
				$image = imagecreatefromgif($source);
			break;

			case "image/jpeg":
				$image = imagecreatefromjpeg($source);
			break;

			case "image/png":
				$image = imagecreatefrompng($source);
			break;

			default: throw new Exception("IMAGE_MIMETYPE_NOTSUPPORTED"); break;
		}

		switch($returnFormat){
			case "jpeg":
				imagejpeg($image, $destination, $quality);
			break;

			case "png":
				imagepng($image, $destination, $quality);
			break;

			default: throw new Exception("IMAGE_RETURNFORMAT_NOTSUPPORTED"); break;
		}

		return $destination;	
	}


	public static function resize($image, $width, $height, $crop=false){
		list($width, $height) = getimagesize($image);
		$ratio = $width / $height;
		if($crop){
			if($width > $height){
				$width = ceil($width - ($width*abs($r - $width/$height)));
			}
			else {
				$height = ceil($height - ($height*abs($r - $width/$height)));
			}

			$newwidth = $width;
			$newheight = $height;
		}
		else {
			if($width/$height > $r){
				$newwidth = $height*$r;
				$newheight = $height;
			}
			else {
				$newheight = $width / $r;
				$newwidth = $width;
			}
		}

		$source = $imagecreatefromjpeg($image);
		$destination = imagecreatetruecolor($newwidth, $newheight);

		imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		return $destination;
	}

}