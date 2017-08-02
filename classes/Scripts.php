<?php

namespace Reusables;

class Scripts {

	protected static $alljs = array();

	public static function addjs( $parent_dir, $file )
	{
		
		// $filename = "<script type='text/javascript' src='vendor/miltonian/reusables/assets/js/" . $parent_dir . "/" . $file . ".js'></script>";
		if( $parent_dir == "custom" ){
				$currentversion = CustomView::getCurrentVersion();
				if( $currentversion ){
					$parent_dir = "vendor/miltonian/custom/" . $currentversion . "/js/views/";
				}else{
					$parent_dir = "vendor/miltonian/custom/js/views/";
				}
		}else if( $parent_dir != "" ){
			$parent_dir = "vendor/miltonian/reusables/assets/js/" . $parent_dir . "/";
		}else{
			$parent_dir = "vendor/miltonian/reusables/assets/js/";
		}
		$filename = $parent_dir . $file . ".js";

		$path = BASE_DIR . rtrim($path, '/') . $filename;

		if ( !isset( self::$alljs[ $file ] ) && file_exists( $path ) ) {
			self::$alljs[ $file ] = true;

			echo "<script type='text/javascript' src='" . '/' . $filename . "'></script>";
			
			echo "
				<script>
					let " . $file . " = new " . $file . "_classes();
				</script>
			";
		}

	}

	 

}