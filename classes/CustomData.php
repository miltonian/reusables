<?php 

namespace Reusables;

// $MainClasses = new MainClasses();

class CustomData {

	public static function call( $classname, $func, $vars )
	{
		require_once( BASE_DIR . '/vendor/miltonian/custom/data/' . $classname . ".php" );
		if( sizeof( $vars ) > 0 ){
			return call_user_func_array($classname . "::" . $func, $vars );
		}else{
			return $classname::$func();
		}
	}

}