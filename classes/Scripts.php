<?php

namespace Reusables;

class Scripts {

	protected static $alljs = array();
	protected static $allbeforejs = array();

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
		}else if( $parent_dir == "customreusableview" ){
				$currentversion = CustomView::getCurrentVersion();
				if( $currentversion ){
					$parent_dir = "/vendor/miltonian/custom/reusables/" . $currentversion . "/css/views/";
				}else{
					$parent_dir = "/vendor/miltonian/custom/reusables/css/views/";
				}
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

			echo "<script>
				if (typeof " . $file . "_start == 'function') { 
					" . $file . "_start();
				}
			</script>";
		}

	}

	public static function addbeforejs( $parent_dir, $file )
	{
		
		// $filename = "<script type='text/javascript' src='vendor/miltonian/reusables/assets/js/" . $parent_dir . "/" . $file . ".js'></script>";
		if( $parent_dir == "custom" ){
				$currentversion = CustomView::getCurrentVersion();
				if( $currentversion ){
					$parent_dir = "vendor/miltonian/custom/" . $currentversion . "/js/views/before/";
				}else{
					$parent_dir = "vendor/miltonian/custom/js/views/before/";
				}
		}else if( $parent_dir != "" ){
			$parent_dir = "vendor/miltonian/reusables/assets/js/before/" . $parent_dir . "/";
		}else{
			$parent_dir = "vendor/miltonian/reusables/assets/js/before/";
		}
		$filename = $parent_dir . $file . ".js";

		

		if ( !isset( self::$allbeforejs[ $file ] ) && file_exists( BASE_DIR . '/' . $filename ) ) {
			self::$allbeforejs[ $file ] = true;

			echo "<script type='text/javascript' src='" . '/' . $filename . "'></script>";
			

		}

	}


	 

}