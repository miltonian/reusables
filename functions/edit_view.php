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

if( Reusables\Auth::check() == false ) {
		header('Location: /');
		exit();
}

// require_once('classes/classes.php');
// require_once('vendor/miltonian/reusables/classes/Shortcuts.php');

$containsp = false;


$lastinsertid = false;

$fieldarray = [];
if(isset($_POST[ 'fieldarray' ])){ $fieldarray = $_POST[ 'fieldarray' ]; $containsp=true; }
if(isset($_POST[ 'fieldimage' ])){ $fieldimages = $_POST[ 'fieldimage' ]; $containsp=true; }
if(isset($_POST[ 'fieldimage_multiple' ])){ $fieldimage_multiple = $_POST[ 'fieldimage_multiple' ]; }
if(!$containsp){ exit("missing parameters"); }


if( isset($fieldimages ) ) {
	$filesarray = [];
	$indexes = array_keys( $_FILES['fieldimage']['name']);
	$didfind = false;

	$filesarray_multiple = [];

	for ($i=0; $i < sizeof($_FILES['fieldimage']['name']); $i++) {
		if( $_FILES['fieldimage']['size'][ $indexes[$i] ]['field_value'] > 0 ){
			$filedict = [];
			$filedict['name'] = $_FILES['fieldimage']['name'][ $indexes[$i] ]['field_value'];
			$filedict['type'] = $_FILES['fieldimage']['type'][ $indexes[$i] ]['field_value'];
			$filedict['tmp_name'] = $_FILES['fieldimage']['tmp_name'][ $indexes[$i] ]['field_value'];
			$filedict['error'] = $_FILES['fieldimage']['error'][ $indexes[$i] ]['field_value'];
			$filedict['size'] = $_FILES['fieldimage']['size'][ $indexes[$i] ]['field_value'];
			array_push( $filesarray, $filedict );

			if(isset($_FILES['fieldimage_multiple']['name'][$i])) {
				$indexes_multiple = array_keys($_FILES['fieldimage_multiple']['name'][$i]['field_value']);
				if( isset($_FILES['fieldimage_multiple']['name'][$i]) ) {
					for ($m=0; $m < sizeof($_FILES['fieldimage_multiple']['name'][$i]['field_value']); $m++) {
						$filedict_multiple = [];
						if( $_FILES['fieldimage_multiple']['size'][$i]['field_value'][$indexes_multiple[$m]] > 0 ) {

							$filedict_multiple['name'] = $_FILES['fieldimage_multiple']['name'][$i]['field_value'][$indexes_multiple[$m]];
							$filedict_multiple['type'] = $_FILES['fieldimage_multiple']['type'][$i]['field_value'][$indexes_multiple[$m]];
							$filedict_multiple['tmp_name'] = $_FILES['fieldimage_multiple']['tmp_name'][$i]['field_value'][$indexes_multiple[$m]];
							$filedict_multiple['error'] = $_FILES['fieldimage_multiple']['error'][$i]['field_value'][$indexes_multiple[$m]];
							$filedict_multiple['size'] = $_FILES['fieldimage_multiple']['size'][$i]['field_value'][$indexes_multiple[$m]];


							if(!isset($filesarray_multiple[$i])) {
								$filesarray_multiple[$i] = [];
							}
							array_push( $filesarray_multiple[$i], $filedict_multiple );
						} else {
							if(!isset($filesarray_multiple[$i])) {
								$filesarray_multiple[$i] = [];
							}
							array_push( $filesarray_multiple[$i], $filedict_multiple );
						}
					}
				}
			}


		}else{
			array_push($filesarray, []);
			$filesarray_multiple[$i] = [];
		}
	}

	// if( $_FILES['fieldimage']['size'][ $indexes[0] ]['field_value'] == 0 ) {
		$fieldimages_dbinfo = $fieldimages[$indexes[0]];
		if( !isset($fieldimages_dbinfo['tablename'] ) ){
			$test_tablename = false;
		}else{
			$test_tablename = $fieldimages_dbinfo['tablename'];
		}

		if ($test_tablename) {

			$tablename = $fieldimages_dbinfo['tablename'];
			if( !isset( $tablenames_array[$tablename] ) ) {
				$tablenames_array[$tablename] = true;
			}
			$colname = $fieldimages_dbinfo['col_name'];
			$colname = $colname;
			$colname_arr = explode('.', $colname);
			if( isset($colname_arr) ) {
				if( sizeof( $colname_arr ) == 2 ) {
					$colname = $colname_arr[1];
				}
			}
			if( !isset($fieldimages_dbinfo['field_conditions']) ) {
				$conditions = false;
			}else{
				$conditions = $fieldimages_dbinfo['field_conditions'];
			}

			if( $conditions ) {
				$whereclause = "";
				$conditionvalues = [];
				for ($a=0; $a < sizeof($conditions); $a++) {
					$conditionkey = $conditions[$a]['key'];
					$conditionkey_arr = explode(".", $conditionkey);
					if( sizeof($conditionkey_arr) != 2 ) {
						$conditionkey = $tablename.".".$conditionkey;
					}
					if( $a > 0 ){
						$whereclause .= " AND " . $conditionkey . "=? ";
					}else{
						$whereclause .= "WHERE " . $conditionkey . "=? ";
					}
					array_push( $conditionvalues, $conditions[$a]['value'] );
				}

				// echo json_encode($fi); echo "<br>";

				$query = "SELECT * FROM " . $tablename . " " . $whereclause;
				$values = $conditionvalues;
				$type = "select";
				// $result = $MainClasses->querySQL( $query, $values, $type );

				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

				if( $result[0] == 1 ) {
					// if( isset( $result[1][0]['imagepath'] ) ) {
					// 	$current_imagepath = $result[1][0]['imagepath'];
					// }

					$imagepath_key = $fieldimages[$indexes[0]]['col_name'];
					if( explode(".", $imagepath_key) > 1 ) {
						$imagepath_key = explode(".", $imagepath_key)[1];
					}
					if( isset( $result[1][0][$imagepath_key] ) ) {
						$current_imagepath = $result[1][0][$imagepath_key];
					}
				}
			}
		// }





		$indexes_multiple = array_keys($_FILES['fieldimage_multiple']['name'][$indexes[0]]['field_value']);
		if( isset($_FILES['fieldimage_multiple']['name'][$indexes[0]]) ) {
			for ($m=0; $m < sizeof($_FILES['fieldimage_multiple']['name'][$indexes[0]]['field_value']); $m++) {
				$filedict_multiple = [];
				if( $_FILES['fieldimage_multiple']['size'][$indexes[0]]['field_value'][$indexes_multiple[$m]] > 0 ) {

					$filedict_multiple['name'] = $_FILES['fieldimage_multiple']['name'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
					$filedict_multiple['type'] = $_FILES['fieldimage_multiple']['type'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
					$filedict_multiple['tmp_name'] = $_FILES['fieldimage_multiple']['tmp_name'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
					$filedict_multiple['error'] = $_FILES['fieldimage_multiple']['error'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
					$filedict_multiple['size'] = $_FILES['fieldimage_multiple']['size'][$indexes[0]]['field_value'][$indexes_multiple[$m]];


					if(!isset($filesarray_multiple[$indexes[0]])) {
						$filesarray_multiple[$indexes[0]] = [];
					}
					array_push( $filesarray_multiple[$indexes[0]], $filedict_multiple );
				} else {
					if(!isset($filesarray_multiple[$indexes[0]])) {
						$filesarray_multiple[$indexes[0]] = [];
					}
					array_push( $filesarray_multiple[$indexes[0]], $filedict_multiple );
				}
			}
		}
	}


	$i=0;
	foreach ($filesarray as $file) {
		if( sizeof($filesarray)==0){
			$i++;
			if( $i > sizeof($filesarray) ) {
				break;
			}
			continue;
		}
		$images_names = [];
		if( $_FILES['fieldimage']['name'][$indexes[$i]]['field_value'] != "" ) {

			$imagepath = Reusables\Media::uploadImage( $file );
			if( isset($filesarray_multiple[$indexes[$i]]) ) {
				if( sizeof($filesarray_multiple[$indexes[$i]]) > 0 ) {
					$imagepath_array = [];
					// $current_imagepath
					$current_imagepaths = [];
					if( isset($current_imagepath) ) {
						$current_imagepaths = explode(",", $current_imagepath);
						$current_imagepaths[0] = $imagepath;
						$imagepaths_index = 1;
						foreach ($filesarray_multiple[$indexes[$i]] as $file) {
							if( isset($file['name']) ) {
								if( isset($images_names[$file['name']]) ) {
									break;
								} else {
									$images_names[$file['name']] = true;
								}
							}
							if( isset($file['name']) ) {
								$current_imagepaths[$imagepaths_index] = Reusables\Media::uploadImage( $file );
							} else if( isset($current_imagepaths[$imagepaths_index]) ) {
								$current_imagepaths[$imagepaths_index] = $current_imagepaths[$imagepaths_index];
							}
							$imagepaths_index++;
						}
					}


					$imagepath = "";
					$imagepaths_index=0;
					foreach ($current_imagepaths as $image) {
						if( $imagepaths_index > 0 ) {
							$imagepath .= ",";
						}
						$imagepath .= $image;
						$imagepaths_index++;
					}
				}
			}
			$fieldimages[$indexes[$i]]['field_value'] = $imagepath;
		} else {
			$imagepath = "";
			if( isset($filesarray_multiple[$indexes[$i]]) ) {
				if( sizeof($filesarray_multiple[$indexes[$i]]) > 0 ) {
					$imagepath_array = [];
					$current_imagepaths = [];
					if( isset($current_imagepath) ) {
						// $current_imagepath
						$current_imagepaths = explode(",", $current_imagepath);
						$imagepaths_index = 1;
						foreach ($filesarray_multiple[$indexes[$i]] as $file) {
							if( isset($file['name']) ) {
								if( isset($images_names[$file['name']]) ) {
									break;
								} else {
									$images_names[$file['name']] = true;
								}
							}

							if( isset($file['name']) ) {
								$current_imagepaths[$imagepaths_index] = Reusables\Media::uploadImage( $file );
							} else {
								if(isset($current_imagepaths[$imagepaths_index])) {
									$current_imagepaths[$imagepaths_index] = $current_imagepaths[$imagepaths_index];
								}
							}

							$imagepaths_index++;
						}
					}

					$imagepath = "";
					$imagepaths_index=0;
					foreach ($current_imagepaths as $image) {
						if( $imagepaths_index > 0 && $image != "" ) {
							$imagepath .= ",";
						}
						$imagepath .= $image;
						$imagepaths_index++;
					}
				}
			}

			$fieldimages[$indexes[$i]]['field_value'] = $imagepath;
		}
		$i++;
	}

	$tablenames_array = [];
	for( $i=0; $i<sizeof($indexes);$i++ ){
		$fi = $fieldimages[$indexes[$i]];

		if( !isset($fi['field_value'] ) ){
			$fieldvalue = false;
		}else{
			$fieldvalue = $fi['field_value'];
		}

		if ($fieldvalue) {


			$tablename = $fi['tablename'];
			if( !isset( $tablenames_array[$tablename] ) ) {
				$tablenames_array[$tablename] = true;
			}
			$colname = $fi['col_name'];
			$colname = $colname;
			$colname_arr = explode('.', $colname);
			if( isset($colname_arr) ) {
				if( sizeof( $colname_arr ) == 2 ) {
					$colname = $colname_arr[1];
				}
			}
			if( !isset($fi['field_conditions']) ) {
				$conditions = false;
			}else{
				$conditions = $fi['field_conditions'];
			}
			if( $conditions ) {
				$whereclause = "";
				$conditionvalues = [];
				for ($a=0; $a < sizeof($conditions); $a++) {
					$conditionkey = $conditions[$a]['key'];
					$conditionkey_arr = explode(".", $conditionkey);
					if( sizeof($conditionkey_arr) != 2 ) {
						$conditionkey = $tablename.".".$conditionkey;
					}
					if( $a > 0 ){
						$whereclause .= " AND " . $conditionkey . "=? ";
					}else{
						$whereclause .= "WHERE " . $conditionkey . "=? ";
					}
					array_push( $conditionvalues, $conditions[$a]['value'] );
				}

				// echo json_encode($fi); echo "<br>";

				$query = "SELECT * FROM " . $tablename . " " . $whereclause;
				$values = $conditionvalues;
				$type = "select";
				// $result = $MainClasses->querySQL( $query, $values, $type );

				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );





				if($result[0] == 0){

				}else{

					$didfind=true;
					$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
					$values = array_merge( [ $fieldvalue ], $conditionvalues );
					$type = "update";
					// $result = $MainClasses->querySQL( $query, $values, $type );


					$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
				}
			}

		}
	}


	if( !$didfind && sizeof($filesarray) > 0 ){



		if( isset( $_POST['ifnone_insert'] ) && sizeof($filesarray[0])>0  ){
			if( $_POST['ifnone_insert'] == "1" ){
				$sizeofarraystoinsert = 0;
				$keys_found = [];

				if( isset( $_POST['multiple_inserts'] ) ){
					if( $_POST['multiple_inserts'] == "1" ) {

						$arraytoinsert_i=0;
						foreach ($fieldimages as $key) {

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

						for ($i=0; $i < (sizeof($indexes)); $i++) {







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
						foreach ($tablenames_array as $table=>$bool) {
							$fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $table );
							// $fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $tablename );
						}
					}
				}else{

					foreach ($tablenames_array as $table=>$bool) {
						$fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $table );
						// $fieldarray = insertimage( $indexes, $fieldarray, $fieldimages, $tablename );
					}
				}

			}
		}
	}

}

$tablenames_array = null; $tablenames_array = [];



if ( sizeof($fieldarray) > 0 ) {

	$tablenames_array = [];
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
			if( !isset( $tablenames_array[$tablename] ) ) {
				$tablenames_array[$tablename] = true;
			}
		}
		if( isset( $f['col_name'] ) ) {
			$colname = $f['col_name'];
			$colname = $f['col_name'];
			$colname = $colname;
			$colname_arr = explode('.', $colname);
			if( isset($colname_arr) ) {
				if( sizeof( $colname_arr ) == 2 ) {
					$colname = $colname_arr[1];
				}
			}
		}
		// $rowid = $f['row_id'];
		if( !isset($f['field_conditions']) ) {
			$conditions = false;
		}else{
			$conditions = $f['field_conditions'];
		}
		if( $conditions ) {

			$whereclause = "";
			$conditionvalues = [];

			$conditionkey = $conditions[0]['key'];
			$conditionkey_arr = explode(".", $conditionkey);
			if( sizeof($conditionkey_arr) != 2 ) {
				$conditionkey = $conditionkey;
			} else {
				$conditionkey = $conditionkey_arr[1];
			}
			if($conditionkey=="id" && $conditions[0]['value']=="" && $lastinsertid==true && $lastinsertid!=0 ){ $conditions[0]['value'] = $lastinsertid; }
			for ($i=0; $i < sizeof($conditions); $i++) {
				$conditionkey = $conditions[$i]['key'];
				$conditionkey_arr = explode(".", $conditionkey);
				if( sizeof($conditionkey_arr) != 2 ) {
					$conditionkey = $tablename.".".$conditionkey;
				}
				if( $i > 0 ){
					$whereclause .= " AND " . $conditionkey . "=? ";
				}else{
					$whereclause .= "WHERE " . $conditionkey . "=? ";
				}
				array_push( $conditionvalues, $conditions[$i]['value'] );
			}

			$query = "SELECT * FROM " . $tablename . " " . $whereclause;
			$values = $conditionvalues;
			$type = "select";


			$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );


			if($result[0] == 0){

			} else if ( isset($f['field_conditions']) ) {
				$didfind=true;
				if($colname=='id'){
					continue;
				}

				$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
				$values = array_merge( [ $fieldvalue ], $conditionvalues );
				$type = "update";
				// $result = $MainClasses->querySQL( $query, $values, $type );


				$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

			}
		}
		$testi++;
	}

	if( !$didfind ) {

		if( isset( $_POST['ifnone_insert'] ) ){
			if( $_POST['ifnone_insert'] == "1" ){
				$sizeofarraystoinsert = 0;
				$keys_found = [];

				if( isset( $_POST['multiple_inserts'] ) ){
					if( $_POST['multiple_inserts'] == "1" ) {

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

						for ($i=0; $i < (sizeof($indexes)); $i++) {
							if( !isset($fieldimages) ){
								$fieldimages = null;
							}else if( sizeof($fieldimages) == 0 ) {
								$fieldimages = null;
							}



							$lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename, $i, $sizeofarraystoinsert );

							$i=($i+$sizeofarraystoinsert-1);
						}
					} else {
						if( !isset( $fieldimages ) ) {
							$fieldimages = [];
						}

						// $lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename );
						foreach ($tablenames_array as $table=>$bool) {
							$lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $table );
							// $lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename );
						}

					}
				} else {
					if( !isset( $fieldimages ) ) {
						$fieldimages = [];
					}

					foreach ($tablenames_array as $table=>$bool) {

						$lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $table );
						// $lastinsertid = insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename );
					}

				}


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




function insertnonimage( $indexes, $fieldarray, $fieldimages, $tablename, $starting_i=0, $sizeofarraystoinsert=(-1) )
{
	$query = "INSERT INTO " . $tablename . " ( ";// . $colname . " = ? " . $whereclause;
	$questionmarks = "";
	$insertconditionvalues = [];

	if( $sizeofarraystoinsert == -1 ) {
		$sizeofarraystoinsert = sizeof($indexes);
	}
	for ($i=$starting_i; $i < $starting_i+$sizeofarraystoinsert; $i++) {
		if( $i < sizeof( $indexes ) ) {
			$arrayorimages = $fieldarray;


			if( !isset( $arrayorimages[ $indexes[$i] ]['col_name'] ) ) {
				if( !isset( $arrayorimages[ $indexes[$i] ]['col_name'] ) ) {
					continue;
				} else{
					if( $fieldimages[ $indexes[$i] ]['tablename'] == $tablename ) {
						$arrayorimages = $fieldimages;
					} else {
						continue;
					}
				}
			} else{
				if( $fieldarray[ $indexes[$i] ]['tablename'] != $tablename ) {
					continue;
				}
			}
			$colname = $arrayorimages[ $indexes[$i] ]['col_name'];
			$colname_arr = explode('.', $colname);
			if( isset($colname_arr) ) {
				if( sizeof( $colname_arr ) == 2 ) {
					$colname = $colname_arr[1];
				}
			}




			if( $colname == 'id' ){
				continue;
			}
			if( sizeof($insertconditionvalues) > 0 ){
				$query .= ", " . $colname;

				$questionmarks .= ", ?";
			}else{


				$query .= $colname;
				$questionmarks .= "?";
			}
			array_push( $insertconditionvalues, $arrayorimages[ $indexes[$i] ]['field_value'] );
		}
	}

	$query .= " ) VALUES ( " . $questionmarks . ")";
	$values = $insertconditionvalues;
	$type = "insert";
	// $result = $MainClasses->querySQL( $query, $values, $type );


	$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

	return $result;
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
			$colname = $fieldimages[ $indexes[$i] ]['col_name'];
				$colname_arr = explode('.', $colname);
				if( isset($colname_arr) ) {
					if( sizeof( $colname_arr ) == 2 ) {
						$colname = $colname_arr[1];
					}
				}
			if( $colname == 'id' ){
				continue;
			}
			if( $fieldimages[ $indexes[$i] ]['field_value'] == false ){
				continue;
			}
			if( sizeof($insertconditionvalues) > 0 ){
				$query .= ", " . $colname;
				$questionmarks .= ", ?";
			}else{
				$query .= $colname;
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

	// $result = $MainClasses->querySQL( $query, $values, $type );



	$result = Reusables\CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
	$lastinsertid = $result[1];
	if( $multiple_inserts ) {

	}else{
		for ( $i=0; $i < sizeof($fieldarray); $i++ ) {
			$fieldarray[$i]['field_conditions'] = [ ["key"=>"id", "value"=>$lastinsertid ] ];
		}
	}
	return $fieldarray;

}
