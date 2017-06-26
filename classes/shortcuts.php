<?php

// namespace Reusables\Classes;

class Shortcuts {
	
	public static function changeURLForTesting($url){

			$docroot;
			$baseurlminimal;
			$baseurl;
			if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
				$docroot = $_SERVER['DOCUMENT_ROOT']."/experiencenash_dev";
				$baseurlminimal = "/experiencenash_dev/";
				// $baseurl = "http://" . $_SERVER['SERVER_NAME']."/experiencenash_dev";
				$baseurl = "http://" . $_SERVER['HTTP_HOST']."/experiencenash_dev";
			}else{
				$docroot = $_SERVER['DOCUMENT_ROOT'];
				$baseurlminimal = "/";
				// $baseurl = "http://" . $_SERVER['SERVER_NAME'];
				$baseurl = "http://" . $_SERVER['HTTP_HOST'];
			}

		$testroot = ["http://theanywherecard.com/", "https://theanywherecard.com/"];
		$testurls = ["https://theanywherecard.com/experiencenash_dev/", "http://theanywherecard.com/experiencenash_dev/"];
		if(substr($url, 0,1) == "/"){
			$url = substr_replace( $url, $baseurlminimal, 0, 1 );
		}else if(substr($url, 0, sizeof($testroot[0])) == $testroot[0] || substr($url, 0, sizeof($testroot[1])) == $testroot[1]){
			$change = true;
			$changeindex = 0;
			if(substr($url, 0, sizeof($testroot[1])) == $testroot[1]){$changeindex = 1;}
			foreach ($testurls as $u) {
				if(substr($url, 0, sizeof($u)) == $u){
					$change = false;
				}
			}
			if($change){
				$url = substr_replace( $url, $baseurlminimal, 0, $testroot[$changeindex] );
			}
		}else{

		}
		return $url;
	}

	public static function uploadImage($file){

		$docroot;
		$baseurlminimal;
		if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
			$docroot = $_SERVER['DOCUMENT_ROOT']."/experiencenash_dev";
			$baseurlminimal = "/experiencenash_dev/";
		}else{
			$docroot = $_SERVER['DOCUMENT_ROOT'];
			$baseurlminimal = "/";
		}

		$allowedImageExts = array("jpg", "jpeg", "gif", "png");
		$allowedVideoExts = array("mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
		$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
		$extension = pathinfo($file['name'], PATHINFO_EXTENSION);

		$extension = strtolower($extension);


		$uploadOk = 0;

		if( $file['name'] != null && $file['name'] != "" ){

			if (($file["size"] < 20000000) && in_array($extension, $allowedExts)){
		  
				$newname = time()."_".$file["name"];
				$newname = str_replace(" ", "_", $newname);

				if ($file["error"] > 0)
				{
					//echo "Return Code: " . $_FILES["mediapath"]["error"] . "<br />";
				}else{
					if (file_exists($docroot."/reusables/uploads/" . $newname)){
						$uploadOk = 0;
					}else{
						move_uploaded_file($file["tmp_name"], $docroot."/reusables/uploads/" . $newname);
						if(filesize($docroot.'/reusables/uploads/' . $newname) > 3000000){
							$scalefactor = round(100*(3000000 / filesize($docroot."/reusables/uploads/" . $newname)));
							$result = self::convertImage($docroot.'/reusables/uploads/' . $newname, $docroot.'/reusables/uploads/thumbs_small/' . $newname, $scalefactor);
						}else{
							$result = self::convertImage($docroot.'/reusables/uploads/' . $newname, $docroot.'/reusables/uploads/thumbs_small/' . $newname, 100);
						}
						$uploadOk = 1;
					}
				}
			}else{
				$uploadOk = 0;
			}

			if($uploadOk != 0){
				$mediapathname = $newname;
				$imagepath = $baseurlminimal . "reusables/uploads/".$mediapathname;
				return $imagepath;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public static function convertImage($originalImage, $outputImage, $quality)
	{
	    // jpg, png, gif or bmp?
	    //exit("hello");
	    $exploded = explode('.',$originalImage);
	    $ext = $exploded[count($exploded) - 1]; 

	    if (preg_match('/jpg|jpeg/i',$ext))
	        $imageTmp=imagecreatefromjpeg($originalImage);
	    else if (preg_match('/png/i',$ext))
	        $imageTmp=imagecreatefrompng($originalImage);
	    else if (preg_match('/gif/i',$ext))
	        $imageTmp=imagecreatefromgif($originalImage);
	    else if (preg_match('/bmp/i',$ext))
	        $imageTmp=imagecreatefrombmp($originalImage);
	    else
	        return 0;

	    // quality is a value from 0 (worst) to 100 (best)
	    imagejpeg($imageTmp, $outputImage, $quality);
	    imagedestroy($imageTmp);

	    return 1;
	}


}

?>