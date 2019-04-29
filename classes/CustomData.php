<?php

namespace Reusables;

// $MainClasses = new MainClasses();

class CustomData {

	public static function call( $classname, $func, $vars )
	{
		if (file_exists(BASE_DIR . '/vendor/miltonian/custom/data/' . $classname . ".php")) {
				require_once( BASE_DIR . '/vendor/miltonian/custom/data/' . $classname . ".php" );
		} else if (file_exists(BASE_DIR . '/vendor/miltonian/vibrant/data/' . $classname . ".php")) {
				require_once( BASE_DIR . '/vendor/miltonian/vibrant/data/' . $classname . ".php" );
		}else {
			return;
		}
		if( sizeof( $vars ) > 0 ){
			return call_user_func_array($classname . "::" . $func, $vars );
		}else{
			return $classname::$func();
		}
	}

}
