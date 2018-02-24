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
<<<<<<< HEAD
// exit( json_encode( $_POST ) );
=======

>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2


$lastinsertid = false;

if(isset($_POST[ 'fieldarray' ])){ $fieldarray = $_POST[ 'fieldarray' ]; $containsp=true; }
if(isset($_POST[ 'fieldimage' ])){ $fieldimages = $_POST[ 'fieldimage' ]; $containsp=true; }
if(!$containsp){ exit("missing parameters"); }
// exit( json_encode( $fieldimages ) );
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
		}else{
			array_push($filesarray, []);
		}
	}
// exit( json_encode( $_FILES['fieldimage']['name'] ) );
	$i=0;
	foreach ($filesarray as $file) {
		if( sizeof($filesarray)==0){
			$i++;
			if( $i > sizeof($filesarray) ) {
break;
			}
			continue;
		}
		if( $_FILES['fieldimage']['name'][$indexes[$i]]['field_value'] != "" ) {
			$imagepath = Reusables\Shortcuts::uploadImage( $file );
			$fieldimages[$indexes[$i]]['field_value'] = $imagepath;
		}
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
			if( !isset($fi['field_conditions']) ) {
				$conditions = false;
			}else{
				$conditions = $fi['field_conditions'];
			}

			if( $conditions ) {
				$whereclause = "";
				$conditionvalues = [];
				for ($a=0; $a < sizeof($conditions); $a++) { 
					if( $a > 0 ){
						$whereclause .= " AND " . $tablename . "." . $conditions[$a]['key'] . "=? ";
					}else{
						$whereclause .= "WHERE " . $tablename . "." . $conditions[$a]['key'] . "=? ";
					}
					array_push( $conditionvalues, $conditions[$a]['value'] );
				}

				// echo json_encode($fi); echo "<br>";

				$query = "SELECT * FROM " . $tablename . " " . $whereclause;
				$values = $conditionvalues;
				$type = "select";
				// $result = $MainClasses->querySQL( $query, $values, $type );

				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
				// if($i==3){
					// exit( json_encode( $conditions ) );
				// }
				// exit( json_encode( $query ) );

				if($result[0] == 0){

				}else{

					$didfind=true;
					$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
					$values = array_merge( [ $fieldvalue ], $conditionvalues );
					$type = "update";
					// $result = $MainClasses->querySQL( $query, $values, $type );

					// exit( json_encode( array( $query, $values, $type ) ) );
					$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
				}
			}

		}
	}


	if( !$didfind && sizeof($filesarray) > 0 ){
		// exit( json_encode( $filesarray ) );
<<<<<<< HEAD
<<<<<<< HEAD
		if( isset( $_POST['ifnone_insert'] ) && sizeof($filesarray[0]) > 0 ){
=======
		if( isset( $_POST['ifnone_insert'] ) && sizeof($filesarray[0])>0  ){
>>>>>>> da6eeb0... improved functionality for 'place'. added views: title_subtitle, image_view, toggle
=======
		if( isset( $_POST['ifnone_insert'] ) && sizeof($filesarray[0])>0  ){
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
			if( $_POST['ifnone_insert'] == "1" ){ 
				$sizeofarraystoinsert = 0;
				$keys_found = [];

				if( isset( $_POST['multiple_inserts'] ) ){
					if( $_POST['multiple_inserts'] == "1" ) {
						// exit( json_encode( $fieldimages ) );
						$arraytoinsert_i=0;
						foreach ($fieldimages as $key) {
							// exit( json_encode( $fieldimages ) );
							if( !isset($keys_found[$key['col_name']]) ) {
								$keys_found[$key['col_name']] = true;
							}else{
								$sizeofarraystoinsert = $arraytoinsert_i;
								break;
							}
							$arraytoinsert_i++;
						}
					}
				}
				if( isset( $_POST['multiple_inserts'] ) ){
					if( $_POST['multiple_inserts'] == "1" ) {
						// exit( json_encode( sizeof($indexes) ) );
						for ($i=0; $i < (sizeof($indexes)); $i++) { 
							// if( !isset($fieldimages) ){
							// 	$fieldimages = [];
							// }
							// if( !isset($fieldarray) ){
							// 	$fieldarray = [];
							// }
							// echo $i;
							if( $sizeofarraystoinsert == 0 ) {
								$fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $tablename, $i, 1, true );
							}else{
								$fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $tablename, $i, $sizeofarraystoinsert, true );
							}

							if( ($i+$sizeofarraystoinsert-1) > $i ) {
								$i=($i+$sizeofarraystoinsert-1);
							}
						}
					}else{
						$fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $tablename );
					}
				}else{
					$fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $tablename );
				}

			}
		}
	}

}

// exit( json_encode( $fieldarray ) );;
if (isset($fieldarray)) {
	// exit("1");
	$indexes = array_keys( $fieldarray );
	$didfind = false;
	$testi=0;
	foreach ($fieldarray as $f) {
		$fieldvalue = "";
		$tablename = "";
		$colname = "";
		if( isset( $f['field_value'] ) ) {
			$fieldvalue = $f['field_value'];
		}
		if( isset( $f['tablename'] ) ) {
			$tablename = $f['tablename'];
		}
		if( isset( $f['col_name'] ) ) {
			$colname = $f['col_name'];
		}
		// $rowid = $f['row_id'];
		if( !isset($f['field_conditions']) ) {
			$conditions = false;
		}else{
			$conditions = $f['field_conditions'];
		}
		if( $conditions ) {
			// exit( json_encode( $conditions ) );
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

			}else if( isset($f['field_conditions']) ) {
				$didfind=true;
				if($colname=='id'){
					continue;
				}
				// echo json_encode($f); echo "<br>";
				$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
				$values = array_merge( [ $fieldvalue ], $conditionvalues );
				$type = "update";
				// if( $testi==3 ){
				// 	exit( json_encode( [$conditions] ) );
				// }
				// exit(json_encode($indexes));
				// $result = $MainClasses->querySQL( $query, $values, $type );
	// exit( "5" );
				// exit( json_encode( array( $query, $values, $type ) ) );
				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
				
			}
		}
		$testi++;
	}
	// exit( json_encode( $didfind ) );
	if( !$didfind ){
		// exit( json_encode( $_POST['ifnone_insert'] ) );
		if( isset( $_POST['ifnone_insert'] ) ){
			if( $_POST['ifnone_insert'] == "1" ){ 
				$sizeofarraystoinsert = 0;
				$keys_found = [];

				if( isset( $_POST['multiple_inserts'] ) ){
					if( $_POST['multiple_inserts'] == "1" ) {
						// exit( json_encode( $fieldarray ) );
						$arraytoinsert_i=0;
						foreach ($fieldarray as $key) {
							if( !isset($keys_found[$key['col_name']]) ) {
								$keys_found[$key['col_name']] = true;
							}else{
								$sizeofarraystoinsert = $arraytoinsert_i;
								break;
							}
							$arraytoinsert_i++;
						}
					}
				}

				if( isset( $_POST['multiple_inserts'] ) ){
					if( $_POST['multiple_inserts'] == "1" ) {
						// exit( json_encode( $sizeofarraystoinsert ) );
						for ($i=0; $i < (sizeof($indexes)); $i++) { 
							if( !isset($fieldimages) ){
								$fieldimages = null;
							}else if( sizeof($fieldimages) == 0 ) {
								$fieldimages = null;
							}
							// echo $i;
							// exit( json_encode( $tablename ) );
<<<<<<< HEAD
							$lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename, $i, $sizeofarraystoinsert );
=======
							insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename, $i, $sizeofarraystoinsert );
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
							$i=($i+$sizeofarraystoinsert-1);
						}
					}else{
						if( !isset( $fieldimages ) ) {
							$fieldimages = [];
						}
<<<<<<< HEAD
						$lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename );
=======
						insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename );
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
					}
				}else{
					if( !isset( $fieldimages ) ) {
						$fieldimages = [];
					}
<<<<<<< HEAD
					$lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename );
=======
					insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename );
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
				}
				
				// exit("done");
			}
		}
	}
}

<<<<<<< HEAD
if( isset( $_POST['added_file'] ) ) {
	if( $_POST['added_file'] != "" ) {
		include_once( BASE_DIR . '/vendor/miltonian/custom/functions/' . $_POST['added_file'] . '.php' );
	}
}
=======
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2

if( isset( $_POST['goto'] ) ){
	if( $_POST['goto'] == "" ) {
		header( 'Location: /' );
	}else{
		header( 'Location: ' . $_POST['goto'] );
	}
}else{
	header( 'Location: /' );
}




function insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename, $starting_i=0, $sizeofarraystoinsert=(-1) )
{
	$query = "INSERT INTO " . $tablename . " ( ";// . $colname . " = ? " . $whereclause;
	$questionmarks = "";
	$insertconditionvalues = [];
	// exit( json_encode( $sizeofarraystoinsert ) );
	if( $sizeofarraystoinsert == -1 ) {
		$sizeofarraystoinsert = sizeof($indexes);
	}
	for ($i=$starting_i; $i < $starting_i+$sizeofarraystoinsert; $i++) { 
		if( $i < sizeof( $indexes ) ) {
			$arrayorimages = $fieldarray;
			if( !isset( $fieldarray[ $indexes[$i] ]['col_name'] ) ) {
				if( !isset( $fieldimages[ $indexes[$i] ]['col_name'] ) ) {
					continue;
				}else{
					$arrayorimages = $fieldimages;
				}
			}
			if( $arrayorimages[ $indexes[$i] ]['col_name'] == 'id' ){
				continue;
			}
			if( sizeof($insertconditionvalues) > 0 ){
				$query .= ", " . $arrayorimages[ $indexes[$i] ]['col_name'];
				$questionmarks .= ", ?";
			}else{
				// exit(json_encode($i));
				// $query .= $conditions[$i]['key'];
				$query .= $arrayorimages[ $indexes[$i] ]['col_name'];
				$questionmarks .= "?";
			}
			array_push( $insertconditionvalues, $arrayorimages[ $indexes[$i] ]['field_value'] );
		}
		
	}

	$query .= " ) VALUES ( " . $questionmarks . ")";
	if( $starting_i > 0 ) {
// exit( json_encode( [$starting_i, $sizeofarraystoinsert] ) );
	}
	// exit( json_encode( $query ) );
	$values = $insertconditionvalues;
	$type = "insert";
	// $result = $MainClasses->querySQL( $query, $values, $type );
	// exit( "6" );
	// exit( json_encode( array( $query, $insertconditionvalues ) ) );
	$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
<<<<<<< HEAD
	return $result;
=======
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
}



function insertimage( $indexes, $fieldarray, $fieldimages, $tablename, $starting_i=0, $sizeofarraystoinsert=(-1), $multiple_inserts=false )
{
	$query = "INSERT INTO " . $tablename . " ( ";// . $colname . " = ? " . $whereclause;
	$questionmarks = "";
	$insertconditionvalues = [];

	if( $sizeofarraystoinsert == -1 ) {
		$sizeofarraystoinsert = sizeof($indexes);
	}

	for ($i=$starting_i; $i < $starting_i+$sizeofarraystoinsert; $i++) { 
		if( $i < sizeof( $indexes ) ) {
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
			
			if( $multiple_inserts ) {
				$dict = [
					["field_value" => $fieldimages[ $indexes[$i] ]['field_value'],
										"field_type"=> "text",
										"tablename"=> "custom_data",
										"col_name"=> "value_string"]
				];
				array_splice($fieldarray, array_keys($fieldimages)[$i], 0, $dict);
			}else{
				array_push( $insertconditionvalues, $fieldimages[ $indexes[$i] ]['field_value'] );
			}
		}else{
			break;
		}
	}

	if( $multiple_inserts ) {
		return $fieldarray;
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
	if( $multiple_inserts ) {
		
	}else{
		for ( $i=0; $i < sizeof($fieldarray); $i++ ) {
			$fieldarray[$i]['field_conditions'] = [ ["key"=>"id", "value"=>$lastinsertid ] ];
		}
	}
	return $fieldarray;
	// exit( json_encode( $lastinsertid ) );
}