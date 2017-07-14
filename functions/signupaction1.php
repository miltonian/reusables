<?php

// $docroot;
// $baseurlminimal;
// if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
// 	$docroot = $_SERVER['DOCUMENT_ROOT']."/experiencenash_dev";
// 	$baseurlminimal = "/experiencenash_dev/";
// }else{
// 	$docroot = $_SERVER['DOCUMENT_ROOT'];
// 	$baseurlminimal = "/";
// }

if(!isset($_POST['email'])){exit("missing parameters");}
if(!isset($_POST['password'])){exit("missing parameters");}

$email = $_POST[ 'email' ];
$password = $_POST[ 'password' ];

require_once('classes/Secure.php');
$SecureClasses = new SecureClasses();

$result = $SecureClasses->signupNewUser( $email, $password );


if($result[0] == 1){
	Reusables\User\Session::setUser( $result[1] );
	// $_SESSION["token"] = $result[1]['login_token'];
	if( isset( $_POST['goto'] ) ){
		header( 'Location: /' . $_POST['goto'] );
	}else{
		header( 'Location: /' );
	}
}else{
	exit("Incorrect Login Information");
}

?>