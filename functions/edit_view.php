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

// exit(json_encode($_FILES));


// require_once('classes/classes.php');
// require_once('vendor/miltonian/reusables/classes/Shortcuts.php');

$containsp = false;



$lastinsertid = false;

if(isset($_POST[ 'fieldarray' ])){ $fieldarray = $_POST[ 'fieldarray' ]; $containsp=true; }
if(isset($_POST[ 'fieldimage' ])){ $fieldimages = $_POST[ 'fieldimage' ]; $containsp=true; }
if(!$containsp){ exit("missing parameters"); }
// exit( json_encode( $fieldarray ) );
if( isset($fieldimages ) ) {
	$filesarray = array();
	$indexes = array_keys( $_FILES['fieldimage']['name']);
	$didfind = false;
	for ($i=0; $i < sizeof($_FILES['fieldimage']['name']); $i++) { 
		if( $_FILES['fieldimage']['size'][ $indexes[$i] ]['field_value'] > 0 ){;
			$filedict = [];
			$filedict['name'] = $_FILES['fieldimage']['name'][ $indexes[$i] ]['field_value'];
			$filedict['type'] = $_FILES['fieldimage']['type'][ $indexes[$i] ]['field_value'];
			$filedict['tmp_name'] = $_FILES['fieldimage']['tmp_name'][ $indexes[$i] ]['field_value'];
			$filedict['error'] = $_FILES['fieldimage']['error'][ $indexes[$i] ]['field_value'];
			$filedict['size'] = $_FILES['fieldimage']['size'][ $indexes[$i] ]['field_value'];
			array_push( $filesarray, $filedict );
		}
	}

	$i=0;
	foreach ($filesarray as $file) {
		$imagepath = Reusables\Shortcuts::uploadImage( $file );
		$fieldimages[$indexes[$i]]['field_value'] = $imagepath;
		$i++;
	}

	// foreach ($fieldimages as $fi) {
	// exit( json_encode( $_FILES['fieldimage']['name'] ) );
	for( $i=0; $i<sizeof($indexes);$i++ ){
		$fi = $fieldimages[$indexes[$i]];

		if( !isset($fi['field_value'] ) ){
			$fieldvalue = false;
		}else{
			$fieldvalue = $fi['field_value'];
		}
		if ($fieldvalue) {
			// exit( json_encode( $fieldimages ) );
			$tablename = $fi['tablename'];
			$colname = $fi['col_name'];
			$conditions = $fi['field_conditions'];
			$whereclause = "";
			$conditionvalues = [];
			for ($i=0; $i < sizeof($conditions); $i++) { 
				if( $i > 0 ){
					$whereclause .= " AND " . $tablename . "." . $conditions[$i]['key'] . "=? ";
				}else{
					$whereclause .= "WHERE " . $tablename . "." . $conditions[$i]['key'] . "=? ";
				}
				array_push( $conditionvalues, $conditions[$i]['value'] );
			}
			// echo json_encode($fi); echo "<br>";

			$query = "SELECT * FROM " . $tablename . " " . $whereclause;
			$values = $conditionvalues;
			$type = "select";
			// $result = $MainClasses->querySQL( $query, $values, $type );

			// exit( json_encode( $query ) );
			$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
			if($result[0] == 0){

			}else{
				$didfind=true;
				$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
				$values = array_merge( [ $fieldvalue ], $conditionvalues );
				$type = "update";
				// exit(json_encode($query));
				// $result = $MainClasses->querySQL( $query, $values, $type );

				// exit( json_encode( array( $query, $values, $type ) ) );
				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
			}
		}
	}

	if( !$didfind && sizeof($filesarray) > 0 ){
		// exit( json_encode( $filesarray ) );
		if( isset( $_POST['ifnone_insert'] ) ){
			if( $_POST['ifnone_insert'] == "1" ){ 
				$query = "INSERT INTO " . $tablename . " ( ";// . $colname . " = ? " . $whereclause;
				$questionmarks = "";
				$insertconditionvalues = [];
				for ($i=0; $i < sizeof($indexes); $i++) { 
					if( $fieldimages[ $indexes[$i] ]['col_name'] == 'id' ){
						continue;
					}
					if( $fieldimages[ $indexes[$i] ]['field_value'] == false ){
						continue;
					}
					if( sizeof($insertconditionvalues) > 0 ){
						$query .= ", " . $fieldimages[ $indexes[$i] ]['col_name'];
						$questionmarks .= ", ?";
					}else{
						$query .= $fieldimages[ $indexes[$i] ]['col_name'];
						$questionmarks .= "?";
					}
					array_push( $insertconditionvalues, $fieldimages[ $indexes[$i] ]['field_value'] );
				}
				$query .= " ) VALUES ( " . $questionmarks . ")";
				$values = $insertconditionvalues;
				$type = "insert";
				// exit( json_encode( $query ) );
				// $result = $MainClasses->querySQL( $query, $values, $type );
				// exit( "3" );
				// exit( json_encode( $query ) );
				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
				$lastinsertid = $result[1];
				// exit( json_encode( $lastinsertid ) );
			}
		}
	}


}


if (isset($fieldarray)) {
	$indexes = array_keys( $fieldarray );
	$didfind = false;
	foreach ($fieldarray as $f) {
		$fieldvalue = $f['field_value'];
		$tablename = $f['tablename'];
		$colname = $f['col_name'];
		// $rowid = $f['row_id'];
		$conditions = $f['field_conditions'];
		$whereclause = "";
		$conditionvalues = [];
		// exit( "lastinsertid: " . json_encode( $lastinsertid ) );
		if($conditions[0]['key']=="id" && $conditions[0]['value']=="" && $lastinsertid==true && $lastinsertid!=0 ){ $conditions[0]['value'] = $lastinsertid; }
		for ($i=0; $i < sizeof($conditions); $i++) { 
			if( $i > 0 ){
				$whereclause .= " AND " . $tablename . "." . $conditions[$i]['key'] . "=? ";
			}else{
				$whereclause .= "WHERE " . $tablename . "." . $conditions[$i]['key'] . "=? ";
			}
			array_push( $conditionvalues, $conditions[$i]['value'] );
		}

		$query = "SELECT * FROM " . $tablename . " " . $whereclause;
		$values = $conditionvalues;
		$type = "select";
		// exit( json_encode( $conditions ) );
		// $result = $MainClasses->querySQL( $query, $values, $type );
		// exit( "4" );
		// exit( json_encode( array( $query, $values, $type ) ) );
		$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

		// exit(json_encode($result));
		if($result[0] == 0){

		}else{
			$didfind=true;
			if($colname=='id'){
				continue;
			}
			// echo json_encode($f); echo "<br>";
			$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
			$values = array_merge( [ $fieldvalue ], $conditionvalues );
			$type = "update";
			// exit(json_encode($query));
			// $result = $MainClasses->querySQL( $query, $values, $type );
// exit( "5" );
			// exit( json_encode( array( $query, $values, $type ) ) );
			$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
		}
			
		
	}
	if( !$didfind ){
		if( isset( $_POST['ifnone_insert'] ) ){
			if( $_POST['ifnone_insert'] == "1" ){ 
				$query = "INSERT INTO " . $tablename . " ( ";// . $colname . " = ? " . $whereclause;
				$questionmarks = "";
				$insertconditionvalues = [];
				for ($i=0; $i < sizeof($indexes); $i++) { 
					if( $fieldarray[ $indexes[$i] ]['col_name'] == 'id' ){
						continue;
					}
					if( sizeof($insertconditionvalues) > 0 ){
						$query .= ", " . $fieldarray[ $indexes[$i] ]['col_name'];
						$questionmarks .= ", ?";
					}else{
						$query .= $conditions[$i]['key'];
						$questionmarks .= "?";
					}
					array_push( $insertconditionvalues, $fieldarray[ $indexes[$i] ]['field_value'] );
				}
				$query .= " ) VALUES ( " . $questionmarks . ")";
				$values = $insertconditionvalues;
				$type = "insert";
				// $result = $MainClasses->querySQL( $query, $values, $type );
				// exit( "6" );
				// exit( json_encode( $query ) );
				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
			}
		}
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