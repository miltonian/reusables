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

$result = array( 0, array() );

if( isset( $_POST['image_id'] ) ){
	$imageid = $_POST['image_id'];
	$result = $MainClasses->getPostImagesWithId( $imageid );
}



if($result[0] == 1){
	echo json_encode( $result[1] );
}else{
	echo json_encode( array() );
}
