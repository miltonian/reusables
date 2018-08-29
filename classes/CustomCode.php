<?php

namespace Reusables;

class CustomCode {

	public static $viewsSet = [];
	public static $optionsSet = [];
	public static $dataSet = [];
	public static $startSet = [];
	public static $fontSet = [];
	public static $linksSet = [];

	public static function place( $code )
	{
		Views::addCustomCodeToQueue( $code );
	}

	public static function start()
	{
		ob_start('Reusables\Page::reusables');
	}

	public static function end()
	{
		$output = ob_get_contents();
		ob_end_clean();

		// preg_match_all("/\\{\\{\s(.*)\\}\\}/", $output, $matches);
		// preg_match("/\\{\\{\s(.*)\\}\\}/", $output, $matches);
		// CustomCode::checkForViews($output);
		$checkForViews_result = CustomCode::checkForViews( $output );
		// exit(json_encode($checkForViews_result['found_reusables']));

		CustomCode::replaceAllViews($checkForViews_result["output"], $checkForViews_result['found_reusables']);


		// $dict = [ "viewtype" => "CustomCode", "code" => $output ];
		// CustomCode::place( $output );

		// {{ identifier: [view: custom/section/filename, data: [blah], options: [blah] ]; }}
	}

	public static function checkForViews( $output )
	{
		// preg_match("/\\{\\{\s(.*)\\}\\}/", $output, $foundreusables);
		// preg_match('/\\{\\{(.*)\\}\\}/sU', $output, $foundreusables);
		preg_match_all('/\\{\\{(.*)\\}\\}/sU', $output, $foundreusables_arr);
		$foundreusables_arr = $foundreusables_arr[0];

		$foundreusables_return = [];
		foreach ($foundreusables_arr as $foundreusables) {
			if( isset($foundreusables) && $foundreusables && !empty($foundreusables) ) {
				// $foundreusables = str_replace("\n", "", $foundreusables[0]);


				// $foundreusables = $foundreusables[0];
				$arr = explode(");", $foundreusables);
				$new_arr = [];
				foreach ($arr as $key => $value) {
					// $value = str_replace("{{", "", $value);
					// $value = str_replace("}}", "", $value);
					if( $key < sizeof($arr)-1 ) {
						$value = "" . $value . ");";
					}
					array_push($new_arr, $value);
				}
				$foundreusables = $new_arr;
				array_push($foundreusables_return, $foundreusables);
				// CustomCode::replaceViews( $output, $foundreusables );
			} else {
				// CustomCode::place( $output );
			}

	}
	return [
		"output"=>$output,
		"found_reusables"=>$foundreusables_return
	];
}

	public static function checkForViewSetData( $output )
	{

		preg_match('/ViewData\\:\\:set(.*)\\);/sU', $output, $viewSetData);
		if( isset($viewSetData) && $viewSetData && !empty($viewSetData) ) {

			$viewSetData = $viewSetData[0];
			$arr = explode(");", $viewSetData);
			$new_arr = [];
			foreach ($arr as $key => $value) {

				if( $key < sizeof($arr)-1 ) {
					$value = "" . $value . ");";
				}
				if($value != ""){
					array_push($new_arr, $value);
				}
			}
			$viewSetData = $new_arr;

		}

		return [
			"output"=>$output,
			"view_set_data"=>$viewSetData
		];
	}

	public static function replaceViews( $output, $matches )
	{

		if( !isset($matches) || !$matches || empty($matches) ) {
			CustomCode::place( $output );
			return;
		}

		if( isset($matches) && $matches && !empty($matches) ) {
			foreach ($matches as $index => $matchdict) {
				$str = str_replace("{{", "", $matches[$index]);
				$str = str_replace("}}", "", $str);
				$str = str_replace("\n", "", $str);
				$str = str_replace("\t", "", $str);
				$str = $str;

				if( is_string($matches[$index]) && $matches[$index] != null ) {

					$new_output = CustomCode::convertToView($output, $matches, $str, $index);
					if( $new_output != null ) {
						$output = $new_output;
					}

				}

			}
			if( $output ) {
				// $checkForViews_result = CustomCode::checkForViews( $output );
				// CustomCode::replaceViews($checkForViews_result["output"], $checkForViews_result["found_reusables"]);
			}

		}
		return $output;
	}

	public static function replaceAllViews($output, $reusable_views)
	{

		foreach ($reusable_views as $reusable_view) {

			$checkForViews_result = CustomCode::checkForViews( $output );
			$output = CustomCode::replaceViews($checkForViews_result["output"], $reusable_view);
		}
	}

	public static function replaceViewOption( $output, $matches, $identifier, $option_name, $option_value, $recursive_output=null )
	{

		if( $recursive_output == null ) {
			$recursive_output = $output;
		} else {
			$matches = CustomCode::checkForViews( $recursive_output )['found_reusables'];
		}
		$found=false;
		if( isset($matches) && $matches && !empty($matches) ) {

			foreach ($matches as $index => $matchdict) {
				$str = str_replace("{{", "", $matches[$index]);
				$str = str_replace("}}", "", $str);
				$str = str_replace("\n", "", $str);
				$str = str_replace("\t", "", $str);
				$str = $str;

				if( is_string($str) && $str != null ) {

					$attribute_identifier = CustomCode::getIdentifierFromShortHand($str);

					$attribute = CustomCode::detectShortHandAttribute($str);
					// if( $attribute_identifier == $identifier && $attribute == "options" ) {
					if($attribute_identifier != $identifier || $attribute != "options") {
						$recursive_output = str_replace($matches[$index], "", $recursive_output );
						// if( $index > 0 && $attribute_identifier != "navbar" && $str != "" && $attribute != "data" ) {
						//
						// 	exit(json_encode([$identifier, $attribute_identifier, $attribute]));
						// }
					} else if( $attribute_identifier == $identifier && $attribute == "options" ) {

						$found = true;
						$matching_options = explode(".options(", $matches[$index])[1];
						$matching_options = str_replace(");", "", $matching_options);
						$matching_options = explode(",", $matching_options);

						$found_specific = false;
						foreach ($matching_options as $this_option) {
							$this_option_arr = explode(":", $this_option);
							$this_option_arr_key = $this_option_arr[0];
							$this_option_arr_key = str_replace(" ", "", $this_option_arr_key);
							if($this_option_arr_key == $option_name){
								$found_specific=true;
								$updated_option = str_replace($this_option, " ".$option_name . ": " . $option_value, $matches[$index]);
								$output = str_replace($matches[$index], $updated_option, $output);
							}
						}
						if( !$found_specific ) {
							$updated_option = str_replace(");", ", ".$option_name . ": " . $option_value . ");", $matches[$index]);
							$output = str_replace($matches[$index], $updated_option, $output);
						}
						break;
					}

					// }
					// $new_output = CustomCode::convertToView($output, $matches, $str, $index);
					// if( $new_output != null ) {
					// 	$output = $new_output;
					// }

				}

			}

			return $output;
			// if( $found ) {
			//
			// 	return $output;
			// } else {
			// 	if ( !isset($matches) || !$matches || empty($matches) ) {
			// 		exit(json_encode($recursive_output));
			// 	} else {
			// 		CustomCode::replaceViewOption( $output, $matches, $identifier, $option_name, $option_value, $recursive_output );
			// 	}
			// }

		}
	}

	public static function replaceAllViewOptions( $output, $identifier, $options_to_update )
	{
		foreach ($options_to_update as $key => $value) {

		  $checkForViews_result = CustomCode::checkForViews( $output );
			$found_reusables = $checkForViews_result['found_reusables'];
			foreach ($found_reusables as $found_reusable) {
				$new_output = CustomCode::replaceViewOption( $output, $found_reusable, $identifier, $key, $value );
			  if( $new_output != null && $new_output != "" ) {

			    $output = $new_output;
			  }
			}
		}

		return $output;


		foreach ($reusable_views as $reusable_view) {

			$checkForViews_result = CustomCode::checkForViews( $output );
			$output = CustomCode::replaceViewOption( $output, $matches, $identifier, $option_name, $option_value, $recursive_output );
		}
	}

	public static function replaceViewSetData( $output, $matches, $identifier, $viewsetdata_name, $viewsetdata_value, $recursive_output=null )
	{

		if( $recursive_output == null ) {
			$recursive_output = $output;
		} else {
			$matches = CustomCode::checkForViewSetData( $recursive_output )['view_set_data'];
		}
		$found=false;

		if( isset($matches) && $matches && !empty($matches) ) {

			foreach ($matches as $index => $matchdict) {
				$str = str_replace("ViewData::set(", "", $matches[$index]);
				$str = str_replace(");", "", $str);
				$str = str_replace("\n", "", $str);
				$str = str_replace("\t", "", $str);
				$str = $str;

				if( is_string($matches[$index]) && $matches[$index] != null ) {
					//asdfasdf
					$viewset_identifier = CustomCode::getIdentifierFromViewSetData($str);

					if($viewset_identifier != $identifier) {

						$recursive_output = str_replace($matches[$index], "", $recursive_output );
					} else if( $viewsetdata_name == "number_of_columns" || $viewsetdata_name == "data_type" ) {

						$found = true;
						$str_arr = explode(",", $str);

						if( $viewsetdata_name == "number_of_columns" ) {
							$str_arr[2] = $viewsetdata_value;
						} else if( $viewsetdata_name == "data_type" ) {
							$str_arr[3] = json_encode($viewsetdata_value);
						}
						$str = implode(",", $str_arr);
						$str = rtrim($str, ", ");
						$str = rtrim($str, ",");


						$output = str_replace($matches[$index], "ViewData::set(" . $str . ");", $output);

						break;
					}

				}

			}

			if( $found ) {
				return $output;
			} else {
				if ( !isset($matches) || !$matches || empty($matches) ) {
					exit(json_encode($recursive_output));
				} else {
					CustomCode::replaceViewSetData( $output, $matches, $identifier, $viewsetdata_name, $viewsetdata_value, $recursive_output );
				}
			}

		}

	}

	public static function str_replace_first($from, $to, $content)
	{
	    $from = '/'.preg_quote($from, '/').'/';

	    return preg_replace($from, $to, $content, 1);
	}

	public static function checkForBlankView($matches, $index)
	{
		$checkingforblankstring = str_replace("}}", "", $matches[$index]);
		$checkingforblankstring = str_replace("\n", "", $checkingforblankstring);
		$checkingforblankstring = str_replace("\t", "", $checkingforblankstring);
		$checkingforblankstring = str_replace(" ", "", $checkingforblankstring);
		if( $checkingforblankstring == "" ) {
			return true;
		}
	}

	public static function getIdentifierFromShortHand($str)
	{
		$id_arr = explode("(", $str);
		$str_arr = $id_arr;
		$identifier_arr = $str_arr[0];
		$identifier_arr = explode(".", $identifier_arr);
		$identifier = $identifier_arr[0];
		$identifier = str_replace(" ", "", $identifier);
		return $identifier;
	}

	public static function detectShortHandAttribute( $str )
	{
		$str = str_replace("{{", "", $str);
		$str = str_replace("}}", "", $str);
		$str = str_replace("\n", "", $str);
		$str = str_replace("\t", "", $str);
		$str = $str;

		$id_arr = explode("(", $str);
		$str_arr = $id_arr;
		$identifier_arr = $str_arr[0];
		$identifier_arr = explode(".", $identifier_arr);

		$attribute = "";
		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "options" ) {
				$attribute = "options";
			}
		}

		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "data" ) {
				$attribute = "data";
			}
		}

		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "view" ) {
				$attribute = "view";
			}
		}


		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "start" ) {
				$attribute = "start";
			} else if( $data_type == "end" ) {
				$attribute = "end";
			}
		}

		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "font" ) {
				$attribute = "font";
			}
		}

		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "links" ) {
				$attribute = "links";
			}
		}

		return $attribute;
	}

	public static function getIdentifierFromViewSetData($str)
	{
		$str_arr = explode(",", $str);
		$identifier = $str_arr[0];
		$identifier = str_replace("\"", "", $identifier);
		$identifier = str_replace(" ", "", $identifier);

		return $identifier;
	}

	public static function convertToView( $output, $matches, $str, $index )
	{

		$str_orig = $str;

		if( CustomCode::checkForBlankView( $matches, $index ) ) {
			$output = CustomCode::str_replace_first($matches[$index], "", $output );
			return $output;
		}

		$identifier = CustomCode::getIdentifierFromShortHand($str);

		$id_arr = explode("(", $str);
		$str_arr = $id_arr;
		$identifier_arr = $str_arr[0];
		$identifier_arr = explode(".", $identifier_arr);

		$attribute = CustomCode::detectShortHandAttribute( $str );

		if( $attribute == "" ) {
			return;
		}

		$other = $id_arr[1];
		if( $attribute != "data" && $attribute != "options" && $attribute != "links" ) {
			$other = str_replace(" ", "", $other);
		}
		$other = str_replace(");", "", $other);
		$values = explode(",", $other);

		$view_inputs = [];
		$i=0;
		foreach ($values as $v) {

			// $v = explode(":", $v, 2);
			$v = preg_split('/\:(?![^http]\/)/', $v);

			if( isset($v[1]) ) {

				$view_inputs[$v[0]] = $v[1];
			} else {

				$view_inputs[$i] = $v[0];
			}
			$i++;
		}

		if( isset( self::$viewsSet[$identifier] ) && $attribute != "options" && $attribute != "data" && $attribute != "start" && $attribute != "end" && $attribute != "links" ) {

			$output = str_replace( $matches[$index], "", $output );
			return;
		} else if( $attribute != "options" && $attribute != "data" && $attribute != "start" && $attribute != "end" && $attribute != "links" ) {

			self::$viewsSet[$identifier] = true;
		} else if( $attribute == "options" ) {

			if( !isset( self::$optionsSet[$identifier] ) ) {
				self::$optionsSet[$identifier] = [];
			}
			if( isset(self::$optionsSet[$identifier][array_keys($view_inputs)[0]] ) ) {

				$output = str_replace($matches[$index], "", $output );
				return;
			} else {

				self::$optionsSet[$identifier][array_keys($view_inputs)[0]] = true;
			}
		} else if( $attribute == "data" ) {

			if( !isset( self::$dataSet[$identifier] ) ) {

				self::$dataSet[$identifier] = [];
			}

				self::$dataSet[$identifier][array_keys($view_inputs)[0]] = true;
		} else if( $attribute == "start" ) {

			if( isset(self::$startSet[$identifier] ) ) {

				$output = str_replace($matches[$index], "", $output );
				return;
			} else {

				self::$startSet[$identifier] = $view_inputs[0];
			}
		} else if( $attribute == "font" ) {

			if( !isset( self::$fontSet[$identifier] ) ) {

				self::$fontSet[$identifier] = [];
			}

			self::$dataSet[$identifier][array_keys($view_inputs)[0]] = true;
		} else if( $attribute == "links" ) {

			if( isset(self::$linksSet[$identifier] ) ) {

				$output = str_replace($matches[$index], "", $output );
				return;
			} else {

				self::$linksSet[$identifier] = array_keys($view_inputs)[0];
			}
		}

		$after_string = $output;
		if( ( isset($view_inputs['view']) ) || $attribute == "view" ) {

			if( !isset($view_inputs['view']) ) {

				$new_viewinputs = [];
				$new_viewinputs['view'] = $view_inputs[0];
			} else {

				$new_viewinputs = $view_inputs;
			}
			$after_string = CustomCode::placeView( $output, $matches, $str, $index, $new_viewinputs, $identifier);
		}

		switch ($attribute) {
			case 'options':
				$after_string = CustomCode::addOptions( $output, $matches, $str, $index, $view_inputs, $identifier);
				break;
			case 'data':
				$after_string = CustomCode::addData( $output, $matches, $str, $index, $view_inputs, $identifier);
				break;
			case 'start':
				$after_string = CustomCode::addStart( $output, $matches, $str, $index, $view_inputs, $identifier);
				break;
			case 'end':
				$after_string = CustomCode::addEnd( $output, $matches, $str, $index, $view_inputs, $identifier);
				break;
			case 'font':
				$after_string = CustomCode::addFont( $output, $matches, $str, $index, $view_inputs, $identifier );
				break;
			case 'links':
				$after_string = CustomCode::addLinks( $output, $matches, $str, $index, $view_inputs, $identifier);
				break;

			default:

				break;
		}

		return $after_string;
	}

	public static function placeView( $output, $matches, $str, $index, $view_inputs, $identifier)
	{
		$view = $view_inputs['view'];
		$view = str_replace(" ", "", $view);

		$viewdict = Data::getValue( $view_inputs, 'data' );
		// $viewoptions = Data::getValue( $view_inputs, 'options' );
		$view_array = explode("/", $view);
		$beforeafter_string = explode($matches[$index], $output);
		$before_string = $beforeafter_string[0];
		$after_string = $beforeafter_string[1];
		$before_string = str_replace( $matches[$index], "", $before_string );
		$after_string = str_replace( $matches[$index], "", $after_string );
		CustomCode::place( $before_string );
		if( $view_array[0] == "custom" ) {
			call_user_func_array('\\Reusables\\'.ucfirst($view_array[1]) . "::cplace", [$view_array[2], $identifier] );
		} else {
			call_user_func_array('\\Reusables\\'.ucfirst($view_array[0]) . "::place", [$view_array[1], $identifier] );
			if( strtolower($view_array[0]) == "input" ){
				Data::addOption( "0", "is_smart", $identifier );
			}
		}

		return $after_string;
	}

	public static function addData( $output, $matches, $str, $index, $view_inputs, $identifier)
	{
		// $view_inputs = str_replace(", replace, subject)
		$thisdata = [];
		foreach ($view_inputs as $key => $value) {

			if( is_numeric($key) ) {

				$value = ltrim($value, ' ');
		        $value = rtrim($value, ' ');
		        $value = ltrim($value, '\"');
		        $value = rtrim($value, '\"');
		        array_push( $thisdata, $value );
			} else {

				$key = ltrim($key, ' ');
		        $key = rtrim($key, ' ');
		        $key = ltrim($key, '\"');
		        $key = rtrim($key, '\"');
				$key = trim($key, ' ');

		        $value = ltrim($value, ' ');
		        $value = rtrim($value, ' ');
		        $value = ltrim($value, '\"');
		        $value = rtrim($value, '\"');

		        $thisdata[$key] = $value;
			}
			// $key = str_replace("\"", "", $key);
			// array_push( $thisdata, $value );
		}
		// $view_inputs = json_decode($view_inputs, true);
		$current_data = Data::retrieveDataWithID($identifier);

		if( $current_data != null ) {
			$newdata = [];
			if( Data::isAssoc($current_data) ) {
				$current_data = [$current_data];
			}
			array_push($current_data, $thisdata);
			$thisdata = $current_data;
		}
		Data::addData( $thisdata, $identifier );
		$output = str_replace($matches[$index], "", $output );

		return $output;
	}

	public static function addOptions( $output, $matches, $str, $index, $view_inputs, $identifier)
	{

		foreach ($view_inputs as $key => $value) {
			$value = ltrim($value, ' ');
	        $value = rtrim($value, ' ');
	        $value = ltrim($value, '\"');
	        $value = rtrim($value, '\"');
	        $value = trim($value);
	        $key = trim($key);
			Data::addOption( $value, $key, $identifier );
		}
		$output = str_replace($matches[$index], "", $output );

		return $output;
	}

	public static function addStart( $output, $matches, $str, $index, $view_inputs, $identifier)
	{
		foreach ($view_inputs as $key => $value) {
			$value = ltrim($value, ' ');
	        $value = rtrim($value, ' ');
	        $value = ltrim($value, '\"');
	        $value = rtrim($value, '\"');
			if( strtolower($value) == "modal" ) {
				// Modal::start($identifier);
				$beforeafter_string = explode($matches[$index], $output);
				$before_string = $beforeafter_string[0];
				$after_string = $beforeafter_string[1];
				$before_string = str_replace( $matches[$index], "", $before_string );
				$after_string = str_replace( $matches[$index], "", $after_string );
				CustomCode::place( $before_string );
				call_user_func_array("\\Reusables\\Modal::start", [$identifier] );
				return $after_string;
			} else if( strtolower($value) == "structure" ) {
				// Modal::start($identifier);
				$beforeafter_string = explode($matches[$index], $output);
				$before_string = $beforeafter_string[0];
				$after_string = $beforeafter_string[1];
				$before_string = str_replace( $matches[$index], "", $before_string );
				$after_string = str_replace( $matches[$index], "", $after_string );
				CustomCode::place( $before_string );
				call_user_func_array("\\Reusables\\Structure::start", [$identifier, "default"] );
				return $after_string;
			}
		}
		$output = str_replace($matches[$index], "", $output );

		return $output;
	}

	public static function addEnd( $output, $matches, $str, $index, $view_inputs, $identifier)
	{
		$type = strtolower(self::$startSet[$identifier]);
		$type = str_replace("\"", "", $type);
		if( $type == "modal" ) {
			// Modal::end($identifier);
			$beforeafter_string = explode($matches[$index], $output);
			$before_string = $beforeafter_string[0];
			$after_string = $beforeafter_string[1];
			$before_string = str_replace( $matches[$index], "", $before_string );
			$after_string = str_replace( $matches[$index], "", $after_string );
			CustomCode::place( $before_string );
			call_user_func_array("\\Reusables\\Modal::end", [$identifier] );
			return $after_string;
		} else if( $type == "structure" ) {
			$beforeafter_string = explode($matches[$index], $output);
			$before_string = $beforeafter_string[0];
			$after_string = $beforeafter_string[1];
			$before_string = str_replace( $matches[$index], "", $before_string );
			$after_string = str_replace( $matches[$index], "", $after_string );
			CustomCode::place( $before_string );
			call_user_func_array("\\Reusables\\Structure::end", [$identifier, "default"] );
			return $after_string;
		}
		$output = str_replace($matches[$index], "", $output );

		return $output;
	}

	public static function addFont( $output, $matches, $str, $index, $view_inputs, $identifier )
	{
		$linkvalue = "";
		$fontfamily = "";
		$fonttype = "";
		$fontother = "";
		$familyi=100;

		$i=0;
		foreach ($view_inputs as $key => $value) {
			if( $key == "link" ) {
				$linkvalue = $value;
			} else if( $key == "font-family" ) {
				$fontfamily = $value;
				$familyi=$i;
			} else if( $i>$familyi ) {
				$fontfamily = $fontfamily . ", " . $value;
			} else {
				$fontother .= ", " . $value;
			}
			$i++;
		}
		$fontfamily = $fontfamily . $fontother;
		$fontfamily = str_replace(";", "", $fontfamily);
		echo "<link href=\"".$linkvalue."\" rel=\"stylesheet\">";
		$thisoutput = "<style>";
			if( $identifier == "all" ) {
				$thisoutput .= " body, h1, h2, h3, h4, h5, h6, p, label, button, input, div";
			}
			$thisoutput .= "{ ";
				$thisoutput .= " font-family: " . $fontfamily . ";";
			$thisoutput .= " } ";
		$thisoutput .= "</style>";
		echo $thisoutput;

		$output = str_replace($matches[$index], "", $output );

		return $output;
	}

	public static function addLinks( $output, $matches, $str, $index, $view_inputs, $identifier)
	{
		$links = [];
		foreach ($view_inputs as $key => $value) {
			$value = ltrim($value, ' ');
	        $value = rtrim($value, ' ');
	        $value = ltrim($value, '\"');
	        $value = rtrim($value, '\"');
					// exit(json_encode($key));
					$links[$key] = $value ;
		}

		Data::addOption($links, "links", $identifier);

		$output = str_replace($matches[$index], "", $output );

		return $output;
	}

	public static function get_string_between($string, $start, $end)
	{
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
}
