<?php
namespace Reusables;
class CustomCode

	{
	public static $viewsSet = [];

	public static $optionsSet = [];

	public static $dataSet = [];

	public static function place($code)
	{
		Views::addCustomCodeToQueue($code);
	}

	public static function start()
	{
		ob_start('Reusables\Page::reusables');
	}

	public static function end()
		{
		$output = ob_get_contents();
		ob_end_clean();

		CustomCode::checkForViews($output);
	}

	public static function checkForViews($output)
	{
		preg_match("/\\{\\{\s(.*)\\}\\}/", $output, $foundreusables);
		if (isset($foundreusables) && $foundreusables && !empty($foundreusables))
		{
			CustomCode::replaceViews($output, $foundreusables);
		}
		else
		{
			CustomCode::place($output);
		}
	}

	public static function replaceViews($output, $matches)
		{
		if (isset($matches) && $matches && !empty($matches))
			{
			foreach($matches as $index => $matchdict)
				{
				$str = str_replace("{{", "", $matches[$index]);
				$str = str_replace("}}", "", $str);
				$str = $str;
				if (is_string($str) && $str)
				{ 
					$check_arr = explode(".", $str);					
					if( sizeof($check_arr) == 2 ) {						
					if( strtolower($check_arr[0]) == "form" ) {												
					}					
				}					
				$new_output = CustomCode::convertToView($output, $matches, $str, $index);

				CustomCode::checkForViews($new_output);
				return;
				}
			}
		}
	}

	public static function convertToView($output, $matches, $str, $index)
		{
		$str_orig = $str; 
		// $str = str_replace(" ", "", $str);		
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
		$other = $id_arr[1];		
		if( !$isdata ) {			
			$other = str_replace(" ", "", $other);		
		}		
		$other = str_replace(");", "", $other);		
		$values = explode(",", $other);		
		$view_inputs = [];		
		foreach ($values as $v) {
			$v = explode(":", $v);
			if (isset($v[1]))
			{
				$view_inputs[$v[0]] = $v[1];
			}
		  else
			{
				$view_inputs[$v[0]] = "";
			}
		}

		if (isset(self::$viewsSet[$identifier]) && !$isoptions && !$isdata) {
				$output = str_replace($matches[$index], "", $output);
				return;
			} else if (!$isoptions && !$isdata) {
			self::$viewsSet[$identifier] = true;
		} else if ($isoptions) {
			if (!isset(self::$optionsSet[$identifier])) {
				self::$optionsSet[$identifier] = [];
			}

			if (isset(self::$optionsSet[$identifier][array_keys($view_inputs) [0]])) {
				$output = str_replace($matches[$index], "", $output);
				return;
			} else {
				self::$optionsSet[$identifier][array_keys($view_inputs) [0]] = true;
			}
			} else if ($isdata) {
				if (!isset(self::$dataSet[$identifier])) {
					self::$dataSet[$identifier] = [];
				}

				if (isset(self::$dataSet[$identifier][array_keys($view_inputs) [0]])) {
					$output = str_replace($matches[$index], "", $output);
					return;
				} else {
					self::$dataSet[$identifier][array_keys($view_inputs) [0]] = true;
				}
			}

		$after_string = $output;
		if (isset($view_inputs['view'])) {
			$after_string = CustomCode::placeView($output, $matches, $str, $index, $view_inputs, $identifier);
		}

		if ($isoptions) {
			$after_string = CustomCode::addOptions($output, $matches, $str, $index, $view_inputs, $identifier);
		}

		if ($isdata) {
			$after_string = CustomCode::addData($output, $matches, $str, $index, $view_inputs, $identifier);
		}

		return $after_string;
	}

	public static function placeView($output, $matches, $str, $index, $view_inputs, $identifier)
		{
		$view = $view_inputs['view'];
		$view = str_replace(" ", "", $view);
		$viewdict = Data::getValue($view_inputs, 'data'); 	
		$view_array = explode("/", $view);		
		$beforeafter_string = explode($matches[$index], $output);		
		$before_string = $beforeafter_string[0];		
		$after_string = $beforeafter_string[1];		
		$before_string = str_replace( $matches[$index], "", $before_string );		
		$after_string = str_replace( $matches[$index], "", $after_string );		
		CustomCode::place( $before_string );		
		if( $view_array[0] == "custom" ) {			
			// exit( json_encode( $view_array[1] ));			
			call_user_func_array('\\Reusables\\'.ucfirst($view_array[1]) . "::cplace", [$view_array[2], $identifier] );
		} else {
			call_user_func_array('\\Reusables\\' . ucfirst($view_array[0]) . "::place", [$view_array[1], $identifier]);
		}

	return $after_string;
	}

	public static function addData($output, $matches, $str, $index, $view_inputs, $identifier)
	{ 	
		$thisdata = [];		
		foreach ($view_inputs as $key => $value) {
			// exit($key);			
			str_replace("\" ", "\"", $key);			
			str_replace(" \"", "\"", $key);			
			$key = str_replace("\"", "", $key);			
			array_push( $thisdata, $key );		
		}		
		Data::addData( $thisdata, $identifier );		
		$output = str_replace($matches[$index], "", $output );
		return $output;
	}

	public static function addOptions($output, $matches, $str, $index, $view_inputs, $identifier)
	{ 
		foreach ($view_inputs as $key => $value) {			
			Data::addOption( $value, $key, $identifier );		
		}		
		$output = str_replace($matches[$index], "", $output );
		return $output;
	}

	public static function get_string_between($string, $start, $end)
	{
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini+= strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
}