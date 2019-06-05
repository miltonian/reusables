<?php

namespace Reusables;

class Form
{
    public static function makeInsertOnly($tablename, $identifier, $ishtml=false)
    {
        // data needs to be from 'DESCRIBE tablename' SQL query

        Form::prepareInsertOnly($tablename, $identifier);

        Section::place("smartform_inmodal", $identifier, $ishtml);
    }

    public static function placeInsert($tablename, $identifier, $ishtml=false)
    {
        Form::prepareInsertOnly($tablename, $identifier);

        Section::place("smartform", $identifier, $ishtml);
    }

    public static function prepareInsert($tablename, $identifier)
    {
        Form::prepareInsertOnly($tablename, $identifier);
    }

    public static function prepareInsertOnly($tablename, $identifier)
    {
        $query = 'DESCRIBE ' . $tablename;
        $values = [];
        $type = 'select';
        $data = CustomData::call("DBClasses", "querySQL", [$query, $values, $type])[1];

        $converteddata = [];
        foreach ($data as $r) {
            if ($r['Field'] == "id") {
                continue;
            }
            $converteddata[$r['Field']] = "";
        }

        $conditions = [[]];
        $returningdict = RFormat::toValueAndDBInfo($converteddata, $conditions, $tablename);
        // exit( json_encode( $returningdict ) );

        $formwithsameid_dict = Data::get($identifier);
        if ($formwithsameid_dict) {
            if (isset($formwithsameid_dict['value'])) {
                $formwithsameid_dict_real = $formwithsameid_dict['value'];
                $returningdict_real = $returningdict['value'];

                $formwithsameid_dict_tablenames = $formwithsameid_dict['db_info']['tablenames'];
                $returningdict_tablenames = $returningdict['db_info']['tablenames'];

                $formwithsameid_dict_colnames = $formwithsameid_dict['db_info']['colnames'];
                $returningdict_colnames = $returningdict['db_info']['colnames'];

                $newdict_real = array_merge($formwithsameid_dict_real, $returningdict_real);
                $newdict_tablenames = array_merge($formwithsameid_dict_tablenames, $returningdict_tablenames);
                $newdict_colnames = array_merge($formwithsameid_dict_colnames, $returningdict_colnames);
                $returningdict['value'] = $newdict_real;
                $returningdict['db_info']['tablenames'] = $newdict_tablenames;
                $returningdict['db_info']['colnames'] = $newdict_colnames;
            }
        }

        Data::add($returningdict, $identifier);
        Options::add(true, "ifnone_insert", $identifier);
    }

    public static function makeDynamicInsertOnly($featured_content_id, $identifier, $user_id=0)
    {
        // data needs to be from 'DESCRIBE tablename' SQL query

        $query = 'DESCRIBE custom_data';
        $values = [];
        $type = 'select';
        $data = CustomData::call("DBClasses", "querySQL", [$query, $values, $type])[1];
        $conditions = [[]];

        // exit( json_encode( $returningdict ) );


        //start new

        $query = 'SELECT * FROM customdata_params WHERE featured_content_id=? ORDER BY customdata_params.custom_param_classid ASC';
        $values = [ $featured_content_id ];
        $type = 'select';
        $customparamdict = CustomData::call("DBClasses", "querySQL", [$query, $values, $type])[1];

        $customparam_keyvalues = [];
        foreach ($customparamdict as $key) {
            if (!isset($customparam_keyvalues[$key['custom_param_classid']])) {
                $customparam_keyvalues[$key['custom_param_classid']] = [];
            }
            array_push($customparam_keyvalues[$key['custom_param_classid']], $key);
        }
        $customparam_i = 0;
        $all_input_keys = [];
        $inputs = [];
        $keystrings = [];
        $customparamclassid_grouped = [];
        // exit( json_encode( $featured_content_id ) );
        foreach ($customparam_keyvalues as $input) {
            $input_keys = [];
            $inputdict = [];
            foreach ($input as $dict) {
                if ($dict['key_string'] == "name") {
                    if (isset($inputdict['name'])) {
                        if ($inputdict['name'] != $dict['value_string']) {
                            array_push($keystrings, $dict['value_string']);
                        }
                    } else {
                        array_push($keystrings, $dict['value_string']);
                    }
                }
                $inputdict[ $dict['key_string'] ] = $dict['value_string'];
                $inputdict['type'] = $dict['type_string'];
                // exit( json_encode( $inputdict['type'] ) );
            }
            array_push($customparamclassid_grouped, $input[0]['custom_param_classid']);

            // exit( json_encode( $returningdict['value'] ) );
            // exit( json_encode( $input[0] ) );

            $input_keys["value_string"] = [
                "labeltext"=>Data::getValue($inputdict, "labeltext"),
                "placeholder"=>Data::getValue($inputdict, "placeholder"),
                "field_value"=>Data::getValue($inputdict, "value"),
                "type"=>Data::getValue($inputdict, "type"),
            ];

            $input_keys["user_id"] = ["type"=>"hidden", "field_value"=>$user_id];
            $input_keys["featured_content_id"] = ["type"=>"hidden", "field_value"=>$featured_content_id];//;
            $input_keys["custom_param_classid"] =  ["type"=>"hidden", "field_value"=>$input[0]['custom_param_classid']];
            $input_keys["key_string"] = ["type"=>"hidden", "field_value"=>$inputdict['name']];

            array_push($all_input_keys, $input_keys);





            // array_push( $inputs, $returningdict['value'] );
            $customparam_i++;
        }

        $insertvalues = [];
        $firstindex = 0;
        foreach ($keystrings as $ks) {
            foreach ($input_keys as $k=>$v) {
                if ($k == "value_string") {
                    array_push($insertvalues, "");
                } elseif ($k == "user_id") {
                    array_push($insertvalues, strval($user_id));
                } elseif ($k == "featured_content_id") {
                    array_push($insertvalues, $featured_content_id);
                } elseif ($k == "custom_param_classid") {
                    array_push($insertvalues, $customparamclassid_grouped[$firstindex]);
                } elseif ($k == "key_string") {
                    array_push($insertvalues, $ks);
                }
            }
            $firstindex++;
        }

        // exit( json_encode( $insertvalues ) );
        // $conditionsdict = [];
        // foreach ($conditions as $c) {
        // 	$conditionsdict[$c["key"]] = $c["value"];
        // }

        $converteddata = [];
        foreach ($data as $r) {
            if ($r['Field'] == "id") {
                continue;
            }
            // if( isset( $conditionsdict[ $r['Field'] ] ) ) {

            // if( $r['Field'] == "featured_content_id" ) {
            // 	$converteddata[$r['Field']] = $featured_content_id;
            // } else if( $r['Field'] == "custom_param_classid" ) {
            // 	$converteddata[$r['Field']] = $custom_param_classid;
            // } else if( $r['Field'] == "key_string" ) {
            // 	$converteddata[$r['Field']] = $inputdict['name'];
            // } else{
            // 	$converteddata[$r['Field']] = "";//$conditionsdict[ $r['Field'] ];
            // }

            // }else{
            $converteddata[$r['Field']] = "";
            // }
        }

        $returningdict = RFormat::toValueAndDBInfo($converteddata, $conditions, "custom_data");


        // $returningdict['value'] = $inputs;
        // exit( json_encode( $returningdict ) );
        // exit( json_encode( $all_input_keys ) );
        // done new



        Data::add($returningdict, $identifier);
        Options::add(true, "ifnone_insert", $identifier);
        Options::add(true, "multiple_inserts", $identifier);
        Options::add($all_input_keys, "input_keys", $identifier);
        Options::add($insertvalues, "insert_values", $identifier);
    }

    public static function makeDynamic($fetched_result, $featured_content_id, $identifier, $user_id=0)
    {
        // data needs to be from 'DESCRIBE tablename' SQL query

        $returningdict = $fetched_result;
        // exit( json_encode( $returningdict ) );


        //start new

        $query = '
		SELECT customdata_params.*
		FROM customdata_params
			INNER JOIN custom_data
				ON customdata_params.custom_param_classid=custom_data.custom_param_classid
					AND customdata_params.featured_content_id=custom_data.featured_content_id
					AND customdata_params.featured_content_id=?
					GROUP BY customdata_params.id
					ORDER BY customdata_params.custom_param_classid ASC';
        $values = [ $featured_content_id ];
        $type = 'select';
        $customparamdict = CustomData::call("DBClasses", "querySQL", [$query, $values, $type])[1];
        // exit( json_encode( $customparamdict ) );

        $customparam_keyvalues = [];
        foreach ($customparamdict as $key) {
            if (!isset($customparam_keyvalues[$key['custom_param_classid']])) {
                $customparam_keyvalues[$key['custom_param_classid']] = [];
            }
            array_push($customparam_keyvalues[$key['custom_param_classid']], $key);
        }

        $customparam_i = 0;
        $all_input_keys = [];
        $inputs = [];
        // exit( json_encode( $customparamdict ) );
        foreach ($customparam_keyvalues as $input) {
            $input_keys = [];
            $inputdict = [];
            foreach ($input as $dict) {
                $inputdict[ $dict['key_string'] ] = $dict['value_string'];
                $inputdict['type'] = $dict['type_string'];
                // exit( json_encode( $inputdict['type'] ) );
            }
            // exit( json_encode( $returningdict['value'] ) );
            // exit( json_encode( $input[0] ) );
            $input_keys["value_string"] = [
                "labeltext"=>Data::getValue($inputdict, "labeltext"),
                "placeholder"=>Data::getValue($inputdict, "placeholder"),
                "field_value"=>Data::getValue($inputdict, "value"),
                "type"=>Data::getValue($inputdict, "type"),
                "field_index"=>$customparam_i
            ];

            $input_keys["user_id"] = ["type"=>"hidden", "field_value"=>$user_id];
            $input_keys["featured_content_id"] = ["type"=>"hidden", "field_value"=>$featured_content_id];//;
            $input_keys["custom_param_classid"] =  ["type"=>"hidden", "field_value"=>$input[0]['custom_param_classid']];

            array_push($all_input_keys, $input_keys);

            // array_push( $inputs, $returningdict['value'] );
            $customparam_i++;
        }
        // $returningdict['value'] = $inputs;
        // exit( json_encode( $returningdict ) );
        // exit( json_encode( $customparam_keyvalues ) );
        // done new

        Data::add($returningdict, $identifier);
        // Options::add( true, "ifnone_insert", $identifier );
        Options::add(true, "multiple_updates", $identifier);
        Options::add($all_input_keys, "input_keys", $identifier);
    }


    // adds javascript to form. connecting actions to each textfield and their corresponding views
    public static function addJSClassToForm($identifier, $viewdict, $input_onlykeys, $original_data_id)
    {
        // start buffer
        ob_start();

        // get view options
        $viewoptions = Options::get($identifier);

        // convert ifnone_insert option into a boolean
        // (ifnone_insert option is to insert a value if nothing exists already)
        if (!isset($viewoptions['ifnone_insert'])) {
            $ifnone_insert = false;
        } else {
            $ifnone_insert = $viewoptions['ifnone_insert'];
        }

        // convert multiple_inserts option into a boolean
        if (!isset($viewoptions['multiple_inserts'])) {
            $multiple_inserts = false;
        } else {
            $multiple_inserts = $viewoptions['multiple_inserts'];
        }

        // convert multiple_updates option into a boolean
        if (!isset($viewoptions['multiple_updates'])) {
            $multiple_updates = false;
        } else {
            $multiple_updates = $viewoptions['multiple_updates'];
        }

        // use passed formaction or default
        if (!isset($viewoptions['formaction'])) {
            // default
            $formaction = '/edit_view.php';
        } else {
            // custom
            $formaction = $viewoptions['formaction'];
        }

        // remove formtitle if it exists
        if (isset($viewdict['formtitle'])) {
            unset($viewdict['formtitle']);
        }

        // default to step 1
        $steps = 1;
        $onstep = 1;
      ?>

			<?php if ($steps == $onstep) { ?>

				var viewdict = <?php echo json_encode($viewdict) ?>;
				var input_keys = <?php echo json_encode($input_onlykeys) ?>;
				var typearray = <?php echo json_encode(Form::getTypeArray($input_onlykeys)) ?>;
				var dataarray = <?php echo json_encode(Data::getFullArray($viewdict)) ?>;
				var formatteddata = <?php echo json_encode(Data::get($original_data_id)) ?>;
				var identifier = "<?php echo $identifier ?>";

				class <?php echo $identifier ?>Classes {

          // when a view is clicked on (with editing triggered), this function: populateview() is called
          // the index will be null if there is only one view
          // the index will not be null if there is more than one view in the row
					populateview( index=null ){
// var data = Data.get('<?php echo $identifier ?>');
// var fullarray = Data.getFullArray(data);
// console.log( 'fullarray: '+JSON.stringify( data ) );

					<?php
              // add insert_values to a variable
              $insert_values = [];
              if (isset($viewoptions['insert_values'])) {
                  $insert_values = $viewoptions["insert_values"];
              }
          ?>

          /* if option form, go through a list of options and perform the corresponding javascript */
          <?php if( isset($viewoptions['is_option_form']) ) { ?>
            <?php if( $viewoptions['is_option_form'] == "1" ) { ?>

              $('.<?php echo $identifier ?> input[type="text"]').on('input', function() {

                <?php
                    $connected_identifier = str_replace("_options_form", "", $identifier);
                ?>

                var input_class = $(this).parent().attr("class");
                var container_class = ".<?php echo $connected_identifier ?>.viewtype_<?php echo Info::viewtype_base($connected_identifier) ?>.<?php echo Info::file_name($connected_identifier) ?>.main";
                var inner_class = ".<?php echo Info::file_name($connected_identifier) ?>.inner ";

                // container spacing
                if( input_class.includes('padding') ) {
                  $('body').append( '<style> '+container_class+' { padding: '+$(this).val()+' !important; width: calc(100% - '+$(container_class).css("margin-left")+' - '+$(container_class).css("margin-left")+' - '+($(this).val()*2)+'px) !important; } </style>' );
                } else if( input_class.includes('margin') ) {
                  $('body').append( '<style> '+container_class+' { margin: '+$(this).val()+' !important; width: calc(100% - '+$(container_class).css("padding-left")+' - '+$(container_class).css("padding-left")+' - '+($(this).val()*2)+'px) !important; } </style>' );
                }

                // text sizes
                if( input_class.includes('_title') && input_class.includes('size') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.title { font-size: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('subtitle') && input_class.includes('size') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.subtitle { font-size: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('description') && input_class.includes('size') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.description { font-size: '+$(this).val()+' !important;  } </style>' );
                }

                // image sizes
                if( input_class.includes('_image') && input_class.includes('_size') ) {
                  $('body').append( '<style> '+container_class+' '+inner_class+' { background-size: '+$(this).val()+' !important;  } </style>' );
                }

                // corder radii
                if( input_class.includes('_image') && input_class.includes('corner_radius') ) {
                  $('body').append( '<style> '+container_class+' '+inner_class+'.image { border-radius: '+$(this).val()+' !important;  } </style>' );
                }

                // text colors
                if( input_class.includes('_text') && input_class.includes('color') ) {
                  $('body').append( '<style> '+container_class+' .content_container { color: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('_title') && input_class.includes('color') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.title { color: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('subtitle') && input_class.includes('color') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.subtitle { color: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('description') && input_class.includes('color') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.description { color: '+$(this).val()+' !important;  } </style>' );
                }

                // background colors
                if( input_class.includes('_background') && input_class.includes('color') ) {
                  $('body').append( '<style> '+container_class+' { background-color: '+$(this).val()+' !important;  } </style>' );
                }

                // text alignment
                if( input_class.includes('_text') && input_class.includes('align') ) {
                  $('body').append( '<style> '+container_class+' '+inner_class+' { text-align: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('_title') && input_class.includes('align') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.title { text-align: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('subtitle') && input_class.includes('align') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.subtitle { text-align: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('description') && input_class.includes('align') ) {
                  $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.description { text-align: '+$(this).val()+' !important;  } </style>' );
                }

                // text spacing
                if( input_class.includes('_text') && input_class.includes('offset_x') ) {
                  $('body').append( '<style> '+container_class+' .content_container { margin-left: '+$(this).val()+' !important;  } </style>' );
                } else if( input_class.includes('_text') && input_class.includes('offset_y') ) {
                  $('body').append( '<style> '+container_class+' .content_container { margin-top: '+$(this).val()+' !important;  } </style>' );
                }

                // overlays
                if( input_class.includes('overlay') ) {
                  if( $(this).val() == '1' || $(this).val() == 'true' ) {
                    $('body').append( '<style> '+container_class+' .overlay { display: inline-block !important;  } </style>' );
                  } else if( $(this).val() == '0' || $(this).val() == 'false' ) {
                    $('body').append( '<style> '+container_class+' .overlay { display: none !important;  } </style>' );
                  }
                }

                // reversing
                if( input_class.includes('reverse') ) {
                  if( $(this).val() == '1' || $(this).val() == 'true' ) {
                    $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.reversed { display: inline-block !important;  } </style>' );
                    $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.not_reversed { display: none !important;  } </style>' );
                  } else if( $(this).val() == '0' || $(this).val() == 'false' ) {
                    $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.reversed { display: none !important;  } </style>' );
                    $('body').append( '<style> '+container_class+' .<?php echo Info::file_name($connected_identifier) ?>.not_reversed { display: inline-block !important;  } </style>' );
                  }
                }

                // height
                if( input_class.includes('height') ) {
                  $('body').append( '<style> '+container_class+' '+inner_class+' { height: '+$(this).val()+' !important;  } </style>' );
                }
              });
            <?php } ?>
          <?php } ?>


						var multiple_updates = "<?php echo $multiple_updates ?>";
						var multiple_inserts = "<?php echo $multiple_inserts ?>";
						var insert_values = <?php echo json_encode($insert_values) ?>;

						var viewdict = <?php echo json_encode($viewdict) ?>;
						var input_keys = <?php echo json_encode($input_onlykeys) ?>;


						var newinput_keys = [];
						var newtypearray = [];
						var newinsertvalues = [];

            // get an array of the inputs associated types (e.g. textfield, textarea, select, etc.)
						var typearray = <?php echo json_encode(Form::getTypeArray($input_onlykeys, $multiple_updates)) ?>;

            // if multiple inserts flag is set
						if( multiple_inserts ) {
							for (var i = 0; i < input_keys.length; i++) {
								if( i!=0 && input_keys[i]=="value_string" ) {
									newinput_keys.push(false)
									newtypearray.push(false)
									newinsertvalues.push(false)
								}
								newinput_keys.push(input_keys[i])
								newtypearray.push(typearray[i])
								newinsertvalues.push(insert_values[i])
							}
							input_keys = newinput_keys
							typearray = newtypearray
							insert_values = newinsertvalues
						}

            // get unformatted array
						var dataarray = <?php echo json_encode(Data::getFullArray($viewdict)) ?>;

            // get formatted array
						var formatteddata = <?php echo json_encode(Data::get($original_data_id)) ?>;

            // get identifier
						var identifier = "<?php echo $identifier ?>";

            // set the values for the inputs inside the smartform
						Reusable.setinputvalues( viewdict, input_keys, identifier, typearray, dataarray, formatteddata, index, multiple_updates, insert_values )

            // check to see how many steps there are in this form. If there's more than one then show a next button
						<?php if ($steps > 1) { ?>
							$('.<?php echo $identifier ?> .main_with_hidden.next').css({'display': 'inline-block'});
							$('.<?php echo $identifier ?> .main_with_hidden.save').css({'display': 'none'});
						<?php } else {
                ?>
							$('.<?php echo $identifier ?> .main_with_hidden.save').css({'display': 'inline-block'});
							$('.<?php echo $identifier ?> .main_with_hidden.next').css({'display': 'none'});
  					<?php } ?>
					}

          addAnotherViewColumn( index=null ) {

            // get identifier

            <?php
                // $connected_identifier = str_replace("_options_form", "", $identifier);
                $connected_identifier = str_replace("_form", "", $identifier);
            ?>
						var connected_identifier = "<?php echo $connected_identifier ?>";

            // if( index != null && index.toString() != '0' ) {
            //   Reusable.addAnotherViewColumn($('.'+connected_identifier+' .inner.index_'+index)[0], connected_identifier);
            // } else {
              Reusable.addAnotherViewColumn($('.'+connected_identifier)[0], connected_identifier);
            // }

          }
				}

		<?php } ?>

		<?php

        // capture the buffer
        $output = ob_get_contents();

        // end buffer
        ob_end_clean();


        return $output;
    }

    public static function getTypeArray($input_onlykeys, $multiple_updates=false)
    {
        $typearray = [];

        $i=0;
        foreach ($input_onlykeys as $k) {
            if ($k == "download_script") {
                array_push($typearray, 'copybutton_1');
            } else {
                if ($multiple_updates) {
                    $typearray = Input::getInputTypes();
                    break;
                } else {
                    $inputtype = Input::getInputType($k);
                    array_push($typearray, $inputtype);
                }
            }
            $i = $i+5;
        }

        return $typearray;
    }

    public static function addDefaultInputKeys($key, $identifier)
    {
        if ($identifier != "") {
            $viewoptions = Options::get($identifier . "_form");
            $defaultinputkeys = Data::getValue($viewoptions, "default_input_keys");
            if ($defaultinputkeys == "") {
                $defaultinputkeys = [];
            }
            $found = false;
            foreach ($defaultinputkeys as $k) {
                if ($k == $key) {
                    $found = true;
                }
            }
            if (!$found) {
                array_push($defaultinputkeys, $key);
            }

            Options::add($defaultinputkeys, "default_input_keys", $identifier . "_form");
        }
    }
}
