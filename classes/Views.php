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

		if( isset( $viewoptions["editable"] ) || isset( $viewoptions["insertonly"] ) || isset( $viewoptions["editable_dynamic"] ) || isset( $viewoptions["insertonly_dynamic"] ) ) {
			if( !isset($viewoptions["editable"] ) ) { $viewoptions["editable"] = false; }
			if( !isset($viewoptions["insertonly"] ) ) { $viewoptions["insertonly"] = false; }
			if( !isset($viewoptions["editable_dynamic"] ) ) { $viewoptions["editable_dynamic"] = false; }
			if( !isset($viewoptions["insertonly_dynamic"] ) ) { $viewoptions["insertonly_dynamic"] = false; }
			if( !isset($viewoptions["modal_table"] ) ) { $viewoptions["modal_table"] = false; }
			if( $viewoptions["editable"] == true || $viewoptions["insertonly"] == true || $viewoptions["editable_dynamic"] == true || $viewoptions["insertonly_dynamic"] == true ) {

				$viewdata = Data::retrieveDataWithID( $identifier );
				
				Data::addOption( "modal", "type", $identifier );
				Data::addOption( $identifier . "_form", "modal", $identifier );

				if( $viewoptions["insertonly"] == true ) {
					if( !isset( $viewoptions["tb"] ) ) {
						exit( "insertonly option needs a tablename option as well. the key to pass the tablename is 'tb'" );
					}
					$tablename = Data::getValue( $viewoptions, "tb" );
					Form::prepareInsertOnly( $tablename, $identifier . "_form" );
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
				}
				$formoptions = Data::retrieveOptionsWithID($identifier . "_form");
					$goto = Data::getValue( $formoptions, "goto" );
					// exit( json_encode( $goto ) );
					if( $goto == "" ) {
						Data::addOption( $_SERVER['REDIRECT_URL'], "goto", $identifier . "_form" );
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
		if( $viewtype == "wrapper" ) {

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
			$View->set( 'structuredict', $data );
			$View->set( 'identifier', $identifier );

			// echo $View->render();
		}else{
			// if( $identifier == "admin_insertview" ) {
			// 	exit( json_encode( $file ) );
			// }
			ReusableClasses::addfile( $viewtype, $file );
			$View = View::factory( 'reusables/views/' . $viewtype . '/' . $file );
			$data = Data::retrieveDataWithID( $identifier );
			$options = Data::retrieveOptionsWithID( $identifier );
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
		Views::analyzeView( $identifier );

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
				$dataparams = Views::getDataParams( $identifier );

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
				if( !is_int( array_search($paramkey, $dataparams[0]) ) && is_int( array_search($datakey, $dataparams[0]) ) ) {
					// suggest convert keys [imagepath=>featured_imagepath]
					// exit( json_encode( $identifier ) );
					Data::addOption( [$paramkey=>$datakey], "convert_keys", $identifier );
				}
			}
		}else if( !isset( $data[0][$paramkey] ) && isset( $data[0][$datakey] ) ) {
			if( isset( $dataparams[0] ) ) {
				if( is_int( array_search($paramkey, $dataparams[0]) ) && !is_int( array_search($datakey, $dataparams[0]) ) ) {
					// suggest convert keys [featured_imagepath=>imagepath]
					Data::addOption( [$datakey=>$paramkey], "convert_keys", $identifier );
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
				call_user_func_array( "Reusables\\".$v['viewtype'] . "::set" , [ $v['file'], $v['identifier'] ] );
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

}