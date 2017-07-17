<?php

namespace Reusables;

class Scripts {

	protected static $alljs = array();

	public static function addjs( $parent_dir, $file )
	{
		// $filename = "<script type='text/javascript' src='vendor/miltonian/reusables/assets/js/" . $parent_dir . "/" . $file . ".js'></script>";
		if( $parent_dir == "custom" ){
				$parent_dir = "/vendor/miltonian/custom/js/views/";
			}else if( $parent_dir != "" ){
				$parent_dir = "/vendor/miltonian/reusables/assets/js/" . $parent_dir . "/";
			}else{
				$parent_dir = "/vendor/miltonian/reusables/assets/js/";
			}
		$filename = "<script type='text/javascript' src='" . $parent_dir . $file . ".js'></script>";
		if ( !isset( self::$alljs[ $file ] ) && file_exists( $filename ) ) {
			self::$alljs[ $file ] = true;
			echo $filename;
		}
	}

}