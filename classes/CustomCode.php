<?php 

namespace Reusables;

class CustomCode {

	public static function place( $code )
	{
		Views::addCustomCodeToQueue( $code );
	}

	public static function start()
	{
		ob_start();
	}

	public static function end()
	{
		$output = ob_get_contents();
		ob_end_clean();

		$dict = [ "viewtype" => "CustomCode", "code" => $output ];
		CustomCode::place( $output );
	}
}


