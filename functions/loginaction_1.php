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

if(!isset($_POST['email'])){exit("missing parameters");}
if(!isset($_POST['password'])){exit("missing parameters");}

$email = $_POST[ 'email' ];
$password = $_POST[ 'password' ];

require_once($docroot . '/classes/Secure.php');
$SecureClasses = new SecureClasses();

$result = $SecureClasses->checkUserLogin( $email, $password );


if($result[0] == 1){
	session_start();
	$GLOBALS['userid'] = $result[1]['id'];
	if( isset( $_POST['goto'] ) ){
		header( 'Location: /' . $_POST['goto'] );
	}else{
		// exit("hey");
		header( 'Location: /' );
	}
}else{
	exit("Incorrect Login Information");
}

?>