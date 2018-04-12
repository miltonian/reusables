<?php 

namespace Reusables;

class CustomCode {

	public static $viewsSet = [];

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
		// preg_match_all("/\\{\\{\s(.*)\\}\\}/", $output, $matches);
		preg_match("/\\{\\{\s(.*)\\}\\}/", $output, $matches);
		if( isset($matches) && $matches && !empty($matches) ) {
			CustomCode::replaceViews( $output, $matches );
		} else {
			// $dict = [ "viewtype" => "CustomCode", "code" => $output ];
			CustomCode::place( $output );
		}
// exit( json_encode( $str ) );
	}

	public static function replaceViews( $output, $matches )
	{
		if( isset($matches) && $matches && !empty($matches) ) {
			foreach ($matches as $index => $matchdict) {
				$str = str_replace("{{", "", $matches[$index]);
				$str = str_replace("}}", "", $str);
				$str = $str;
				if( is_string($str) && $str ) {

					// $str = $str[0];
					$str = str_replace(" ", "", $str);
					$id_arr = explode("[", $str);
					$str_arr = explode(":", $id_arr[0]);
					$identifier = $str_arr[0];
					
					if( isset( self::$viewsSet[$identifier] ) ) {
						$output = str_replace( $matches[$index], "", $output );
						// CustomCode::checkForViews( $output );
						return;
					} else {
						self::$viewsSet[$identifier] = true;
					}
					$other = $id_arr[1];
					$other = str_replace("];", "", $other);
					$values = explode(",", $other);
					$view_inputs = [];
					foreach ($values as $v) {
						$v = explode(":", $v);
						$view_inputs[$v[0]] = $v[1];
					}
					$view = $view_inputs['view'];
					$viewdict = Data::getValue( $view_inputs, 'data' );
					$viewoptions = Data::getValue( $view_inputs, 'options' );
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
					}
					// CustomCode::place( $after_string );
// exit( json_encode( $matches[$index] ) );
					// $output = str_replace( $matches[$index], "", $output );
					CustomCode::checkForViews( $after_string );
					return;
				}

			}
			
		}

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


