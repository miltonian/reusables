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

if(!isset($_GET[ 'id' ]) ){ exit("missing parameters"); };

$authorid = $_GET['id'];

//exit(json_encode($postid));

$result = $MainClasses->deleteAuthor( $authorid );

if($result[0] == 1){
	if(isset($_GET['fromurl'])){
		$fromurl = $_GET[ 'fromurl' ];
		//exit(json_encode($fromurl));
		header('Location: '.$fromurl);
	}else{
		header('Location: '.$baseurlminimal);
	}
}else{
	exit("Error: Something went wrong");
}


