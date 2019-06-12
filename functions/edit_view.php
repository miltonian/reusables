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








if( isset($fieldimages ) ) {
		// images have been passed and need to be updated/inserted

		$indexes = array_keys( $_FILES['fieldimage']['name']);

		// loop through files and convert files from reusable format to normal file format
		$reusable_files_result = Reusables\Convert::reusableFiles($_FILES, $indexes);

		// put normal files in var
		$filesarray = $reusable_files_result['filesarray'];

		//	// skip
		// 	$filesarray_multiple = $reusable_files_result['filesarray_multiple'];
		// 	// skip
		// 	$filesarray_multiple = Reusables\Convert::getFilesFromFileMultiples($filesarray_multiple, $_FILES, $indexes);

		// loop through the files collected earlier in this file
		$fieldimages = Reusables\Media::uploadFieldImages( $_FILES, $filesarray, $indexes, $fieldimages );

		$fieldarray = Reusables\Editing::updateOrInsertDBValues( $fieldarray, $indexes, $fieldimages, $filesarray, $_POST['ifnone_insert'], true );

}






if ( sizeof($fieldarray) > 0 ) {
// normal form values have been passed and need to be updated/inserted

	$lastinsertid = Reusables\Editing::updateOrInsertDBValues( $fieldarray, $indexes, $fieldimages, $filesarray, $_POST['ifnone_insert'] );
}


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
