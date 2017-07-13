<?php

namespace Reusables;

class Scripts {

	protected static $alljs = array();

	public static function addjs( $parent_dir, $file )
	{
		$filename = "<script type='text/javascript' src='/reusables/assets/js/" . $parent_dir . "/" . $file . ".js'></script>";
		// exit( json_encode( $filename ) );
		if ( !isset( self::$alljs[ $file ] ) && file_exists( $filename ) ) {
			self::$alljs[ $file ] = true;
			echo $filename;
		}
	}

}