<?php

// authenticate the user
if( Reusables\Auth::check() == false ) {
		header('Location: /');
		exit();
}

$contains_parameters = false;

if( isset($_POST['forms']) ) {

}

// check if there are normal form values to update/insert
$fieldarray = [];
if(isset($_POST[ 'fieldarray' ])){
		$fieldarray = $_POST[ 'fieldarray' ];
		$contains_parameters=true;
}

// check if there are images to update/insert
if(isset($_POST[ 'fieldimage' ])){
		$fieldimages = $_POST[ 'fieldimage' ];
		$contains_parameters=true;
}

if(isset($_POST[ 'fieldimage_multiple' ])){
		$fieldimage_multiple = $_POST[ 'fieldimage_multiple' ];
}

if( !isset( $_POST['ifnone_insert'] ) ) {
	$_POST['ifnone_insert'] = "0";
}

if(!$contains_parameters){
	// if no parameters were passed then there's no reason to be here
	exit("missing parameters");
}








$saveform_result = Reusables\Editing::saveSmartFormValues($fieldimages, $fieldarray, $_FILES, $_POST['ifnone_insert']);
$fieldarray = $saveform_result["fieldarray"];
$fieldimages = $saveform_result["fieldimages"];
$lastinsertid = $saveform_result["lastinsertid"];


if( isset( $_POST['added_file'] ) ) {
	if( $_POST['added_file'] != "" ) {
		include_once( BASE_DIR . '/vendor/miltonian/custom/functions/' . $_POST['added_file'] . '.php' );
	}
}

if( isset( $_POST['goto'] ) ){
	if( $_POST['goto'] == "" ) {
		header( 'Location: /' );
	}else{
		header( 'Location: ' . $_POST['goto'] );
	}
}else{
	header( 'Location: /' );
}
