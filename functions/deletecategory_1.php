<?php

$docroot = $_SERVER['DOCUMENT_ROOT'];

require_once($docroot.'/classes/classes.php');

$MainClasses = new MainClasses();

if(!isset($_GET[ 'id' ]) ){ exit("missing parameters"); };

$categoryid = $_GET['id'];

//exit(json_encode($postid));

$result = $MainClasses->deleteCategory( $categoryid );

if($result[0] == 1){
	if(isset($_GET['fromurl'])){
		$fromurl = $_GET[ 'fromurl' ];
		header('Location: '.$fromurl);
	}else{
		header('Location: /');
	}
}else{
	exit("Error: Something went wrong");
}


?>