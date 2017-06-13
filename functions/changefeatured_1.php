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
$baseurl = "http://" . $_SERVER['SERVER_NAME'];
require_once($docroot.'/classes/classes.php');

$MainClasses = new MainClasses();

$theid = $_GET['id'];
$featuredid = $_GET['featuredid'];
//exit(json_encode(array($theid,$featuredid)));

$result = $MainClasses->updateFeaturedPost( $featuredid, $theid );
//exit(json_encode($result));
if($result[0] == 1){
	if(isset($_GET['fromurl'])){
		$fromurl = $_GET[ 'fromurl' ];
		header('Location: '.$fromurl);
	}else{
		header('Location: '.$baseurlminimal);
	}
}else{
	exit("Error: Something went wrong");
}