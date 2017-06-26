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

$query = "INSERT INTO users (time_created, first_name, last_name, email) VALUES ( ?, ?, ?, ? )";
$values = [time(), $firstname, $lastname, $email];
$type = "insert";
$result = $MainClasses->querySQL( $query, $values, $type );

$userid = $result[1];

header( 'Location: /signup?email='.$_POST['email'].'&goto=userprofile' );