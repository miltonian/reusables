<?php

namespace Reusables;

class Convert
{
    public static function keys($data, $identifier=null)
    {
        $testing=false;
        if (!$identifier) {
            $identifier = Data::getDefaultDataID($data);
        } else {
            $testing=true;
        }
        if ($testing) {
            exit(json_encode($data));
        }
        // exit( json_encode( $identifier ) );
        // $data = Data::get( $identifier );
        $options = Options::get($identifier);
        // exit( json_encode( $data ) );
        $convertkeys = Data::getValue($options, 'convert_keys');
        if ($convertkeys == "") {
            return $data;
        }
        if (!isset($convertkeys)) {
            $convertkeys = false;
        } else {
            $convertkeys = $convertkeys;
        }
        $convertdict = $data;
        if (isset($data['value'])) {
            $convertdict = $data['value'];
        }

        $sectionkeys = array_keys($convertdict);
        foreach ($sectionkeys as $k) {
            $k_no_table = $k;
            $k_arr = explode(".", $k);
            if (sizeof($k_arr) == 2) {
                $k_no_table = $k_arr[1];
            }
            // exit( json_encode( $convertkeys ) );
            // if( isset( $convertkeys[$k] ) ){ $convertdict[$convertkeys[$k]] = $convertdict[$k]; }
            if (isset($convertkeys[$k_no_table])) {
                if (is_array($convertkeys[$k_no_table])) {
                    foreach ($convertkeys[$k_no_table] as $ck) {
                        $convertdict[$ck] = $convertdict[$k];
                    }
                } else {
                    $convertdict[$convertkeys[$k_no_table]] = $convertdict[$k];
                }
            }
        }

        if (isset($data['value'])) {
            $data['value'] = $convertdict;
        } else {
            $data = $convertdict;
        }

        return $data;
    }

    public static function keysInTable($identifier, $post)
    {
        $data = Data::get($identifier);
        $options = Options::get($identifier);

        if (!isset($options['convert_keys'])) {
            $convertkeys = false;
        } else {
            $convertkeys = $options['convert_keys'];
        }
        $post = Convert::toViewTypeArray( $identifier, $post );
        if( !is_array($post) ) {
          $post = [$post];
        }
        $postkeys = array_keys($post);

        foreach ($postkeys as $k) {
            $k_no_table = $k;
            $k_arr = explode(".", $k);
            if (sizeof($k_arr) == 2) {
                $k_no_table = $k_arr[1];
            }
            if (isset($convertkeys[$k_no_table])) {
                if (is_array($convertkeys[$k_no_table])) {
                    foreach ($convertkeys[$k_no_table] as $ck) {
                        $post[$ck] = $post[$k];
                    }
                } else {
                    // exit( json_encode($post[$k]));
                    $post[$convertkeys[$k_no_table]] = $post[$k];
                }
                // $post[$convertkeys[$k] ]['key'] = $convertkeys[$k];
            }
        }

        return $post;
    }

    public static function toViewTypeArray( $identifier, $array )
    {
        $viewtype = strtolower(basename(Info::viewtype($identifier)));

        switch ($viewtype) {
          case 'gallery':
            return Convert::toGalleryArray( $identifier, $array );
            break;

          default:
            return Convert::toDefaultArray( $identifier, $array );
            break;
        }
       return $array;
    }

    public static function toDefaultArray( $identifier, $array )
    {
      $imagepath = Data::getValue($array, "imagepath", $identifier);
      if( sizeof( explode(",", $imagepath)) > 1 ) {

        if(isset($array["imagepath"])) {
          $imagepath_key = "imagepath";
        } else {
          $imagepath_key = Data::getDefaultTableNameWithID($identifier).".imagepath";
        }
        $imagepath = explode(",", $imagepath)[0];
        $array[$imagepath_key] = $imagepath;
      }

      return $array;
    }

    public static function toGalleryArray( $identifier, $array )
    {
      $new_array = [];
      if( is_string($array) ) {
        $new_array = ["images"=>["imagepath"=>$array]];
        return $new_array;
      }
      foreach ($array as $key => $value) {
        if( is_string($key) ){
          $base_key = explode(".", $key);
          if( sizeof($base_key) > 1 ) {
            $base_key = $base_key[1];
          }
          if( $key == "imagepath" || $base_key == "imagepath" ) {
            if( sizeof(explode(",", $array[$key])) > 1 ) {
              $images = explode(",", $array[$key]);
              $new_array = [];
              foreach ($images as $image) {
                array_push($new_array, ["imagepath"=>$image]);
              }
              // exit(json_encode($new_array));
              return ["images"=>$new_array];
              break;
            }
          }
          $new_array = ["images"=>$array];
          // break;
        } else {
          array_push($new_array, ["images"=>["imagepath"=>$value]]);
        }
      }

      return ["images"=>$new_array];
    }

    public static function convertDataForArray($identifier, $index)
    {
        $dict = self::retrieveDataWithID($identifier)['value'][$index];

        $allkeys = array_keys($dict);
        $returningdict = [];
        foreach ($allkeys as $k) {
            $returningdict[$k] = [ "data_id"=>$identifier, "key"=>$k, "index"=>$index ];
        }
        $returningdict['index'] = $index;

        return $returningdict;
    }

    public static function viewParamsToVars($identifier)
    {
        // Get view data, options, and tablename
        $viewdict = Data::get($identifier);
        $viewoptions = Options::get($identifier);
        $tablename = Data::getDefaultTableNameWithID($identifier);

        // Get the view's unformatted data array
        $unformatted_arr = Data::getUnformatted($identifier);

        // Get the links
        $links = Data::getValue($viewoptions, "links");
// exit(json_encode($unformatted_arr));
        $viewvalues = [];
        foreach ($unformatted_arr as $key => $value) {

            $dict = Convert::keysInTable($identifier, $value);

            $linkpath = View::getFullLink($identifier, $dict);
            $title = Preview::title($identifier, $dict);

            if (Preview::isTrue($identifier)) {
                $description = Preview::description($identifier, $dict);
            } else {
                $description = Text::limitDescription($identifier, $dict);
            }

            if ($title != "") {
                $dict['title'] = $title;
            }
            if ($description != "") {
                $dict['description'] = $description;
                $dict['html_text'] = $description;
            }
            $dict['linkpath'] = $linkpath;

            array_push($viewvalues, $dict);
        }
        if (!isset($linkpath)) {
            $linkpath = "#";
        }

        $text_color = Data::getValue($viewoptions, "text_color");
        $background_color = Data::getValue($viewoptions, "background_color");
        $padding_arr = Views::getPaddingOrMargin($identifier);
        $padding = $padding_arr[0];
        $padding_width = $padding_arr[1];
        $margin_arr = Views::getPaddingOrMargin($identifier, "margin");
        $margin = $margin_arr[0];
        $margin_width = $margin_arr[1];

        return [
            "viewvalues" => $viewvalues,
            "linkpath" => $linkpath,
            "data_id" => $identifier,
            "text_color" => $text_color,
            "background_color" => $background_color,
            "padding" => $padding,
            "padding_width" => $padding_width,
            "margin" => $margin,
            "margin_width" => $margin_width,
            "links" => $links,
        ];
    }


    // loop through files and convert files from reusable format to normal file format
    public static function reusableFiles($files, $indexes)
    {

      $filesarray = [];
      $filesarray_multiple = [];
      for ($i=0; $i < sizeof($files['fieldimage']['name']); $i++) {
  			if( $files['fieldimage']['size'][ $indexes[$i] ]['field_value'] > 0 ){

  				// convert files from reusable format to normal file format
  				$filedict = Convert::reusableFile($files, $indexes[$i]);
  				array_push( $filesarray, $filedict );

  				// skip
  				$filesarray_multiple = Convert::reusableFileMultiple( $files, $i, $filesarray_multiple );

  			}else{
  				array_push($filesarray, []);
  				$filesarray_multiple[$i] = [];
  			}
  		}

      return [
        "filesarray" => $filesarray,
        "filesarray_multiple" => $filesarray_multiple
      ];
    }


    // convert files from reusable format to normal file format
    public static function reusableFile( $files, $index )
    {

      $filedict = [];
			$filedict['name'] = $files['fieldimage']['name'][ $index ]['field_value'];
			$filedict['type'] = $files['fieldimage']['type'][ $index ]['field_value'];
			$filedict['tmp_name'] = $files['fieldimage']['tmp_name'][ $index ]['field_value'];
			$filedict['error'] = $files['fieldimage']['error'][ $index ]['field_value'];
			$filedict['size'] = $files['fieldimage']['size'][ $index ]['field_value'];

      return $filedict;
    }


    public static function reusableFileMultiple( $files, $index, $filesarray_multiple )
    {

      if(isset($files['fieldimage_multiple']['name'][$index])) {
        $indexes_multiple = array_keys($files['fieldimage_multiple']['name'][$index]['field_value']);
        if( isset($files['fieldimage_multiple']['name'][$index]) ) {
          for ($m=0; $m < sizeof($files['fieldimage_multiple']['name'][$index]['field_value']); $m++) {
            $filedict_multiple = [];
            if( $files['fieldimage_multiple']['size'][$index]['field_value'][$indexes_multiple[$m]] > 0 ) {

              $filedict_multiple['name'] = $files['fieldimage_multiple']['name'][$index]['field_value'][$indexes_multiple[$m]];
              $filedict_multiple['type'] = $files['fieldimage_multiple']['type'][$index]['field_value'][$indexes_multiple[$m]];
              $filedict_multiple['tmp_name'] = $files['fieldimage_multiple']['tmp_name'][$index]['field_value'][$indexes_multiple[$m]];
              $filedict_multiple['error'] = $files['fieldimage_multiple']['error'][$index]['field_value'][$indexes_multiple[$m]];
              $filedict_multiple['size'] = $files['fieldimage_multiple']['size'][$index]['field_value'][$indexes_multiple[$m]];


              if(!isset($filesarray_multiple[$index])) {
                $filesarray_multiple[$index] = [];
              }
              array_push( $filesarray_multiple[$index], $filedict_multiple );
            } else {
              if(!isset($filesarray_multiple[$index])) {
                $filesarray_multiple[$index] = [];
              }
              array_push( $filesarray_multiple[$index], $filedict_multiple );
            }
          }
        }
      }

      return $filesarray_multiple;
    }

    public static function queryConditions($conditions, $is_fieldimage=false)
    {
      $whereclause = "";
      $conditionvalues = [];

      if( $is_fieldimage ) {

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
      } else {

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
        }


      return [
        "where_clause" => $whereclause,
        "condition_values" => $conditionvalues
      ];
    }

    public static function getFilesFromFileMultiples($filesarray_multiple, $files, $indexes)
    {
      $indexes_multiple = array_keys($files['fieldimage_multiple']['name'][$indexes[0]]['field_value']);
  		if( isset($files['fieldimage_multiple']['name'][$indexes[0]]) ) {
  			for ($m=0; $m < sizeof($files['fieldimage_multiple']['name'][$indexes[0]]['field_value']); $m++) {
  				$filedict_multiple = [];
  				if( $files['fieldimage_multiple']['size'][$indexes[0]]['field_value'][$indexes_multiple[$m]] > 0 ) {

  					$filedict_multiple['name'] = $files['fieldimage_multiple']['name'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
  					$filedict_multiple['type'] = $files['fieldimage_multiple']['type'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
  					$filedict_multiple['tmp_name'] = $files['fieldimage_multiple']['tmp_name'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
  					$filedict_multiple['error'] = $files['fieldimage_multiple']['error'][$indexes[0]]['field_value'][$indexes_multiple[$m]];
  					$filedict_multiple['size'] = $files['fieldimage_multiple']['size'][$indexes[0]]['field_value'][$indexes_multiple[$m]];


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
      return $filesarray_multiple;
    }

    // get instance in db if image exists
    public static function imagepathKeyAndImagepathFromConditions($conditions, $tablename, $fieldimages, $indexes, $index)
    {

      $imagepath_key = "";
      $current_imagepath = "";

      if( $conditions ) {

				// make the where clause from the passed conditions
				$whereclause = Convert::queryConditions($conditions, true)['where_clause'];

				// make the where query VALUES from the passed conditions
				$conditionvalues = Convert::queryConditions($conditions, true)['condition_values'];

				// run query to check if image exists in database
				$query = "SELECT * FROM " . $tablename . " " . $whereclause;
				$values = $conditionvalues;
				$type = "select";
				$result = CustomData::call( "DBClasses", "querySQL", [ $query, $values, $type ] );

				if( $result[0] == 1 ) {
					// if image exists in db then get the column name that goes with it
					$imagepath_key = $fieldimages[$indexes[$index]]['col_name'];
					if( explode(".", $imagepath_key) > 1 ) {
						$imagepath_key = explode(".", $imagepath_key)[1];
					}

					// also get the current imagepath that is saved in the database
					if( isset( $result[1][0][$imagepath_key] ) ) {
						$current_imagepath = $result[1][0][$imagepath_key];
					}
				}
			}

      return [
        "imagepath_key" => $imagepath_key,
        "current_imagepath" => $current_imagepath
      ];

    }

    public static function colname($dict)
    {

      $colname = $dict['col_name'];
			$colname_arr = explode('.', $colname);
			if( isset($colname_arr) ) {
				if( sizeof( $colname_arr ) == 2 ) {
					$colname = $colname_arr[1];
				}
			}
      return $colname;
    }

    public static function conditions($dict)
    {
      if( !isset($dict['field_conditions']) ) {
				$conditions = false;
			}else{
				$conditions = $dict['field_conditions'];
			}
      return $conditions;
    }

    public static function fieldValue($dict)
    {
      if( !isset($dict['field_value'] ) ){
  			$fieldvalue = false;
  		}else{
  			$fieldvalue = $dict['field_value'];
  		}
      return $fieldvalue;
    }
}
