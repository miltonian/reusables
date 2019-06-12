<?php

// authenticate the user
if( Reusables\Auth::check() == false ) {
		header('Location: /');
		exit();
}

$contains_parameters = false;

if( isset($_POST['forms']) ) {

	$forms = $_POST['forms'];
	$form_files = $_FILES;
} else {

	$forms = [$_POST];
	$form_files = [$_FILES];
}

$i = 0;
foreach ($forms as $form) {

	// check if there are normal form values to update/insert
	$fieldarray = [];
	if(isset($form[ 'fieldarray' ])){
			$fieldarray = $form[ 'fieldarray' ];
			$contains_parameters=true;
	}

	// check if there are images to update/insert
	if(isset($form[ 'fieldimage' ])){
			$fieldimages = $form[ 'fieldimage' ];
			$contains_parameters=true;
	}

	if(isset($form[ 'fieldimage_multiple' ])){
			$fieldimage_multiple = $form[ 'fieldimage_multiple' ];
	}

	if( !isset( $form['ifnone_insert'] ) ) {
		$form['ifnone_insert'] = "0";
	}

	if(!$contains_parameters){
		// if no parameters were passed then there's no reason to be here
		// exit("missing parameters");
		$i++;
		continue;
	}

	$saveform_result = Reusables\Editing::saveSmartFormValues($fieldimages, $fieldarray, $form_files[$i], $form['ifnone_insert']);
	$fieldarray = $saveform_result["fieldarray"];
	$fieldimages = $saveform_result["fieldimages"];
	$lastinsertid = $saveform_result["lastinsertid"];

	$i++;
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
