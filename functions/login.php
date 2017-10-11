<?php

if( !isset( $_POST[ 'username' ] ) ) { exit("missing parameters"); }
if( !isset( $_POST[ 'password' ] ) ) { exit("missing parameters"); }

$username = $_POST[ 'username' ];
$password = $_POST[ 'password' ];
if( isset( $_POST['tablename'] ) ) {
	$tablename = $_POST['tablename'];
}else{
	$tablename = "users";
}
if( isset( $_POST['username_col'] ) ) {
	$username_col = $_POST['username_col'];
}else{
	$username_col = "username";
}

require_once( BASE_DIR . '/vendor/miltonian/custom/data/DBClasses.php' );

$query = 'SELECT * FROM ' . $tablename . ' WHERE ' . $username_col . '=? AND password=?';

$result = DBClasses::checkLogin( $query, $username, $password );

if($result[0] == 1){
	// need to set user session
	session_start();
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