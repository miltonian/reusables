<?php

session_start();

$loggedin = false;
if( isset( $_SESSION['login'][0] ) ) {
	if( $_SESSION['login'][0] == 1 ) {
		$loggedin = true;
	}
}

if( !$loggedin ) {
	exit("not logged in");
}

if( !isset( $_GET['featured_id'] ) ) { exit("missing parameters"); }
if( !isset( $_GET['post_id'] ) ) { exit("missing parameters"); }
// exit( json_encode( $_GET['featured_id'] ) );
require_once( BASE_DIR . '/vendor/miltonian/custom/data/DBClasses.php' );

$featured_id = $_GET['featured_id'];
$post_id = $_GET['post_id'];

$query = 'UPDATE featured_content SET post_id=? WHERE id=?';
$values = [$post_id, $featured_id];
$type = 'update';
$result = DBClasses::querySQL( $query, $values, $type );
// exit( json_encode( [$result] ) );


if( isset( $_POST['added_file'] ) ) {
	if( $_POST['added_file'] != "" ) {
		include_once( BASE_DIR . '/vendor/miltonian/custom/functions/' . $_POST['added_file'] . '.php' );
	}
}

if( isset( $_GET['goto'] ) ){
	if( $_GET['goto'] == "" ) {
		header( 'Location: /' );
	}else{
		header( 'Location: ' . $_GET['goto'] );
	}
}else{
	header( 'Location: /' );
}