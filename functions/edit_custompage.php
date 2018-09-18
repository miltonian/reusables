<?php

$docroot;
$baseurlminimal;
if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
	$docroot = $_SERVER['DOCUMENT_ROOT']."/tribebuilders";
	$baseurlminimal = "/tribebuilders/";
}else{
	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$baseurlminimal = "/";
}

require_once($docroot.'/classes/classes.php');
require_once($docroot.'/reusables/classes/Shortcuts.php');
$MainClasses = new MainClasses();

// var_dump($_POST);
$keyarray = array();
$valuearray = array();
foreach ($_POST as $key => $value) {
	//if key starts with...
	$keystrings = explode( "_", $key);
	if($keystrings[0] == "name"){
		array_push($keyarray, $keystrings[1]);
	    array_push($valuearray, $value);
	}
}

foreach ($_FILES as $key => $value) {
	//if key starts with...
	if($_FILES[$key]['name'] != ""){
		$keystrings = explode( "_", $key);
		if($keystrings[0] == "name"){
			array_push($keyarray, $keystrings[1]);
		    // array_push($valuearray, Shortcuts::uploadImage($value) );
				array_push($valuearray, Media::uploadImage($value) );
		}
	}
}

if(isset($_POST[ 'custompage_id' ])){ $custompageid = $_POST[ 'custompage_id' ]; }else{ $custompageid = null; }
// if(isset($_POST[ 'name' ])){ $name = $_POST[ 'name' ]; }else{ $name = null; }
// if(isset($_POST[ 'fieldvalue' ])){ $fieldvalue = $_POST[ 'fieldvalue' ]; }else{ $fieldvalue = null; }

//loop through each name/value pair
for ($i=0; $i < sizeof($keyarray); $i++) {

	//look for match
	$query = "SELECT id FROM custompage_values WHERE custompage_id=? AND fieldname=?";
	$values = [$custompageid, $keyarray[$i]];
	$type = "select";
	$result = $MainClasses->querySQL( $query, $values, $type );

	if($result[0] == 1){
		//if found, update row
		$query = "UPDATE custompage_values SET fieldvalue=?, time_updated=? WHERE id=?";
		$values = [$valuearray[$i], time(), $result[1][0]['id']];
		$type = "update";
		$result = $MainClasses->querySQL( $query, $values, $type );
	}else {
		//if not found, insert row
		$query = "INSERT INTO custompage_values (time_created, custompage_id, fieldname, fieldvalue) VALUES (?, ?, ?, ?)";
		$values = [time(), $custompageid, $keyarray[$i], $valuearray[$i]];
		$type = "update";
		$result = $MainClasses->querySQL( $query, $values, $type );

	}

}

if(isset($_POST['goto'])){
	header('Location: ' . $baseurlminimal . $_POST['goto']);
}else{
	header('Location: ' . $baseurlminimal);
}
