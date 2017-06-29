<?php

// print_r($_POST);

// $docroot;
// $baseurlminimal;
// if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
// 	$docroot = $_SERVER['DOCUMENT_ROOT']."/experiencenash_dev";
// 	$baseurlminimal = "/experiencenash_dev/";
// }else{
// 	$docroot = $_SERVER['DOCUMENT_ROOT'];
// 	$baseurlminimal = "/";
// }

require_once('classes/classes.php');
require_once('reusables/classes/Shortcuts.php');
$MainClasses = new MainClasses();

if(isset($_POST[ 'fieldarray' ])){ $fieldarray = $_POST[ 'fieldarray' ]; }else{ exit("missing parameters"); }

foreach ($fieldarray as $f) {
	$fieldvalue = $f['field_value'];
	$tablename = $f['tablename'];
	$colname = $f['col_name'];
	$rowid = $f['row_id'];
	// echo json_encode($f);
	$query = "UPDATE " . $tablename . " SET " . $colname . " = ? WHERE " . $tablename . ".id = ?";
	$values = [ $fieldvalue, $rowid ];
	$type = "update";
	$result = $MainClasses->querySQL( $query, $values, $type );
}

if( isset( $_POST['goto'] ) ){
	header( 'Location: /' . $_POST['goto'] );
}else{
	header( 'Location: /' );
}