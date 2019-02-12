<?php

namespace Reusables;

class RFormat
{
  public static function formatForDefaultData($dataid)
  {
      $defaultdata = [];
      $fetcheddata = [];
      $type = "in_dict";

      if (Shortcuts::isAssoc(self::$alldata[$dataid]['value'])) {
          $fetcheddata = self::$alldata[$dataid]['value'];
      } else {
          $fetcheddata = self::$alldata[$dataid]['value'][0];
          $type = "in_array";
      }

      foreach ($fetcheddata as $k=>$v) {
          $defaultdata[ $k ] = [ "data_id" => $dataid, "key" => $k, "type" => $type ];
      }

      return $defaultdata;
  }

  public static function formatCellWithDefaultData($data_id, $index)
  {
      $data = Data::retrieveDataWithID($data_id);
      if (!isset($data['value'][$index])) {
          return null;
      }
      $dict = $data['value'][$index];
      $allkeys = array_keys($dict);
      $cell = [];
      foreach ($allkeys as $k) {
          $cell[$k] = [ "data_id"=>$data_id, "key"=>$k, "index"=>$index ];
      }
      $cell['index'] = $index;
      // exit( json_encode( $cell ) );
      $cell = Convert::keys($cell);
      // exit( json_encode( Data::getValue( $cell, 'slug' ) ) );
      return $cell;
  }

    public static function toValueAndDBInfo($result, $conditions, $default_table, $customcolname=null)
    {
        if (sizeof($result) == 0) {
            return $result;
        }
        if (isset($result[0])) {
            if ($result[0] == 0) {
                return $result;
            }
        }
        $i=0;
        foreach ($conditions as $c) {
            if (sizeof($c) == 0) {
                continue;
            }
            $key_arr = explode(".", $c['key']);
            if (sizeof($key_arr) < 2) {
                $conditions[$i]['key'] = $default_table.".".$c['key'];
            }
            $i++;
        }
        // exit( json_encode( $conditions ) );
        $newresult = [];

        foreach ($result as $key => $value) {
            if (!is_numeric($key)) {
                $newresult[$default_table . "." . $key] = $result[$key];
            } else {
                // exit( json_encode( $value ) );
                $newvalue = [];
                foreach ($value as $k=>$v) {
                    $newvalue[$default_table . "." . $k] = $value[$k];
                }
                if (sizeof($newvalue) > 0) {
                    $value = $newvalue;
                    $result[$key] = $value;
                }
            }
        }
        if (sizeof($newresult) > 0) {
            $result = $newresult;
        }
        // exit( json_encode( $result ) );
        $tablenames = [];
        $colnames = [];
        $thisdict = [];
        if (Shortcuts::isAssoc($result)) {
            // is dict
            if ($result == null) {
                return [];
            }
            $thisdict = $result;
        } else {
            // is array
            if (!isset($result[0])) {
                return [];
            }

            $thisdict = $result[0];
        }
        $allkeys = array_keys($thisdict);

        foreach ($allkeys as $k) {
            $tablenames[$k] = $default_table;
            if ($customcolname) {
                $colnames[$k] = $customcolname;
            } else {
                $colname_arr = explode(".", $k);
                $addtable = true;
                if (isset($colname_arr)) {
                    if (sizeof($colname_arr) > 1) {
                        $addtable = false;
                    }
                }
                if ($addtable) {
                    $colnames[$k] = $default_table.".".$k;
                } else {
                    $colnames[$k] = $k;
                }
            }
        }
        $returningdict = [
      "value" => $result,
      "db_info" => [
        "tablenames" => $tablenames,
        "colnames" => $colnames,
        "conditions" => $conditions
      ]
    ];

        return $returningdict;
    }

    // RFormat::convertViewActions converts the appropriate classes to connect a modal or modals
    public static function convertViewActions($dict)
    {
      // check if null
        if ($dict == null) {
            return [];
        }

        // get buttons or actions from passed dictionary
        $action_key = RFormat::getViewActionKey($dict);

        // account for empty actions
        $multiple = false;
        if ($action_key == '') {
            $actiondict = $dict;
        } else {
            $actiondict = $dict[$action_key];
            $multiple = true;
        }

        // $multiple is in beta. don't worry about this for now
        if ($multiple) {
            $i=0;
            foreach ($actiondict as $action) {

                if (isset($action['modal']) || isset($action['help_modal'])) {

                    $actiondict[$i]['type'] = "modal";
                    $actionmodal = Data::getValue($action, 'modal');
                    if (!is_array($actionmodal) && $actionmodal != "") {

                        $new_actionmodal = [
                          "parentclass" => $actionmodal . "_wrapper",
                          "modalclass" => $actionmodal
                        ];
                        if (isset($action['help_modal'])) {
                            $actiondict[$i]['help_modal'] = $new_actionmodal;
                        } else {
                            $actiondict[$i]['modal'] = $new_actionmodal;
                        }
                    }
                }

                if (isset($action['options_modal'])) {

                    $actiondict[$i]['options_type'] = "options_modal";
                    $actionmodal = Data::getValue($action, 'options_modal');

                    if (!is_array($actionmodal) && $actionmodal != "") {

                        $new_actionmodal = [
                          "parentclass" => $actionmodal . "_wrapper",
                          "modalclass" => $actionmodal
                        ];
                        $actiondict[$i]['options_modal'] = $new_actionmodal;
                    }
                }
                $i++;
            }
        } else {

            if (isset($actiondict['modal'])) {

                // this connects a standard modal to a view or button
                $actiondict['type'] = "modal";
                $actionmodal = Data::getValue($actiondict, 'modal');
                if (!is_array($actionmodal) && $actionmodal != "") {

                    $new_actionmodal = [
                      "parentclass" => $actionmodal . "_wrapper",
                      "modalclass" => $actionmodal
                    ];

                    $actiondict['modal'] = $new_actionmodal;
                }
            } elseif (isset($actiondict['help_modal'])) {

                // help_modal connects a help modal to a label
                //    - will add a question mark next to a label and when you click on it, a modal will show
                $actiondict['type'] = "modal";
                $actionmodal = Data::getValue($actiondict, 'help_modal');
                if (!is_array($actionmodal) && $actionmodal != "") {

                    $new_actionmodal = [
                      "parentclass" => $actionmodal . "_wrapper",
                      "modalclass" => $actionmodal
                    ];

                    $actiondict['help_modal'] = $new_actionmodal;
                }
            }

            if (isset($actiondict['options_modal'])) {

                // options_modal connects a view to the options modal
                // the options modal allows users to edit a view's options without writing any code
                $actiondict['options_type'] = "options_modal";
                $actionmodal = Data::getValue($actiondict, 'options_modal');
                if (!is_array($actionmodal) && $actionmodal != "") {

                    $new_actionmodal = [
                      "parentclass" => $actionmodal . "_wrapper",
                      "modalclass" => $actionmodal
                    ];

                    $actiondict['options_modal'] = $new_actionmodal;
                }
            }
        }

        if ($action_key == '') {
            $dict = $actiondict;
        } else {
            $dict[$action_key] = $actiondict;
        }

        return $dict;
    }

    public static function getViewActionKey($dict)
    {

        $action_key = '';
        if (isset($dict['buttons'])) {
            $action_key = 'buttons';
        } elseif (isset($dict['actions'])) {
            $action_key = 'actions';
        }

        return $action_key;
    }
}
