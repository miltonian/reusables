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

$name = $_POST[ 'categoryname' ];

$result = $MainClasses->insertCategory( $name );

if($result[0] == 1){
	if(isset($_POST['from_url'])){
		if($_POST['from_url'] != ""){
			$fromurl = $_POST[ 'from_url' ];
			header('Location: '.$fromurl);
		}else{
			header('Location: '.$baseurlminimal);
		}
		
	}else{
		header('Location: '.$baseurlminimal);
	}
}else{
	exit("Error: Something went wrong");
}

?>