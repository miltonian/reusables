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

$thearray = array();

$authorimg = $_POST[ 'authorimg' ];
$authorname = $_POST[ 'authorname' ];
$level = "2";

$defaultpic = 'https://theanywherecard.com/entrenash/media/images/defaultpicture.gif';

array_push( $thearray, $authorimg );
array_push( $thearray, $authorname );
//exit( json_encode($thearray) );


set_time_limit (60);

$allowedImageExts = array("jpg", "jpeg", "gif", "png");
$allowedVideoExts = array("mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
$extension = pathinfo($_FILES['authorimg']['name'], PATHINFO_EXTENSION);

$extension = strtolower($extension);

$uploadOk = 0;


if($_FILES["authorimg"]["name"] == null || $_FILES["authorimg"]["size"] == ""){
	//exit("hello");
	$imagepath = $defaultpic;
	$result = $MainClasses->insertAuthor( $authorname, $imagepath, $level );
	//if($result[0] == 1){
		$success = true;
	//}

}else if (($_FILES["authorimg"]["size"] < 20000000)
&& in_array($extension, $allowedExts))
  {

  $newname = time()."_".$_FILES["authorimg"]["name"];

  if ($_FILES["authorimg"]["error"] > 0)
    {
    	//echo "Return Code: " . $_FILES["mediapath"]["error"] . "<br />";
    }
  else
    {
    	//echo "Upload: " . $newname . "<br />";
    	//echo "Type: " . $_FILES["mediapath"]["type"] . "<br />";
    	//echo "Size: " . ($_FILES["mediapath"]["size"] / 1024) . " Kb<br />";
    	//echo "Temp file: " . $_FILES["mediapath"]["tmp_name"] . "<br />";

    	//if (file_exists("../media/uploads/" . $newname))
     	if (file_exists($docroot . "/reusables/uploads/" . $newname))
      	{
     		//echo $newname . " already exists. ";
    		$uploadOk = 0;
      	}
    else
      {
      	move_uploaded_file($_FILES["authorimg"]["tmp_name"], $docroot . "/reusables/uploads/" . $newname);

	    //echo "Stored in: " . "uploads/" . $newname;
	    $uploadOk = 1;
      }
    }
  }
else
  {
  //echo "Invalid file";
  $uploadOk = 0;
  }

  $success = false;


if($uploadOk != 0){

	$mediapathname = $newname;

	//$imagepath = "https://theanywherecard.com/entrenash/media/uploads/".$mediapathname;
	//$imagepath = "https://theanywherecard.com/entrenash/editing/images".$mediapathname;
	$imagepath = $docroot."/reusables/uploads".$mediapathname;
	if( in_array($extension, $allowedVideoExts) ){
		exit("cannot be video");
	}else{

		$result = $MainClasses->insertAuthor( $authorname, $imagepath, $level );

	}


	if($result[0] == 1){
		$success = true;
	}

}



//if( $success == true ){
exit(json_encode($result[1]));
	if(isset($_POST['fromurl'])){
		//$fromurl = $_POST[ 'fromurl' ];
		//header('Location: '.$fromurl);
	}else{
		//header('Location: http://theanywherecard.com/entrenash/editing');
	}

/*}else{
	exit( "Error: Something went wrong" );
}*/
