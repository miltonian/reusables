<?php

namespace Reusables;

if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', "");
}

class Editing
{
    protected static $editable_views = [];

    public static function set()
    {
        foreach (Editing::$editable_views as $e) {
            if (strtolower($e['viewtype']) == 'cell') {
                echo " <script> ";

                Editing::makeCellEditing($e['identifier'], $e['fullviewdict'], $e['celltype']);
                echo " </script> ";
            }
        }
    }

    public static function makeCellEditing($identifier, $fullviewdict, $celltype)
    {
        $viewdict = Data::get($identifier);
        $viewoptions = Options::get($identifier);

        echo 'var viewdict = ' . json_encode($viewdict) . ';
    		var viewoptions = ' . json_encode($viewoptions) . ';';
        $formid = substr($identifier, 0, strpos($identifier, "_cell_")) . "_form";
        $formviewoptions = Options::get($formid);
        echo '
    		var formviewoptions = ' . json_encode($formviewoptions) . ';';
        if ($celltype == "modal") {
            echo 'thismodalclass = new ' . $viewoptions['modal']['modalclass'] . 'Classes();';
            echo 'var dataarray = ' . json_encode($fullviewdict) . ';';
        } elseif ($celltype == "attached") {
            echo 'var dataarray = ' . json_encode($fullviewdict) . ';';
        }
        echo '
			var celltype = ' . json_encode($celltype) . ';
			if( celltype == "modal" || celltype == "dropdown" ) {
				e.preventDefault();
				if( typeof dataarray === "undefined" ) {
					dataarray = []
				}
				Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions, formviewoptions );
			}else if( celltype == "attached" ){
				e.preventDefault();
				dataarray = ' . json_encode($fullviewdict) . ';
				if( typeof dataarray === "undefined" ) {
					dataarray = []
				}
				var firstkey = ' . json_encode(array_keys($viewdict)[0]) . ';
				var theindex = parseInt( viewdict[firstkey]["index"] )
				Reusable.addAction( viewdict, [], theindex, dataarray, this, e, viewoptions );
			}';

        Editing::getEditingFunctionsJS($viewoptions) ;

        echo '}';
    }

    // determine which type of editing you are going to do -- data or options -- then call the correct method
    public static function makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable=false)
    {
        echo " let alwayseditable = " . json_encode($alwayseditable) . "; ";

        // check if editing data
        echo " if( Reusable.isEditing() || alwayseditable ) { ";

            // makeViewEditingaddAnotherViewColumn
            Data::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
        echo " } ";


        // check if editing options
        echo " if( Reusable.isEditingOptions() ) { ";

            // if you are editing options,
            Options::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
        echo " } ";
    }



    public static function addEditingToCell($identifier, $fullviewdict, $celltype)
    {
        $dict = [
            'identifier' => $identifier,
            'fullviewdict' => $fullviewdict,
            'celltype' => $celltype,
            'viewtype' => 'Cell'
        ];
        array_push(Editing::$editable_views, $dict);
    }


    public static function getEditingFunctionsJS($dict, $is_options=false)
    {
        $action_key = RFormat::getViewActionKey($dict);
        // if( $action_key == '' ){ return []; }
        $multiple = false;
        if ($action_key == '') {
            $actiondict = $dict;
        } else {
            $actiondict = $dict[$action_key];
            $multiple = true;
        }
        echo "var editingfunctions = [];";
        if ($multiple) {
            $i=0;
            foreach ($actiondict as $ca) {
                if ($ca_type == "modal") {
                    if (isset($ca_type[ 'modal' ])) {
                        echo "var thismodalclass = new " . $ca['modal']['modalclass'] . "Classes();
            						editingfunctions.push( thismodalclass );";
                    } else {
                        echo 'editingfunctions.push( "nothing" );';
                    }
                } else {
                    echo 'editingfunctions.push( "nothing" );';
                }
                $i++;
            }
        } else {
            if ($is_options) {
                $ca_type = Data::getValue($actiondict, 'options_type');
            } else {
                $ca_type = Data::getValue($actiondict, 'type');
            }
            if ($ca_type == "modal") {
                if (isset($actiondict[ 'modal' ])) {
                    echo "var thismodalclass = new " . $actiondict['modal']['modalclass'] . "Classes();
					editingfunctions.push( thismodalclass );";
                } else {
                    echo 'editingfunctions.push( "nothing" );';
                }
            } elseif ($ca_type == "options_modal") {
                if (isset($actiondict[ 'options_modal' ])) {
                    echo "var thismodalclass = new " . $actiondict['options_modal']['modalclass'] . "Classes();
					editingfunctions.push( thismodalclass );";
                } else {
                    echo 'editingfunctions.push( "nothing" );';
                }
            } else {
                echo 'editingfunctions.push( "nothing" );';
            }
        }
    }


    public static function setUpEditingForSection($viewdict, $viewoptions, $identifier, $alwayseditable=false)
    {

        Editing::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
    }

    // add click to edit functionality to view
    public static function clickToEditSection($viewdict, $viewoptions, $identifier, $filename, $alwayseditable=false)
    {
        // get filename
        $filename = basename($filename, ".php");

        // start javascript
        echo "<script> ";
        echo "var thismodalclass = '';";
        echo "var thisoptionsmodalclass = '';";
        // check if this is a modal type
        $optiontype = Data::getValue($viewoptions, 'type');
        if ($optiontype == "modal" && isset($viewoptions['modal']['modalclass'])) {

            // initialize modalclass for this view and convert php full array to js full array var
            echo "thismodalclass = new " . $viewoptions['modal']['modalclass'] . "Classes();
            if( typeof modalclasses === 'undefined' ) {
              modalclasses = {};
            }
            modalclasses['".$identifier."'] = thismodalclass;";

        }

        if ( Data::getValue($viewoptions, 'options_type') == "options_modal" && isset($viewoptions['options_modal']['modalclass'])) {

            // initialize modalclass for this view and convert php full array to js full array var
            echo "thisoptionsmodalclass = new " . $viewoptions['options_modal']['modalclass'] . "Classes();
            if( typeof optionmodalclasses === 'undefined' ) {
              optionmodalclasses = {};
            }
            optionmodalclasses['".$identifier."'] = thisoptionsmodalclass;";

        }

        echo '
            var connected_identifier = identifier.replace("_form", "");
            $(".'.$identifier.'_add_view_button").click(function(){

                var viewindex = Reusable.getLastIndexInView("'.$identifier.'");
                var view = $(".'.$identifier.' .index_"+viewindex+".' . $filename . '.clicktoedit");
                Editing.addViewButtonAction(view, "'.$identifier.'")
            });

            $(".'.$identifier.'_add_newview_button").click(function(){

                var new_identifier = "newview_'.time().'";
                var view = $(".'.$identifier.'");

                Editing.addNewViewButtonAction(view, "'.$identifier.'", new_identifier)
            });
        ';

        // add click action to view -- connected to the container that wraps around every reusable view
        echo "$('.".$identifier." ." . $filename . ".clicktoedit').click(function(e){ ";

          Editing::setUpEditingForSection($viewdict, $viewoptions, $identifier);

        echo "}); ";

        // end javascript
        echo "</script>";
    }

    public static function insertFormValueInDB( $indexes, $fieldarray, $fieldimages, $tablename, $starting_i=0, $sizeofarraystoinsert=(-1) )
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


    	$result = CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

    	return $result;
    }

    public static function insertFileInDB( $indexes, $fieldarray, $fieldimages, $tablename, $starting_i=0, $sizeofarraystoinsert=(-1), $multiple_inserts=false )
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



    	$result = CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );
    	$lastinsertid = $result[1];
    	if( $multiple_inserts ) {

    	}else{
    		for ( $i=0; $i < sizeof($fieldarray); $i++ ) {
    			$fieldarray[$i]['field_conditions'] = [ ["key"=>"id", "value"=>$lastinsertid ] ];
    		}
    	}
    	return $fieldarray;

    }

    public static function updateOrInsertDBValues( $fieldarray, $indexes, $fieldimages, $filesarray, $ifnone_insert, $is_file=false )
    {

      $did_find_and_update = false;
      $tablenames_array = [];
      $lastinsertid = false;

      if( $is_file ) {

        for( $i=0; $i<sizeof($indexes);$i++ ){

      		$fi = $fieldimages[$indexes[$i]];
      		$did_find_and_update = Editing::updateDBValueIfExists($fi);
      	}
      } else {

        foreach ($fieldarray as $fi) {

      		$did_find_and_update = Editing::updateDBValueIfExists($fi);
      	}
      }


    	if( !$did_find_and_update && (sizeof($filesarray) > 0 || !$is_file) ){

    		if( isset( $ifnone_insert ) && sizeof($filesarray[0])>0  ){
    			if( $ifnone_insert == "1" ){

            if( $is_file ) {
              $fieldarray = Editing::insertDBImageValues( $fieldarray, $indexes, $fieldimages, "0", $filesarray, $tablenames_array );
            } else {
              $lastinsertid = Editing::insertDBValues( $fieldarray, $indexes, $fieldimages, "0" );
            }
    			}
    		}
    	}

      if( $is_file ) {
        return $fieldarray;
      } else {
        return $lastinsertid;
      }
    }

    public static function updateDBValueIfExists($field)
    {
        $did_find_and_update=false;

        // get value from form value
    		$fieldvalue = Convert::fieldValue($field);
    		if($fieldvalue) {

    				// get tablename from image
    				$tablename = $field['tablename'];

    				// get column name from image
    				$colname = Convert::colname($field);

    				// get conditions from image
    				$conditions = Convert::conditions($field);

    				if( !isset( $tablenames_array[$tablename] ) ) {
    					$tablenames_array[$tablename] = true;
    				}

            if( $conditions ) {

        			// make the where clause from the passed conditions
        			$whereclause = Convert::queryConditions($conditions)['where_clause'];

        			// make the where query VALUES from the passed conditions
        			$conditionvalues = Convert::queryConditions($conditions)['condition_values'];

        			$query = "SELECT * FROM " . $tablename . " " . $whereclause;
        			$values = $conditionvalues;
        			$type = "select";
        			$result = CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

        			if( $result[0] == 0 ) {

        			} else if ( isset($conditions) ) {

        				$did_find_and_update=true;
        				// if($colname=='id'){
        				// 	//continue;
        				// }

        				$query = "UPDATE " . $tablename . " SET " . $colname . " = ? " . $whereclause;
        				$values = array_merge( [ $fieldvalue ], $conditionvalues );
        				$type = "update";
        				$result = CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

        			}
        		}

        }

        return $did_find_and_update;

    }

    public static function insertDBImageValues( $fieldarray, $indexes, $fieldimages, $multiple_inserts, $filesarray, $tablenames_array )
    {

      $sizeofarraystoinsert = 0;
      $keys_found = [];

      if( isset( $multiple_inserts ) && sizeof($filesarray[0])>0 ) {
        if( $multiple_inserts == "1" ) {

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

      if( isset( $multiple_inserts ) ){
        if( $multiple_inserts == "1" ) {

          // for ($i=0; $i < (sizeof($indexes)); $i++) {
          //
          //   if( $sizeofarraystoinsert == 0 ) {
          //     $fieldarray = Editing::insertFileInDB( $indexes, $fieldarray, $fieldimages, $tablename, $i, 1, true );
          //   }else{
          //     $fieldarray = Editing::insertFileInDB( $indexes, $fieldarray, $fieldimages, $tablename, $i, $sizeofarraystoinsert, true );
          //   }
          //
          //   if( ($i+$sizeofarraystoinsert-1) > $i ) {
          //     $i=($i+$sizeofarraystoinsert-1);
          //   }
          // }
        }else{
          foreach ($tablenames_array as $table=>$bool) {
            $fieldarray = Editing::insertFileInDB( $indexes, $fieldarray, $fieldimages, $table );
          }
        }
      }else{

        foreach ($tablenames_array as $table=>$bool) {
          $fieldarray = Editing::insertFileInDB( $indexes, $fieldarray, $fieldimages, $table );
        }
      }

      return $fieldarray;

    }

    public static function insertDBValues( $fieldarray, $indexes, $fieldimages, $multiple_inserts )
    {

      $sizeofarraystoinsert = 0;
      $keys_found = [];

      if( isset( $multiple_inserts ) ){
        if( $multiple_inserts == "1" ) {

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

      if( isset( $multiple_inserts ) ){
        if( $multiple_inserts == "1" ) {

          // for ($i=0; $i < (sizeof($indexes)); $i++) {
          //
          //   if( !isset($fieldimages) ){
          //     $fieldimages = null;
          //   }else if( sizeof($fieldimages) == 0 ) {
          //     $fieldimages = null;
          //   }
          //
          //   $lastinsertid = Editing::insertFormValueInDB( $indexes, $fieldarray, $fieldimages, $tablename, $i, $sizeofarraystoinsert );
          //
          //   $i=($i+$sizeofarraystoinsert-1);
          // }
        } else {
          if( !isset( $fieldimages ) ) {
            $fieldimages = [];
          }

          foreach ($tablenames_array as $table=>$bool) {
            $lastinsertid = Editing::insertFormValueInDB( $indexes, $fieldarray, $fieldimages, $table );
          }
        }
      } else {

        if( !isset( $fieldimages ) ) {
          $fieldimages = [];
        }

        foreach ($tablenames_array as $table=>$bool) {
          $lastinsertid = Editing::insertFormValueInDB( $indexes, $fieldarray, $fieldimages, $table );
        }

      }
      return $lastinsertid;

    }

    public static function saveSmartFormValues($fieldimages, $fieldarray, $_FILES, $ifnone_insert)
    {

      $lastinsertid = false;

      if( isset($fieldimages ) ) {
      		// images have been passed and need to be updated/inserted

      		$indexes = array_keys( $_FILES['fieldimage']['name']);

      		// loop through files and convert files from reusable format to normal file format
      		$reusable_files_result = Convert::reusableFiles($_FILES, $indexes);

      		// put normal files in var
      		$filesarray = $reusable_files_result['filesarray'];

      		//	// skip
      		// 	$filesarray_multiple = $reusable_files_result['filesarray_multiple'];
      		// 	// skip
      		// 	$filesarray_multiple = Reusables\Convert::getFilesFromFileMultiples($filesarray_multiple, $_FILES, $indexes);

      		// loop through the files collected earlier in this file
      		$fieldimages = Media::uploadFieldImages( $_FILES, $filesarray, $indexes, $fieldimages );

      		$fieldarray = Editing::updateOrInsertDBValues( $fieldarray, $indexes, $fieldimages, $filesarray, $ifnone_insert, true );

      }






      if ( sizeof($fieldarray) > 0 ) {
      // normal form values have been passed and need to be updated/inserted

      	$lastinsertid = Editing::updateOrInsertDBValues( $fieldarray, $indexes, $fieldimages, $filesarray, $ifnone_insert );
      }

      return [
        "fieldimages" => $fieldimages,
        "fieldarray" => $fieldarray,
        "lastinsertid" => $lastinsertid
      ];
    }



}
