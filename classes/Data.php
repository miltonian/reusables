<?php

namespace Reusables;

/*
    some instruction:
        - Data::add( $entry, $identifier )
            - adds data (usually from sql query) to a data_id
        - Data::get( $identifier )
            - retrieves the full array of this data_id ( $identifier holds the data_id value in this case )
        - RFormat::formatForDefaultData( $dataid )
            - arranges the data into the format in which the views understand
        - Data::getValue( $pair )
            - retrieves the value of a specified key from a default data set

*/

class Data
{
    protected static $alldata = array();

		// Data::add() is deprecated -- use Data::add() instead
    public static function addData($data, $identifier)
    {
        Data::add($data, $identifier);
    }

    // add data to view with identifier
		public static function add($data, $identifier)
		{
			if (!is_array($data)) {
					$data = Data::get($data);
			}

			$data['data_id'] = $identifier;
			self::$alldata[ $identifier ] = $data;

			Views::addView($identifier);
		}

  	// Options::add() is deprecated -- Use Options::add() instead
    public static function addOption($data, $key, $identifier)
    {
        Options::add($data, $key, $identifier);
    }

    // Data::addOptions() is deprecated -- Use Options::addOptions() instead
    public static function addOptions($data, $identifier)
    {
        Options::addOptions($data, $identifier);
    }

    // Data::addInfo() is deprecated -- Use Info::add() instead
    public static function addInfo($data, $key, $identifier)
    {
        Info::add($data, $key, $identifier);
    }

    // Data::getAllViewsInfo is deprecated -- Use Info::getAll() instead
    public static function getAllViewsInfo()
    {
        return Info::getAll();
    }

    public static function get($identifier)
    {
        if (is_array($identifier)) {
            return null;
        }
        if (!isset(self::$alldata[ $identifier ])) {
            return null;
        } else {
            return self::$alldata[ $identifier ];
        }
    }

    // Data::retrieveDataWithID() is deprecated -- Use Data::get() instead
    public static function retrieveDataWithID($identifier)
    {
        return Data::get( $identifier );
    }

  	// Options::retrieveOptionsWithID() is deprecated -- Use Options::get() instead
    public static function retrieveOptionsWithID($identifier)
    {
        return Options::get($identifier);
    }

    // Data::retrieveInfoWithID() is deprecated -- Use Info::get() instead
    public static function retrieveInfoWithID($identifier)
    {
        return Info::get($identifier);
    }

    public static function getDefaultDataID($viewdict)
    {
        if (Shortcuts::isAssoc($viewdict)) {
            $dict = $viewdict;
        } else {
            $dict = $viewdict[0];
        }
        if (isset($viewdict['data_id'])) {
            return $viewdict['data_id'];
        }
        $allkeys = array_keys($dict);
        if (isset($dict[ $allkeys[0] ]['data_id'])) {
            $data_id = $dict[ $allkeys[0] ]['data_id'];
            return $data_id;
        } else {
            return "";
        }
    }

    public static function getDefaultConditionsWithID($identifier)
    {
        $data = Data::get($identifier);

        return $data['db_info']['conditions'];
    }

    public static function getDefaultTableNameWithID($identifier, $key="")
    {
        $data = Data::get($identifier);
        if (!isset($data['db_info'])) {
            return "";
        }
        $tablenames = $data['db_info']['tablenames'];

        if (isset($tablenames[$key])) {
            if ($tablenames[$key] != "") {
                return $tablenames[$key];
            }
        }
        $allkeys = array_keys($tablenames);
        return $tablenames[$allkeys[0]];
    }

    public static function getDefaultTableNameWithData($data)
    {
        if (!isset($data['db_info'])) {
            return "";
        }
        $tablenames = $data['db_info']['tablenames'];

        $allkeys = array_keys($tablenames);
        return $tablenames[$allkeys[0]];
    }


    public static function getValue($dict, $key=-1, $identifier="")
    {
        if (is_string($dict)) {
            return $dict;
        }

        if (!is_array($dict)) {
            $dict = Data::get($dict);
        }

        if ($key == -1) {
            $allkeys = array_keys($dict);
            $thevalue = [];
            foreach ($allkeys as $key) {
                $keyvalue = Data::getValue($dict, $key);
                $thevalue[$key] = $keyvalue;
            }
            return $thevalue;
        } elseif (isset($dict[ $key ])) {
            $pair = $dict[ $key ];
        } else {
            if (isset($dict['value'][ $key ])) {
                $pair = $dict['value'][ $key ];
            } else {
                $tablename = "";

                if (isset($dict['db_info'])) {
                    if (isset($dict['db_info']['tablenames'])) {
                        $firstkey = array_keys($dict['db_info']['tablenames'])[0];
                        $tablename = $dict['db_info']['tablenames'][$firstkey];
                    }
                } else {
                    if (isset($dict['data_id'])) {
                        $info = Info::get($dict['data_id']);
                        if (strtolower($info['viewtype']) == "cell") {
                            $cellindex = Data::getValue($dict, 'index');
                            $table_identifier = str_replace("_cell_".$cellindex, "", $dict['data_id']);
                            $tablename = Data::getDefaultTableNameWithID($table_identifier);
                        }
                    } elseif ($identifier != "") {
                        $info = Info::get($identifier);

                        if (strtolower($info['viewtype']) == "cell") {
                            $cellindex = Data::getValue($dict, 'index');
                            $table_identifier = str_replace("_cell_".$cellindex, "", $identifier);
                            $tablename = Data::getDefaultTableNameWithID($table_identifier);
                        } else {
                            $tablename = Data::getDefaultTableNameWithID($identifier);
                        }
                    }
                }

                if ($tablename != "") {
                    $key = $tablename.".".$key;
                    if (isset($dict[ $key ])) {
                        $pair = $dict[ $key ];
                    } elseif (isset($dict['value'][ $key ])) {
                        $pair = $dict['value'][ $key ];
                    } elseif (isset($dict['value'])) {
                      if( isset($dict['value'][0]) ) {
                        if( isset($dict['value'][0][$key]) ) {
                          return $pair = $dict['value'][0][$key];
                        }else {
                          return "";
                        }
                      }else {
                        return "";
                      }
                    } else {
                        return "";
                    }
                } else {
                    return "";
                }
            }
        }

        $hasindex = false;
        if (!isset($pair['data_id'])) {
            return $pair;
        }
        if (!isset($pair['key'])) {
            return $pair;
        }
        if (isset($pair['index'])) {
            $hasindex = true;
        }

        if ($hasindex) {
            $thevalue = self::retrieveDataWithID($pair['data_id']);
            if ($thevalue) {
                $thevalue = $thevalue['value'][ $pair['index'] ][ $pair['key'] ];
            } else {
                $thevalue = "";
            }
        } else {
            $thevalue = self::retrieveDataWithID($pair['data_id']);
            // exit( json_encode( $thevalue['value'][0]['id'] ) );
            if ($thevalue) {
                $thevalue = $thevalue['value'][ $pair['key'] ];
            } else {
                $thevalue = "";
            }
        }

        if ($thevalue == null) {
            // $thevalue = $pair;
            $thevalue = "";
        }

        Form::addDefaultInputKeys($key, $identifier);

        return $thevalue;
    }

    public static function getConditions($pair)
    {
        if (!isset($pair['data_id'])) {
            return "";
        }
        if (!isset($pair['key'])) {
            return "";
        }

        if (!isset(self::retrieveDataWithID($pair['data_id'])['db_info'])) {
            $pairdata = self::retrieveDataWithID($pair['data_id']);
            if (!isset($pairdata[0])) {
                return false;
            }
            $data = self::retrieveDataWithID($pair['data_id'])[0];
            $defaultTableName = self::getDefaultTableNameWithData($data);
            $pair['key'] = $defaultTableName . $pair['key'];
            $db_info = self::retrieveDataWithID($pair['data_id'])[0]['db_info'];
        } else {
            $db_info = self::retrieveDataWithID($pair['data_id'])['db_info'];
        }

        $conditions = $db_info[ "conditions" ];

        return $conditions;
    }

    public static function getColName($pair)
    {
        if (!isset($pair['data_id'])) {
            return "";
        }
        if (!isset($pair['key'])) {
            return "";
        }
        if (!isset(self::retrieveDataWithID($pair['data_id'])['db_info'])) {
            $pairdata = self::retrieveDataWithID($pair['data_id']);
            if (!isset($pairdata[0])) {
                return false;
            }
            $data = self::retrieveDataWithID($pair['data_id'])[0];
            $defaultTableName = self::getDefaultTableNameWithData($data);
            $pair['key'] = $defaultTableName . $pair['key'];
            $db_info = self::retrieveDataWithID($pair['data_id'])[0]['db_info'];
        } else {
            $db_info = self::retrieveDataWithID($pair['data_id'])['db_info'];
        }
        $colnames = $db_info[ "colnames" ];
        $tablenames = $db_info[ "tablenames" ];

        $key = $pair['key'];

        if (!isset($db_info[ "colnames" ][$pair['key']])) {
            $colname_fromkey_arr = explode('.', $key);
            if (sizeof($colname_fromkey_arr) != 2) {
                return null;
            }

            $colname_fromkey = $colname_fromkey_arr[1];
            if (!isset($db_info[ "colnames" ][$colname_fromkey])) {
                return null;
            }

            $colname = $db_info[ "colnames" ][$colname_fromkey];
            $tablenames = $db_info[ "tablenames" ];
            // exit( json_encode( $tablenames ) );
            return $colname;

            return null;
        }
        $colname = $db_info[ "colnames" ][$pair['key']];

        return $colname;
    }

    public static function getFullArray($viewdict)
    {
        if (!is_array($viewdict)) {
            $viewdict = Data::get($viewdict);
        }
        $allkeys = array_keys($viewdict);
        $dataidarray = array();

        $dataid = false;
        if (isset($viewdict['index'])) {
            // echo " <script> alert( JSON.stringify( " . json_encode( $viewdict['index'] ) . " ) ) </script> ";
            if (isset($viewdict['index'])) {
                if (isset($viewdict[$allkeys[0]]['data_id'])) {
                    $dataid = $viewdict[$allkeys[0]]['data_id'];
                }
            } else {
                if (isset($viewdict['data_id'])) {
                    $dataid = $viewdict['data_id'];
                }
            }
        } else {
            if (isset($viewdict['data_id'])) {
                $dataid = $viewdict['data_id'];
            }
        }

        if ($dataid) {
            if ($dataid) {
                if ($dataid != null) {
                    if (!isset($dataidarray[ $dataid ])) {
                        $dataidarray[ $dataid ] = Data::get($dataid);
                    }
                }
            }
        } else {
            foreach ($allkeys as $k) {
                $dataid=null;
                if (isset($viewdict[$k]['data_id'])) {
                    $dataid = $viewdict[$k]['data_id'];
                }
                // echo "<script>alert( JSON.stringify( " . json_encode( $dataid ) . " ) );</script>";
                if ($dataid) {
                    if ($dataid != null) {
                        if (!isset($dataidarray[ $dataid ])) {
                            $dataidarray[ $dataid ] = Data::get($dataid);
                        }
                    }
                }
            }
        }




        return $dataidarray;
    }









    public static function makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable=false)
    {
        $fullarray = Data::getFullArray($viewdict);
        if (isset($viewdict[$identifier]['value'])) {
            $fullviewdict = Data::getFullArray($viewdict)[$identifier]['value'];
        } else {
            $fullviewdict = $viewdict;
        }

        $optiontype = Data::getValue($viewoptions, 'type');

        echo "var viewdict = " . json_encode($viewdict) . ";
	var viewoptions = " . json_encode($viewoptions) . ";

	var thismodalclass = '';

	var type = " . json_encode($optiontype) . ";";

        if ($optiontype == "modal" && isset($viewoptions['modal']['modalclass'])) {
            // extract( Input::convertInputKeys( $identifier . "_form" ));
            // 	echo ' ' . Form::addJSClassToForm( $identifier . "_form", $viewdict, $input_onlykeys, $identifier . "_form" ) . '; ';
            // 	echo " /*asdf*/ ";
            echo "thismodalclass = new " . $viewoptions['modal']['modalclass'] . "Classes();
		var dataarray = " . json_encode($fullviewdict) . ";";
        }
        echo "
	var optiontype = " . json_encode($optiontype) . ";";
        $formid = $identifier . "_form";
        $formviewoptions = Options::get($formid);
        echo '
	var formviewoptions = ' . json_encode($formviewoptions) . ";
	var identifier = " . json_encode($identifier) . ";

	if( optiontype == 'modal' || optiontype == 'dropdown' ) {
		e.preventDefault();
		if( typeof dataarray === 'undefined' ) {
			dataarray = []
		}

		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions, formviewoptions, identifier );
	}";

        Editing::getEditingFunctionsJS($viewoptions) ;
    }

    public static function getUnformatted($identifier )
    {
        $viewdict = Data::get($identifier);
        $viewoptions = Options::get($identifier);

        if (isset($viewdict['value'])) {
            unset($viewdict['value']['data_id']);
            if (Shortcuts::isAssoc($viewdict['value'])) {
                $viewdict['value'] = [$viewdict['value']];
            }
            $unformatted_arr = $viewdict['value'];
        } else {
            unset($viewdict['data_id']);
            if (Shortcuts::isAssoc($viewdict)) {
                $viewdict = [$viewdict];
            }
            $unformatted_arr = $viewdict;
        }
        return $unformatted_arr;
    }
}
