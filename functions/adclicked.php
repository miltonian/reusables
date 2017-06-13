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
require_once($docroot.'/reusables/classes/shortcuts.php');
$MainClasses = new MainClasses();
$shortcuts = new Shortcuts();


if(!isset($_GET[ 'ad_id' ])){ exit("missing parameters"); }

$adid = $_GET[ 'ad_id' ];

// exit( json_encode( $adid ) );

$query = "SELECT * FROM tempads WHERE id=?";
$values = [ $adid ];
$type = "select";
$result = $MainClasses->querySQL( $query, $values, $type )[1][0];

$linkpath = $result['link_path'];
// exit(json_encode($linkpath));

$query = "INSERT INTO ad_clicks (time_created, ad_id) VALUES (?, ?)";
$values = [ time(), $adid ];
$type = "insert";
$result = $MainClasses->querySQL( $query, $values, $type )[1][0];

// exit( json_encode( $result ) );

header('Location: ' . $linkpath);