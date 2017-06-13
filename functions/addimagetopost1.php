<?php

$docroot;
$baseurlminimal;
if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
	$docroot = $_SERVER['DOCUMENT_ROOT']."/experiencenash_dev";
	$baseurlminimal = "/experiencenash_dev/";
}else{
	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$baseurlminimal = "/";
}

require_once($docroot.'/classes/classes.php');

$MainClasses = new MainClasses();

$type = $_POST['type'];
$result = array( 0, array() );
if($type == "id"){
	if( isset( $_POST['image_id'] ) ){
		$imageid = $_POST['image_id'];
		$imagepath = $MainClasses->getPostImagesWithId( $imageid )[1]['imagepath'];
		$result = $MainClasses->insertPostImages( "0", $imagepath );
	}
}else if($type == "image"){
	set_time_limit (60);

	$allowedImageExts = array("jpg", "jpeg", "gif", "png");
	$allowedVideoExts = array("mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
	$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
	$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

	$extension = strtolower($extension);


	$uploadOk = 0;

	if( $_FILES[ 'image' ]['name'] != null && $_FILES[ 'image' ]['name'] != "" ){
		if (($_FILES["image"]["size"] < 20000000) && in_array($extension, $allowedExts)){
	  
			$newname = time()."_".$_FILES["image"]["name"];
			$newname = str_replace(" ", "_", $newname);

			if ($_FILES["image"]["error"] > 0)
			{
				//echo "Return Code: " . $_FILES["mediapath"]["error"] . "<br />";
			}else{
				if (file_exists($docroot."/reusables/uploads/" . $newname)){
					$uploadOk = 0;
				}else{
					move_uploaded_file($_FILES["image"]["tmp_name"], $docroot."/reusables/uploads/" . $newname);
					if(filesize($docroot.'/reusables/uploads/' . $newname) > 3000000){
						$scalefactor = round(100*(3000000 / filesize($docroot."/reusables/uploads/" . $newname)));
						$result = convertImage($docroot.'/reusables/uploads/' . $newname, $docroot.'/reusables/uploads/thumbs_small/' . $newname, $scalefactor);
					}else{
						$result = convertImage($docroot.'/reusables/uploads/' . $newname, $docroot.'/reusables/uploads/thumbs_small/' . $newname, 100);
					}
					$uploadOk = 1;
				}
			}
		}else{
			$uploadOk = 0;
		}
	}

	$result = array( 0, array() );
	if($uploadOk==1){
		$mediapathname = $newname;
		$theimage = "/reusables/uploads/".$mediapathname;
		$result = $MainClasses->insertPostImages( "0", $theimage );
	}
}


if($result[0] == 1){
	echo $result[1];
}else{
	echo "0";
}


function convertImage($originalImage, $outputImage, $quality)
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

function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}

