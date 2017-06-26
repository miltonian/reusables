<?php

// print_r($_POST);

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
require_once($docroot.'/reusables/classes/Shortcuts.php');
$MainClasses = new MainClasses();

if(isset($_POST[ 'form_name' ])){ $formname = $_POST[ 'form_name' ]; }else{ $formname = null; }
if(isset($_POST[ 'old_imagepath' ])){ $oldimagepath = $_POST[ 'old_imagepath' ]; }else{ $oldimagepath = null; }
if(isset($_POST[ 'imagechanged' ])){ $imagechanged = $_POST[ 'imagechanged' ]; }else{ $imagechanged = null; }
if(isset($_POST[ 'editor1' ])){ $editor1 = $_POST[ 'editor1' ]; }else{ $editor1 = null; }

// exit( json_encode( array( $formname, $oldimagepath, $imagechanged, $editor1 ) ) );

$query = "SELECT id FROM forms WHERE name = ?";
$values = [$formname];
$type = "select";
$result = $MainClasses->querySQL( $query, $values, $type );
// exit( json_encode( $result[0] ) );

if($_FILES[ 'formimg' ]['name'] != null && $_FILES[ 'formimg' ]['name'] != ""){
	$file = $_FILES[ 'formimg' ];
	$imagepath = Shortcuts::uploadImage($file);
}

if( $result[0] == 1 ){
	//found form
	$formid = $result[1][0]['id'];
	// exit( json_encode( $formid ) );
	if($_FILES[ 'formimg' ]['name'] != null && $_FILES[ 'formimg' ]['name'] != ""){
		// has image
		$query = "UPDATE forms SET time_created = ?, imagepath = ?, description = ? WHERE id = ?";
		$values = [ time(), $imagepath, $editor1, $formid ];
	}else{
		// no image
		$query = "UPDATE forms SET time_created = ?, description = ? WHERE id = ?";
		$values = [ time(), $editor1, $formid ];
	}
	$type = "update";
	$result = $MainClasses->querySQL( $query, $values, $type );
}else {
	//cant find form
	if($_FILES[ 'formimg' ]['name'] != null && $_FILES[ 'formimg' ]['name'] != ""){
		// has image
		$query = "INSERT INTO forms ( time_created, name, imagepath, description ) VALUES (?, ?, ?, ?)";
		$values = [ time(), $formname, $imagepath, $editor1 ];
	}else{
		// no image
		$query = "INSERT INTO forms ( time_created, name, description ) VALUES ( ?, ?, ? )";
		$values = [ time(), $formname, $editor1 ];
	}
	$type = "insert";
	$result = $MainClasses->querySQL( $query, $values, $type );
}

// exit(json_encode($result));

header( 'Location: ' . $baseurlminimal );



