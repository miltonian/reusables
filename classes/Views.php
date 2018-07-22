<?php

namespace Reusables;


class Views {

	protected static $viewidentifiers = [];
	protected static $viewparams = [];

	protected static $bufferedviews = [];

	protected static $bufferedforms = [];
	protected static $queue = [];
	protected static $formqueue = [];

	protected static $analyze = false;

	public static function setDefaultViewInfo( $file, $identifier, $viewtype, $tablenames=[], $children=[] )
	{
		$viewoptions = Data::retrieveOptionsWithID( $identifier );
		Views::addEditableParts( $identifier );
// exit( json_encode( $viewtype ) );
		$dict = [
			"file"=>$file,
			"identifier"=>$identifier,
			"viewtype"=>$viewtype,
			"tablenames"=>$tablenames,
			"children"=>$children
		];


		// if( strtolower($viewtype) == "section" && ($file == "smartform_inmodal" || $file == "smartform") ) {
		// 	array_push( self::$bufferedforms, $dict );
		// } else {
			array_push( self::$bufferedviews, $dict );
		// }
	}

	public static function addEditableParts( $identifier ) {

		if( !empty( $viewoptions['editable'] ) && !empty( $viewoptions['insertonly'] ) && !empty( $viewoptions['editable_dynamic'] ) && !empty( $viewoptions['insertonly_dynamic'] ) ) {
			if( isset( $_SESSION['login'][0] ) ) {
				if( $_SESSION['login'][0] == 1 ) {
					Data::addOption( true, "editable", $identifier );
				}
			}
		}

		$viewoptions = Data::retrieveOptionsWithID( $identifier );
		// $viewinfo = Data::retrieveInfoWithID( $identifier );
		$viewinfo = Data::retrieveInfoWithID( $identifier );

		if( isset( $viewoptions["editable"] ) || isset( $viewoptions["insertonly"] ) || isset( $viewoptions["editable_dynamic"] ) || isset( $viewoptions["insertonly_dynamic"] ) ) {
			if( !isset($viewoptions["editable"] ) ) { $viewoptions["editable"] = false; }
			if( !isset($viewoptions["insertonly"] ) ) { $viewoptions["insertonly"] = false; }
			if( !isset($viewoptions["editable_dynamic"] ) ) { $viewoptions["editable_dynamic"] = false; }
			if( !isset($viewoptions["insertonly_dynamic"] ) ) { $viewoptions["insertonly_dynamic"] = false; }
			if( !isset($viewoptions["modal_table"] ) ) { $viewoptions["modal_table"] = false; }

			if(
				$viewoptions["editable"] == true || $viewoptions["editable"] == "true" ||
				$viewoptions["insertonly"] == true || $viewoptions["insertonly"] == "true" ||
				$viewoptions["editable_dynamic"] == true || $viewoptions["editable_dynamic"] == "true" ||
				$viewoptions["insertonly_dynamic"] == true || $viewoptions["insertonly_dynamic"] == "true"
			) {

				$viewdata = Data::retrieveDataWithID( $identifier );

				Data::addOption( "modal", "type", $identifier );
				Data::addOption( $identifier . "_form", "modal", $identifier );

				if( $viewoptions["insertonly"] == true ) {
					if( !isset( $viewoptions["tb"] ) ) {
						exit( "insertonly option needs a tablename option as well. the key to pass the tablename is 'tb'" );
					}
					$tablename = Data::getValue( $viewoptions, "tb" );
					Form::prepareInsertOnly( $tablename, $identifier . "_form" );
					$formoptions = Data::retrieveOptionsWithID( $identifier . "_form" );
					if( !isset($formoptions['input_keys']) ) {

						$viewtype = $viewinfo['viewtype'];
						$filename = $viewinfo['file'];
						$input_keys = Views::getViewInputs( $viewtype, $filename );
						if( $viewtype == "Table" ) {
							$viewtype = "Cell";
							$filename = $viewoptions['cellname'];
							if( $filename == "" ) {
								$filename = "imagetext_full";
							}
							$input_keys = Views::getViewInputs( $viewtype, $filename );
						}
						Data::addOption( $input_keys, "input_keys", $identifier . "_form" );
					}
					// Reusables\Form::makeInsertOnly( "customdata_params", "main_button_form" );
				} else if( $viewoptions["editable_dynamic"] == true ) {
					if( !isset( $viewoptions["featured_content_id"] ) ) {
						exit( "editable_dynamic option needs a featured_content_id option as well. the key to pass the featured_content_id is 'featured_content_id'" );
					}
					if( !isset( $viewoptions["form_data"] ) ) {
						exit( "editable_dynamic option needs a form_data option as well. the key to pass the form_data is 'form_data'" );
					}
					$user_id = 0;
					if( isset( $viewoptions["user_id"] ) ) {
						$user_id = $viewoptions["user_id"];
					}
					// exit( json_encode( $viewoptions["featured_content_id"] ) );
					Form::makeDynamic( $viewoptions['form_data'], $viewoptions["featured_content_id"], $identifier . "_form", $user_id );
				} else if( $viewoptions["insertonly_dynamic"] == true ) {
					if( !isset( $viewoptions["featured_content_id"] ) ) {
						exit( "insertonly_dynamic option needs a featured_content_id option as well. the key to pass the featured_content_id is 'featured_content_id'" );
					}
					$user_id = 0;
					if( isset( $viewoptions["user_id"] ) ) {
						$user_id = $viewoptions["user_id"];
					}
					Form::makeDynamicInsertOnly( $viewoptions["featured_content_id"], $identifier . "_form", $user_id );
				} else{
					if( $viewoptions["modal_table"] == true ) {
						if( !isset($viewoptions["modal_table_array"]) ) {
							exit( "missing modal_table_array" );
						}
						Data::addData( $viewoptions['modal_table_array'], $identifier . "_form" );
					}
					$formdata = Data::retrieveDataWithID( $identifier . "_form" );
					if( !isset( $formdata ) ) {
						Data::addData( $viewdata, $identifier . "_form" );
					}

					$formoptions = Data::retrieveOptionsWithID( $identifier . "_form" );
					if( !isset($formoptions['input_keys']) ) {

						$viewtype = $viewinfo['viewtype'];
						$filename = $viewinfo['file'];
						$input_keys = Views::getViewInputs( $viewtype, $filename );
						if( $viewtype == "Table" ) {
							$viewtype = "Cell";
							if( !isset( $viewoptions['cellname'] ) ) {
								$viewoptions['cellname'] = "";
							}
							$filename = $viewoptions['cellname'];
							if( $filename == "" ) {
								$filename = "imagetext_full";
							}
							$input_keys = Views::getViewInputs( $viewtype, $filename );
						}
						Data::addOption( $input_keys, "input_keys", $identifier . "_form" );
					}

					// exit(json_encode([$input_keys]));
				}
				$formoptions = Data::retrieveOptionsWithID($identifier . "_form");
					$goto = Data::getValue( $formoptions, "goto" );
					if( $goto == "" ) {
						$redirecturl = "/";
						if( isset($_SERVER['REDIRECT_URL']) ){ $redirecturl = $_SERVER['REDIRECT_URL']; }
						// exit( json_encode( $redirecturl ) );
						Data::addOption( $redirecturl, "goto", $identifier . "_form" );
					}
				if( $viewoptions["modal_table"] == true ) {
					Data::addOption( "/functions/change_featuredpost?featured_id=[[FEATURED_ID]]&post_id=", "pre_slug", $identifier . "_form" );
					Data::addOption( ["id"=>"slug"], "convert_keys", $identifier . "_form" );
					Data::addOption( "table", "modal_type", $identifier );
					$form_dict = [
						"file"=>"table",
						"identifier"=>$identifier . "_form",
						"viewtype"=>"modal",
						"tablenames"=>[],
						"children"=>[]
					];
				} else {
					$form_dict = [
						"file"=>"smartform_inmodal",
						"identifier"=>$identifier . "_form",
						"viewtype"=>"section",
						"tablenames"=>[],
						"children"=>[]
					];
				}
				array_push( self::$bufferedviews, $form_dict );

			}
		}
	}

	public static function makeView( $file, $identifier, $viewtype, $tablenames=[], $children=[] )
	{

		Views::analyzeView( $identifier );

		if( $viewtype == "wrapper" && $file != "wrapper_start" && $file != "wrapper_end" ) {

			ReusableClasses::addfile( "wrapper", "wrapper_1" );
			$View = View::factory( 'reusables/views/wrapper/wrapper_1' );
			$data = Data::retrieveDataWithID( $identifier );
			$View->set( 'wrapperdict', $data );
			$View->set( 'children', $children );
			$View->set( 'identifier', $identifier );

			// return $View->render();
		}else if( $viewtype == "structure" ) {

			ReusableClasses::addfile( "structure", $file );
			$View = View::factory( 'reusables/views/structure/' . $file );
			$data = Data::retrieveDataWithID( $identifier );
			$options = Data::retrieveOptionsWithID( $identifier );
			$View->set( 'viewdict', $data );
			$View->set( 'viewoptions', $options );
			$View->set( 'structuredict', $data );
			$View->set( 'identifier', $identifier );

			// echo $View->render();
		}else{
			ReusableClasses::addfile( $viewtype, $file );

			$lowercased_viewtype = strtolower( $viewtype );

			if( substr($lowercased_viewtype, 0, strlen("custom")) === "custom" ) {
				$arr = explode("/", $viewtype);
				$viewtype = $arr[1];
				// $View = View::factory( 'custom/views/' . $viewtype . '/' . $file );
				$View = View::factory( Page::$customdir . $viewtype . '/' . $file );
			} else {
				$View = View::factory( 'reusables/views/' . $viewtype . '/' . $file );
			}
			$data = Data::retrieveDataWithID( $identifier );
			$options = Data::retrieveOptionsWithID( $identifier );
			if( $identifier == "program_form" ) {
				if( isset($options['input_keys']) ) {
					$input_keys = $options['input_keys'];
					foreach ($input_keys as $key=>$value) {
						if( is_array($value) ){
							$field_value = "";
							$arraykeys = array_keys($value);

							foreach ($arraykeys as $ak) {
								if( $ak == "field_value" ) {
									$field_value = $value['field_value'];
									if( isset( $data['value'] ) ) {
										if( isset($data['value'][$key]) ) {
											$data['value'][$key] = $field_value;
										}
									} else {
										if( isset($data[$key]) ) {
											$data[$key] = $field_value;
										}
									}
								}
							}
						}
					}
				}
			}

			Data::addData( $data, $identifier );
			$options = ReusableClasses::convertViewActions( $options );

			$View->set( 'viewdict', $data );
			$View->set( 'viewoptions', $options );
			if( $viewtype == "section" ){
				$View->set( 'tablenames', $tablenames );
			}

			$View->set( 'identifier', $identifier );

		}

		array_push( self::$viewidentifiers, $identifier );

		return $View->render();

	}

	public static function makeViews()
	{

		foreach (self::$bufferedviews as $dict) {
			$viewtype = $dict["viewtype"];
			if( $viewtype == "CustomCode" ) {
				echo $dict["code"];
			}else{
				$file = $dict["file"];
				$identifier = $dict["identifier"];
				$tablenames = $dict["tablenames"];
				$children = $dict["children"];

				echo Views::makeView( $file, $identifier, $viewtype, $tablenames, $children=[] );
			}



			// return $View->render();
			// echo $View->render();
		}


		// Views::makeForms();
	}

	public static function makeForms()
	{
		exit( json_encode( self::$bufferedforms ) );
		foreach (self::$bufferedforms as $dict) {
			$viewtype = $dict["viewtype"];
			if( $viewtype == "CustomCode" ) {
				echo $dict["code"];
			}else{
				$file = $dict["file"];
				$identifier = $dict["identifier"];
				$tablenames = $dict["tablenames"];
				$children = $dict["children"];


				echo Views::makeView( $file, $identifier, $viewtype, $tablenames, $children=[] );
			}

		}
	}

	public static function addView( $identifier )
	{
		array_push(Views::$viewidentifiers, $identifier);
	}

	public static function getViewIdentifiers()
	{
		return self::$viewidentifiers;
	}

	public static function setParams( $dataparams, $optionparams, $identifier, $numofrows=0 )
	{
		self::$viewparams[$identifier]['data'] = $dataparams;
		self::$viewparams[$identifier]['options'] = $optionparams;
		self::$viewparams[$identifier]['numofrows'] = $numofrows;
		// Views::analyzeView( $identifier );

	}

	public static function getDataParams( $identifier )
	{
		if( !isset( self::$viewparams[$identifier]['data'] ) ) {
			return [];
		}

		return self::$viewparams[$identifier]['data'];
	}

	public static function getOptionParams( $identifier )
	{
		if( !isset( self::$viewparams[$identifier]['options'] ) ) {
			return [];
		}

		return self::$viewparams[$identifier]['options'];
	}

	public static function cleararrays()
	{
		self::$viewidentifiers = null;
		self::$viewparams = null;
		self::$bufferedviews = null;
		self::$bufferedforms = null;

		self::$viewidentifiers = [];
		self::$viewparams = [];
		self::$bufferedviews = [];
		self::$bufferedforms = [];
	}

	public static function analyze( $turnOn = false )
	{
		self::$analyze = $turnOn;
	}

	public static function analyzeView( $identifier )
	{
		if( self::$analyze ) {
				$data = Data::retrieveDataWithID( $identifier );
				$options = Data::retrieveOptionsWithID( $identifier );
				$info = Data::retrieveInfoWithID( $identifier );
				if( !$info ) {
					return;
				}
				// $dataparams = Views::getDataParams( $identifier );
				$viewtype = $info['viewtype'];
				$filename = $info['file'];
				if( $filename == "smartform" || $filename == "smartform_inmodal" || $viewtype == "Modal" ) {
return;
				}
				$dataparams = Views::getViewInputs( $viewtype, $filename );
// exit( json_encode( [$dataparams, $viewtype, $filename, $options, $identifier] ) );
				if( $data && $dataparams ) {
					// ready to start analyzing
					if( isset( $data['value'] ) ) {
						$data = $data['value'];
					}
					Views::deduct( $data, $dataparams, "featured_imagepath", "imagepath", $identifier );
					Views::deduct( $data, $dataparams, "name", "title", $identifier );

				}

		}
	}

	public static function deduct( $data, $dataparams, $datakey, $paramkey, $identifier )
	{
		$datakey_value = Data::getValue( $data, $datakey );
		$paramkey_value = Data::getValue( $data, $paramkey );
		if( ($datakey_value == "" && $paramkey_value != "") && ($datakey == "featured_imagepath" || $paramkey == "featured_imagepath") ) {
			unset( $data[$datakey] );
			Data::overwriteData( $data, $identifier );
			Data::addOption( [$paramkey=>$datakey], "convert_keys", $identifier );
			// Data::setKeyValue( $data[$paramkey], $identifier );
		}
		// echo "<script> console.log(JSON.stringify(".json_encode($data).")+1) </script>";

		if( isset( $data[$paramkey] ) && !isset( $data[$datakey] ) ) {
			if( isset( $dataparams ) ) {
				if( !is_int( array_search($paramkey, $dataparams) ) && is_int( array_search($datakey, $dataparams) ) ) {
					// suggest convert keys [imagepath=>featured_imagepath]
					// exit( json_encode( $options ) );
					Data::addOption( [$paramkey=>$datakey], "convert_keys", $identifier );
				}
			}
		}else if( !isset( $data[$paramkey] ) && isset( $data[$datakey] ) ) {
			if( isset( $dataparams ) ) {
				if( is_int( array_search($paramkey, $dataparams) ) && !is_int( array_search($datakey, $dataparams) ) ) {
					// suggest convert keys [featured_imagepath=>imagepath]
					Data::addOption( [$datakey=>$paramkey], "convert_keys", $identifier );
				}
			}
		}else if( isset( $data[0][$paramkey] ) && !isset( $data[0][$datakey] ) ) {
			if( isset( $dataparams[0] ) ) {
				if( is_array($dataparams[0]) ) {
					if( !is_int( array_search($paramkey, $dataparams[0]) ) && is_int( array_search($datakey, $dataparams[0]) ) ) {
						// suggest convert keys [imagepath=>featured_imagepath]
						// exit( json_encode( $identifier ) );
						Data::addOption( [$paramkey=>$datakey], "convert_keys", $identifier );
					}
				}
			}
		}else if( !isset( $data[0][$paramkey] ) && isset( $data[0][$datakey] ) ) {
			if( isset( $dataparams[0] ) ) {
				if( is_array($dataparams[0]) ) {
					if( is_int( array_search($paramkey, $dataparams[0]) ) && !is_int( array_search($datakey, $dataparams[0]) ) ) {
						// suggest convert keys [featured_imagepath=>imagepath]
						Data::addOption( [$datakey=>$paramkey], "convert_keys", $identifier );
					}
				}
			}
		}


		// if( isset( $data[$paramkey] ) && !isset( $data[$datakey] ) ) {
		// 	if( !is_int( array_search($paramkey, $dataparams) ) && is_int( array_search($datakey, $dataparams) ) ) {
		// 		// suggest convert keys [imagepath=>featured_imagepath]
		// 		// exit("1");
		// 		Data::addOption( [$datakey=>$paramkey], "convert_keys", $identifier );
		// 	}
		// }else if( !isset( $data[$paramkey] ) && isset( $data[$datakey] ) ) {
		// 	if( is_int( array_search($paramkey, $dataparams) ) && !is_int( array_search($datakey, $dataparams) ) ) {
		// 		// suggest convert keys [featured_imagepath=>imagepath]
		// 		Data::addOption( [$datakey=>$paramkey], "convert_keys", $identifier );
		// 		// exit("2");
		// 	}
		// }else if( isset( $data[0][$paramkey] ) && !isset( $data[0][$datakey] ) ) {
		// 	if( !is_int( array_search($paramkey, $dataparams[0]) ) && is_int( array_search($datakey, $dataparams[0]) ) ) {
		// 		// suggest convert keys [imagepath=>featured_imagepath]
		// 		Data::addOption( [$datakey=>$paramkey], "convert_keys", $identifier );
		// 		// exit("3");
		// 	}
		// }else if( !isset( $data[0][$paramkey] ) && isset( $data[0][$datakey] ) ) {
		// 	if( is_int( array_search($paramkey, $dataparams[0]) ) && !is_int( array_search($datakey, $dataparams[0]) ) ) {
		// 		// suggest convert keys [featured_imagepath=>imagepath]
		// 		// exit("4");
		// 	}
		// }
	}

	public static function addToQueue( $viewtype, $file, $identifier, $data=[] )
	{


		Data::addInfo( $viewtype, 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		// if( $viewtype == "Section" && ($file == "smartform_inmodal" || $file == "smartform") ) {
		// 	array_push(
		// 		self::$formqueue,
		// 		[
		// 			"viewtype" => $viewtype,
		// 			"file" => $file,
		// 			"identifier" => $identifier,
		// 			"data"=>$data
		// 		]
		// 	);
		// } else {
		// exit( json_encode( [$viewtype, $file, $identifier] ) );
			array_push(
				self::$queue,
				[
					"viewtype" => $viewtype,
					"file" => $file,
					"identifier" => $identifier,
					"data"=>$data
				]
			);
		// }

	}

	public static function setViews()
	{

		ob_start();

		foreach (self::$queue as $v) {

			if( $v["viewtype"] == "CustomCode" ) {
				array_push( self::$bufferedviews, $v );
			} else if( $v["viewtype"] == "Structure" ) {
				call_user_func_array( "Reusables\\".$v['viewtype'] . "::set" , [ $v['file'], $v['data'], $v['identifier'] ] );
			} else {
				$viewtype = $v['viewtype'];
				$lowercased_viewtype = strtolower( $viewtype );
				if( substr($lowercased_viewtype, 0, strlen("custom")) === "custom" ) {
					$arr = explode("/", $viewtype);
					$viewtype = $arr[1];
					// exit( json_encode( $v['file'] ) );
					call_user_func_array( "Reusables\\".$viewtype . "::cset" , [ $v['file'], $v['identifier'] ] );
				} else {
					call_user_func_array( "Reusables\\".$v['viewtype'] . "::set" , [ $v['file'], $v['identifier'] ] );
				}
			}
		}


		Views::makeViews();

		// if( sizeof(self::$bufferedforms) == 0 ) {
			// if( $endbody ){
				echo "</body>";
			// }
		// }
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public static function setForms()
	{
		ob_start();

		foreach (self::$formqueue as $v) {
			if( $v["viewtype"] == "CustomCode" ) {
				array_push( self::$bufferedviews, $v );
			} else if( $v["viewtype"] == "Structure" ) {
				call_user_func_array( "Reusables\\".$v['viewtype'] . "::set" , [ $v['file'], $v['data'], $v['identifier'] ] );
			} else {
				call_user_func_array( "Reusables\\".$v['viewtype'] . "::set" , [ $v['file'], $v['identifier'] ] );
			}
		}
		Views::makeForms();

		echo "</body>";

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	// public static function setAndMakeViews()
	// {
	// 	foreach (self::$queue as $v) {
	// 		if( $v["viewtype"] == "CustomCode" ) {
	// 			array_push( self::$bufferedviews, $v );
	// 		} else if( $v["viewtype"] == "Structure" ) {
	// 			call_user_func_array( "Reusables\\".$v['viewtype'] . "::set" , [ $v['file'], $v['data'], $v['identifier'] ] );
	// 		} else {
	// 			call_user_func_array( "Reusables\\".$v['viewtype'] . "::set" , [ $v['file'], $v['identifier'] ] );
	// 		}
	// 	}
	// }

	public static function addCustomCodeToQueue( $code )
	{
		array_push(
			self::$queue,
			[
				"viewtype" => "CustomCode",
				"code" => $code
			]
		);
	}

	public static function convertOptionKeys( $options_formatted )
	{
		if( isset( $options_formatted['value'] ) ) {
			$options_formatted = $options_formatted['value'];
		} else {
			$options_formatted = [];
		}
		$options = [];
		foreach ($options_formatted as $option) {
			$key = Data::getValue( $option, 'option_key' );
			$value = Data::getValue( $option, 'title' );
			$identifier = Data::getValue( $option, 'identifier' );
			$dict = [
				"key" => $key,
				"value" => $value,
				"identifier" => $identifier
			];
			array_push($options, $dict);
		}
		return $options;
	}

	public static function getViewInputs( $viewtype, $filename )
	{

		$path = BASE_DIR . '/vendor/miltonian/reusables/views/' . $viewtype . '/' . $filename . '.php';
		$searchthis = 'Data::getValue';

		$matches = array();

		$handle = @fopen($path, "r");
		if ($handle)
		{
		    while (!feof($handle))
		    {
		        $buffer = fgets($handle);
		        if(strpos($buffer, $searchthis) !== FALSE)
		            $matches[] = $buffer;
		    }
		    fclose($handle);
		}

		$input_keys = [];

		foreach ($matches as $str) {
			$fullstring = $str;
			$fullstring = str_replace(" ", '', $fullstring);
			$fullstring = str_replace(',$table_identifier', '', $fullstring);
			$idk = explode('?>', $fullstring);
			$arr = [];
			foreach ($idk as $fullstring) {
				// $fullstring = Views::get_string_between($idkstr, 'Data::getValue($viewdict,', ')');
				// exit( json_encode( ($arr ) ) );
				$parsed = Views::get_string_between($fullstring, 'Data::getValue($viewdict,', ')');
				if( !$parsed ){ $parsed = Views::get_string_between($fullstring, ',', ')'); }
				if( !$parsed ){ $parsed = Views::get_string_between($fullstring, 'Data::getValue(', ')'); }
				$parsed = str_replace('$', '', $parsed);

				if( $parsed ) {
					$parsed = str_replace("'", '', $parsed);
					$parsed = str_replace('"', '', $parsed);
					$parsed = str_replace(" ", '', $parsed);
					$add=true;
					foreach ($input_keys as $added_string) {
						if( $parsed == $added_string || $parsed == "value" || $parsed == "" ) {
							$add = false;
							break;
						}
					}
					if( $add ) {
						array_push($input_keys, $parsed);
					}
				}
			}

		}


		return $input_keys;

	}

	public static function get_string_between($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}

	public static function setUp( $identifier ) {

		$viewdict = Data::retrieveDataWithID( $identifier );
		$viewoptions = Data::retrieveOptionsWithID( $identifier );

		if( isset( $viewdict['value'] ) ) {

			unset($viewdict['value']['data_id']);
			if( Data::isAssoc( $viewdict['value'] ) ) {

				$viewdict['value'] = [$viewdict['value']];
			}
			$original_arr = $viewdict['value'];
		} else {
			unset($viewdict['data_id']);
			if( Data::isAssoc( $viewdict ) ) {

				$viewdict = [$viewdict];
			}
			$original_arr = $viewdict;
		}

		$viewvalues = [];
		foreach ($original_arr as $key => $value) {

			$dict = Data::convertKeysInTable( $identifier, $value );
			if( isset($dict['editing']) ){ $isediting=1; }else{ $isediting=0; }


			$linkpath = Data::getValue( $viewoptions, 'pre_slug' ) . Data::getValue( $dict, 'slug' );
			if( $linkpath == "" ) {
				$linkpath = "#";
			}
			$dict['linkpath'] = $linkpath;
			$optiontype = Data::getValue( $viewoptions, 'type' );
			$fullarray = Data::getFullArray( $dict );

			if( isset( $dict[$identifier]['value'] ) ) {
				$fullviewdict = Data::getFullArray( $dict )[$identifier]['value'];
			}else{
				$fullviewdict = $dict;
			}

			array_push( $viewvalues, $dict );
		}
		if( !isset( $linkpath ) ) {
			$linkpath = "#";
		}

		$text_color = Data::getValue( $viewoptions, "text_color" );
		$background_color = Data::getValue( $viewoptions, "background_color" );

		return ["viewvalues" => $viewvalues, "linkpath"=>$linkpath, "data_id"=>$identifier, "text_color"=>$text_color, "background_color"=>$background_color];
	}

	public static function setContainerClass($file, $identifier)
	{
		echo " " . $identifier;
		echo " main";
		echo " " . basename($file, ".php");
		echo " viewtype_" . ReusableClasses::parentDir($file);
		echo " ";

	}

	public static function defaultStyling($file, $identifier, $viewvalues)
	{
		$viewdict = Data::retrieveDataWithID( $identifier );
		$viewoptions = Data::retrieveOptionsWithID( $identifier );
		$text_color = Data::getValue( $viewoptions, "text_color" );
		$background_color = Data::getValue( $viewoptions, "background_color" );
		$image_size = Data::getValue( $viewoptions, "image_size" );
		if( $image_size == "" ) {
			$image_size = "cover";
		}
		$height = Data::getValue( $viewoptions, "height" );

echo " <style> ";
	echo " ." . $identifier . ".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .".basename($file, ".php").".inner { display: inline-block; position: relative; margin: 0; padding: 0; float: left; background-size: ".$image_size."; background-repeat: no-repeat; background-position: center; width: ". ((1.0/sizeof($viewvalues)) * 100) . "%; ";
		if( $height != "" ) {
			echo "height: ".$height.";";
		}

		echo " } ";
		echo " ." . $identifier . ".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .".basename($file, ".php").".image { display: inline-block; position: relative; margin: 0; padding: 0; float: left; background-size: ".$image_size."; background-repeat: no-repeat; background-position: center; } ";

		if( Data::getValue( $viewoptions, "dark") == "true" || Data::getValue( $viewoptions, "dark") == true ) {
			$text_color = "#fff"; $background_color = "#333";
		}
		if( $text_color != "" ) {
			echo " .".$identifier.".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .".basename($file, ".php").".title { color: ".$text_color." ; } ";
			echo " .".$identifier.".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .".basename($file, ".php").".subtitle { color: ".$text_color." ; } ";
			echo " .".$identifier.".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .description { color: ".$text_color."; } ";
		} else {
			echo " .".$identifier.".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .".basename($file, ".php").".title { color: #333 ; } ";
			echo " .".$identifier.".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .".basename($file, ".php").".subtitle { color: #333 ; } ";
			echo " .".$identifier.".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." .description { color: #333; } ";
		}
		if( $background_color != "" ) {
			echo " .".$identifier.".viewtype_".ReusableClasses::parentDir($file).".".basename($file, ".php")." { background-color: ".$background_color."; } ";
		}
		echo " </style> ";
	}

}
