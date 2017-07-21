<?php

namespace Reusables;

class Scripts {

	protected static $alljs = array();

	public static function addjs( $parent_dir, $file )
	{
		
		// $filename = "<script type='text/javascript' src='vendor/miltonian/reusables/assets/js/" . $parent_dir . "/" . $file . ".js'></script>";
		if( $parent_dir == "custom" ){
				$parent_dir = "vendor/miltonian/custom/js/views/";
		}else if( $parent_dir != "" ){
			$parent_dir = "vendor/miltonian/reusables/assets/js/" . $parent_dir . "/";
		}else{
			$parent_dir = "vendor/miltonian/reusables/assets/js/";
		}
		$filename = $parent_dir . $file . ".js";

		if ( !isset( self::$alljs[ $file ] ) && file_exists( BASE_DIR . '/' . $filename ) ) {
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