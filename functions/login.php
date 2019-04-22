<?php

if( !isset($_POST['email']) ){ exit("missing parameters"); }
if( !isset($_POST['password']) ){ exit("missing parameters"); }

$email = $_POST['email'];
$password = $_POST['password'];

$result = DBClasses::querySQL('SELECT * FROM users WHERE email=?', [$email], 'select');


if( $result[0] == 0 ) {
  exit(json_encode($result));
}

$user_dict = $result[1][0];
$hashed_password = $user_dict['password'];
if( password_verify($password, $hashed_password) ) {

	// need to set user session
  if (session_status() == PHP_SESSION_NONE) {
  	session_start();
  }
	$_SESSION['login'] = $result;

	if( isset( $_POST['goto'] ) ){
		if( $_POST['goto'] == "" ) {
			header( 'Location: /' );
		}else{
			header( 'Location: ' . $_POST['goto'] );
		}
	}else{
		header( 'Location: /' );
	}
}else{
	exit("Incorrect Login Information");
}
