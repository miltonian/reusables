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
require_once($docroot.'/reusables/classes/Shortcuts.php');
$MainClasses = new MainClasses();

if(isset($_POST[ 'first_name' ])){ $firstname = $_POST[ 'first_name' ]; }else{ $firstname = null; }
if(isset($_POST[ 'last_name' ])){ $lastname = $_POST[ 'last_name' ]; }else{ $lastname = null; }
if(isset($_POST[ 'email' ])){ $email = $_POST[ 'email' ]; }else{ $email = null; }

$fullname = $firstname . $lastname;
$userslug = preg_replace('/\s+-\s*|\s*-\s+/','-',$fullname);

$query = "INSERT INTO users (time_created, slug, first_name, last_name, email) VALUES ( ?, ?, ?, ?, ? )";
$values = [time(), $userslug, $firstname, $lastname, $email];
$type = "insert";
$result = $MainClasses->querySQL( $query, $values, $type );

$userid = $result[1];

$MainClasses->generateNewUserSlug( $userid, $userslug, 0 );

header( 'Location: /signup?email='.$_POST['email'].'&goto=userprofile' );