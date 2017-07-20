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


require_once('classes/classes.php');
// require_once('vendor/miltonian/reusables/classes/Shortcuts.php');
$MainClasses = new MainClasses();

$containsp = false;

if(isset($_POST[ 'fieldarray' ])){ $fieldarray = $_POST[ 'fieldarray' ]; $containsp=true; }
if(isset($_POST[ 'fieldimage' ])){ $fieldimages = $_POST[ 'fieldimage' ]; $containsp=true; }
if(!$containsp){ exit("missing parameters"); }

if( isset($fieldimages ) ) {
	$filesarray = array();
	$indexes = array_keys( $_FILES['fieldimage']['name']);
	for ($i=0; $i < sizeof($_FILES['fieldimage']['name']); $i++) { 
		$filedict = [];
		$filedict['name'] = $_FILES['fieldimage']['name'][ $indexes[$i] ]['field_value'];
		$filedict['type'] = $_FILES['fieldimage']['type'][ $indexes[$i] ]['field_value'];
		$filedict['tmp_name'] = $_FILES['fieldimage']['tmp_name'][ $indexes[$i] ]['field_value'];
		$filedict['error'] = $_FILES['fieldimage']['error'][ $indexes[$i] ]['field_value'];
		$filedict['size'] = $_FILES['fieldimage']['size'][ $indexes[$i] ]['field_value'];
		array_push( $filesarray, $filedict );
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

			// $query = "SELECT * FROM " . $tablename . " " . $whereclause;
			// $values = $conditionvalues;
			// $type = "select";
			// $result = $MainClasses->querySQL( $query, $values, $type );
			// exit( json_encode( $result ) );

			$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
			$values = array_merge( [ $fieldvalue ], $conditionvalues );
			$type = "update";
			// exit(json_encode($query));
			$result = $MainClasses->querySQL( $query, $values, $type );
			// exit(json_encode($result));
		}
	}
}

if (isset($fieldarray)) {
	foreach ($fieldarray as $f) {
		$fieldvalue = $f['field_value'];
		$tablename = $f['tablename'];
		$colname = $f['col_name'];
		// $rowid = $f['row_id'];
		$conditions = $f['field_conditions'];
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

		$query = "SELECT * FROM " . $tablename . " " . $whereclause;
			$values = $conditionvalues;
			$type = "select";
			$result = $MainClasses->querySQL( $query, $values, $type );
			// exit(json_encode($conditionvalues));
			if($result[0] == 0){
				if( isset( $_POST['ifnone_insert'] ) ){
					if( $_POST['ifnone_insert'] == "1" ){ 
						// $query = "INSERT INTO " . $tablename . " ( ";// . $colname . " = ? " . $whereclause;
						// $questionmarks = "";
						// $insertconditionvalues = [];
						// for ($i=0; $i < sizeof($conditions); $i++) { 
						// 	if( $i > 0 ){
						// 		$query .= ", " . $conditions[$i]['key'];
						// 		$questionmarks .= ", ?";
						// 	}else{
						// 		$query .= $conditions[$i]['key'];
						// 		$questionmarks .= "?";
						// 	}
						// 	array_push( $insertconditionvalues, $conditions[$i]['value'] );
						// }
						// $query .= " ) VALUES ( " . $questionmarks . ")";
						// $values = $insertconditionvalues;
						// $type = "insert";
						// exit( json_encode( $query ) );
						// $result = $MainClasses->querySQL( $query, $values, $type );
					}
				}
			}else{
				// echo json_encode($f); echo "<br>";
				$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
				$values = array_merge( [ $fieldvalue ], $conditionvalues );
				$type = "update";
				// exit(json_encode($query));
				$result = $MainClasses->querySQL( $query, $values, $type );
			}
			
		
	}
}

if( isset( $_POST['goto'] ) ){
	header( 'Location: /' . $_POST['goto'] );
}else{
	header( 'Location: /' );
}