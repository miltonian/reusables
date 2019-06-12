<?php

// authenticate the user
if( Reusables\Auth::check() == false ) {
		header('Location: /');
		exit();
}

$contains_parameters = false;

$lastinsertid = false;

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

if(!$contains_parameters){

	// if no parameters were passed then there's no reason to be here
	exit("missing parameters");
}


if( isset($fieldimages ) ) {
	// images have been passed and need to be updated/inserted

		$indexes = array_keys( $_FILES['fieldimage']['name']);

		$reusable_files_result = Reusables\Convert::reusableFiles($_FILES, $indexes);
		$filesarray = $reusable_files_result['filesarray'];
		$filesarray_multiple = $reusable_files_result['filesarray_multiple'];

		$fieldimages_dbinfo = $fieldimages[$indexes[0]];
		if( $fieldimages_dbinfo ) {

			// get tablename from image
			$tablename = $fieldimages_dbinfo['tablename'];

			// get column name from image
			$colname = Reusables\Convert::colname($fieldimages_dbinfo);

			// get conditions from image
			$conditions = Reusables\Convert::conditions($fieldimages_dbinfo);

			if( !isset( $tablenames_array[$tablename] ) ) {
				$tablenames_array[$tablename] = true;
			}

			$imagepathkey_and_imagepath = Reusables\Convert::imagepathKeyAndImagepathFromConditions($conditions, $tablename, $fieldimages, $indexes, 0);
			$imagepath_key = $imagepathkey_and_imagepath['imagepath_key'];
			$current_imagepath = $imagepathkey_and_imagepath['current_imagepath'];

			// skip this
			$filesarray_multiple = Reusables\Convert::getFilesFromFileMultiples($filesarray_multiple, $_FILES, $indexes);

	}


	// loop through the files collected earlier in this file
	$i=0;
	foreach ($filesarray as $file) {

		if( sizeof($filesarray)==0){
			$i++;
			if( $i > sizeof($filesarray) ) {
				break;
			}
			continue;
		}

		$fieldimages = Reusables\Media::uploadFieldImage( $_FILES, $file, $indexes, $i, $fieldimages, $filesarray_multiple );

		$i++;
	}

	$tablenames_array = [];
	for( $i=0; $i<sizeof($indexes);$i++ ){

		$fi = $fieldimages[$indexes[$i]];

		$did_find_and_update = Reusables\Editing::updateDBValueIfExists($fi);
	}

	if( !$did_find_and_update && sizeof($filesarray) > 0 ){

		if( isset( $_POST['ifnone_insert'] ) && sizeof($filesarray[0])>0  ){
			if( $_POST['ifnone_insert'] == "1" ){

				$fieldarray = Reusables\Editing::insertDBValues( $fieldarray, $indexes, $fieldimages, $tablename, $_POST['multiple_inserts'], $filesarray, $tablenames_array );
			}
		}
	}
}



$tablenames_array = null;
$tablenames_array = [];

if ( sizeof($fieldarray) > 0 ) {
// normal form values have been passed and need to be updated/inserted

	$tablenames_array = [];
	$indexes = array_keys( $fieldarray );
	$did_find_and_update = false;

	foreach ($fieldarray as $fi) {

		$did_find_and_update = Reusables\Editing::updateDBValueIfExists($fi);
	}

	if( !$did_find_and_update ) {

		if( isset( $_POST['ifnone_insert'] ) ){
			if( $_POST['ifnone_insert'] == "1" ){

				$lastinsertid = Reusables\Editing::insertDBImageValues( $fieldarray, $indexes, $fieldimages, $tablename, $_POST['multiple_inserts'] );
			}
		}
	}
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
