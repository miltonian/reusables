<?php 

namespace Reusables;

class CustomCode {

	public static $viewsSet = [];
	public static $optionsSet = [];
	public static $dataSet = [];
	public static $startSet = [];

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
		CustomCode::checkForViews($output);
		

		// $dict = [ "viewtype" => "CustomCode", "code" => $output ];
		// CustomCode::place( $output );

		// {{ identifier: [view: custom/section/filename, data: [blah], options: [blah] ]; }}
	}

	public static function checkForViews( $output )
	{
		// preg_match("/\\{\\{\s(.*)\\}\\}/", $output, $foundreusables);
		preg_match('/\\{\\{(.*)\\}\\}/sU', $output, $foundreusables);
		if( isset($foundreusables) && $foundreusables && !empty($foundreusables) ) {	
			// $foundreusables = str_replace("\n", "", $foundreusables[0]);
			$foundreusables = $foundreusables[0];
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
			// exit( json_encode( ($foundreusables[5]) ) );
			CustomCode::replaceViews( $output, $foundreusables );
		} else {
			CustomCode::place( $output );
		}
	}

	public static function replaceViews( $output, $matches )
	{

		if( isset($matches) && $matches && !empty($matches) ) {
			foreach ($matches as $index => $matchdict) {
				$str = str_replace("{{", "", $matches[$index]);
				$str = str_replace("}}", "", $str);
				$str = str_replace("\n", "", $str);
				$str = str_replace("\t", "", $str);
				$str = $str;

				if( is_string($matches[$index]) && $matches[$index] != null ) {
					// exit( json_encode( $str ) );
					$check_arr = explode(".", $str);
					if( sizeof($check_arr) == 2 ) {
						if( strtolower($check_arr[0]) == "form" ) {
							// echo "<form>";
						}
					}
					$new_output = CustomCode::convertToView($output, $matches, $str, $index);
					if( $new_output != null ) {
						$output = $new_output;
					}
					// CustomCode::checkForViews( $output );
					// return;
					// continue;
				}

			}
			if( $output ) {
				CustomCode::checkForViews( $output );
			}
			// return;
			
		}
	}

	public static function str_replace_first($from, $to, $content)
	{
	    $from = '/'.preg_quote($from, '/').'/';

	    return preg_replace($from, $to, $content, 1);
	}

	public static function convertToView( $output, $matches, $str, $index )
	{
		$str_orig = $str;
		// $str = str_replace(" ", "", $str);
		$checkingforblankstring = str_replace("}}", "", $matches[$index]);
		$checkingforblankstring = str_replace("\n", "", $checkingforblankstring);
		$checkingforblankstring = str_replace("\t", "", $checkingforblankstring);
		$checkingforblankstring = str_replace(" ", "", $checkingforblankstring);
		if( $checkingforblankstring == "" ) {
			// $output = str_replace($matches[$index], "", $output );
			$output = CustomCode::str_replace_first($matches[$index], "", $output );
			return $output;
		}

		$id_arr = explode("(", $str);
		$str_arr = $id_arr;
		$identifier_arr = $str_arr[0];
		$identifier_arr = explode(".", $identifier_arr);
		$identifier = $identifier_arr[0];
		$identifier = str_replace(" ", "", $identifier);
		$isoptions = false;
		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "options" ) {
				$isoptions=true;
			}
		}
		$isdata = false;
		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "data" ) {
				$isdata=true;
			}
		}
		$is_start = false;
		$is_end = false;
		if( sizeof($identifier_arr) == 2 ) {
			$data_type = str_replace(" ", "", $identifier_arr[1]);
			if( $data_type == "start" ) {
				$is_start=true;
			} else if( $data_type == "end" ) {
				$is_end=true;
			}
		}

		if( !isset($id_arr[1]) ) {
			return;
		}
		$other = $id_arr[1];
		if( !$isdata && !$isoptions ) {
			$other = str_replace(" ", "", $other);
		}
		$other = str_replace(");", "", $other);
		$values = explode(",", $other);
		$view_inputs = [];
		$i=0;
		foreach ($values as $v) {

			$v = explode(":", $v, 2);
			if( isset($v[1]) ) {
				$view_inputs[$v[0]] = $v[1];
			} else {
				// $view_inputs[$v[0]] = "";
				$view_inputs[$i] = $v[0];
			}
			$i++;
		}

		if( isset( self::$viewsSet[$identifier] ) && !$isoptions && !$isdata && !$is_start && !$is_end ) {
			$output = str_replace( $matches[$index], "", $output );
			return;
		} else if( !$isoptions && !$isdata && !$is_start && !$is_end ) {
			self::$viewsSet[$identifier] = true;
		} else if( $isoptions ) {
			if( !isset( self::$optionsSet[$identifier] ) ) {
				self::$optionsSet[$identifier] = [];
			}
			if( isset(self::$optionsSet[$identifier][array_keys($view_inputs)[0]] ) ) {
				$output = str_replace($matches[$index], "", $output );
				return;
			} else {
				self::$optionsSet[$identifier][array_keys($view_inputs)[0]] = true;
			}
		} else if( $isdata ) {
			if( !isset( self::$dataSet[$identifier] ) ) {
				self::$dataSet[$identifier] = [];
			}

			if( isset(self::$dataSet[$identifier][array_keys($view_inputs)[0]] ) ) {
				$output = str_replace($matches[$index], "", $output );
				return;
			} else {
				self::$dataSet[$identifier][array_keys($view_inputs)[0]] = true;
			}
		} else if( $is_start ) {
			// if( !isset( self::$startSet[$identifier] ) ) {
			// 	self::$startSet[$identifier] = [];
			// }

			if( isset(self::$startSet[$identifier] ) ) {
				$output = str_replace($matches[$index], "", $output );
				return;
			} else {
				self::$startSet[$identifier] = $view_inputs[0];
			}
		}
		
		$after_string = $output;
		if( isset($view_inputs['view']) ) {
			$after_string = CustomCode::placeView( $output, $matches, $str, $index, $view_inputs, $identifier);
		}
		if( $isoptions ) {
			$after_string = CustomCode::addOptions( $output, $matches, $str, $index, $view_inputs, $identifier);
		}
		if( $isdata ) {
			$after_string = CustomCode::addData( $output, $matches, $str, $index, $view_inputs, $identifier);
		}
		if( $is_start ) {
			$after_string = CustomCode::addStart( $output, $matches, $str, $index, $view_inputs, $identifier);
		}
		if( $is_end ) {
			$after_string = CustomCode::addEnd( $output, $matches, $str, $index, $view_inputs, $identifier);
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
		// exit( json_encode( $view_inputs ) );
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
	        if( $key == "text_color" ) {
// exit(json_encode( $value ) );
	        }
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
			}
		}
		$output = str_replace($matches[$index], "", $output );

		return $output;
	}

	public static function addEnd( $output, $matches, $str, $index, $view_inputs, $identifier) 
	{
		if( strtolower(self::$startSet[$identifier]) == "modal" ) {
			// Modal::end($identifier);
			$beforeafter_string = explode($matches[$index], $output);
			$before_string = $beforeafter_string[0];
			$after_string = $beforeafter_string[1];
			$before_string = str_replace( $matches[$index], "", $before_string );
			$after_string = str_replace( $matches[$index], "", $after_string );
			CustomCode::place( $before_string );
			call_user_func_array("\\Reusables\\Modal::end", [$identifier] );
			return $after_string;
		}
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


