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

$MainClasses = new MainClasses();

if(isset($_POST[ 'first_name' ])){ $firstname = $_POST[ 'first_name' ]; }else{ $firstname = null; }
if(isset($_POST[ 'last_name' ])){ $lastname = $_POST[ 'last_name' ]; }else{ $lastname = null; }
if(isset($_POST[ 'email' ])){ $email = $_POST[ 'email' ]; }else{ $email = null; }
$typeofpartner = null;
if(!empty($_POST['check_list'])) {
	$typeofpartner = "";
	$i=0;
    foreach($_POST['check_list'] as $check) {
    	if($i==0){ 
    		$typeofpartner="{"; 
	    }else{
	    	$typeofpartner = $typeofpartner . ",";
	    }
        $typeofpartner = $typeofpartner . $check;

        if($i==(sizeof($_POST['check_list'])-1)){ $typeofpartner=$typeofpartner . "}"; }
        $i++;
    }
}

$keyvalues = array(
	["key"=>"first_name", "value" => $firstname],
	["key"=>"last_name", "value" => $lastname],
	["key"=>"email", "value" => $email],
	["key"=>"type_of_partner", "value" => $typeofpartner]
);

$nonnullkeyvalues = array();
array_push( $nonnullkeyvalues, [ "key"=>"time_created", "value"=>time() ] );

foreach ($keyvalues as $pair) {
	if ($pair['value']!=null) {
		array_push( $nonnullkeyvalues, $pair );
	}
}
// exit(json_encode($nonnullkeyvalues));
$query = 'INSERT INTO partner_submissions ('; 
for ($i=0; $i < sizeof($nonnullkeyvalues); $i++) { 
	if ($i>0) {
		$query = $query . ',';
	}
	$query = $query . $nonnullkeyvalues[$i]['key'];
}
$query = $query . ') VALUES (';
for ($i=0; $i < sizeof($nonnullkeyvalues); $i++) { 
	if ($i>0) {
		$query = $query . ',';
	}
	$query = $query . '?';
}
$query = $query . ')';

$values = array();
foreach ($nonnullkeyvalues as $pair) {
	array_push( $values, $pair['value'] );
}

$type = "insert";
// exit(json_encode( $values ));
$result = $MainClasses->querySQL( $query, $values, $type )[1];

header( 'Location: ' . $baseurlminimal );







?>