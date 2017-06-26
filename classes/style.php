<?php

// namespace Reusables\Classes;

class Style {

	protected static $allcss = array();

	public static function structure_1( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
				<style>
					.".$identifier." { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%;  }
						.".$identifier." .maincolumn { display: inline-block; position: relative; margin: 10px; margin-right: 5px; padding: 0px; float: left; }
						.".$identifier." .sidecolumn_right { position: relative; margin: 10px; margin-left: 5px; padding: 0px; width: calc( 30% - 20px ); float: left; }
					@media (min-width: 0px) {
						.".$identifier." .maincolumn { width: calc(100% - 20px); }
						.".$identifier." .sidecolumn_right { display: none; }
					}
					@media (min-width: 768px) {
						.".$identifier." .maincolumn { width: calc(70% - 20px); }
						.".$identifier." .sidecolumn_right { display: inline-block; }
					}
				</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

	public static function structure_2( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
				<style>
					.".$identifier." { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
						.".$identifier." .maincolumn { display: inline-block; position: relative; margin: 10px; margin-right: 5px; padding: 0px; float: left; }
					@media (min-width: 0px) {
						.".$identifier." .maincolumn { width: calc(100% - 20px); }
					}
					@media (min-width: 768px) {

					}
				</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

}


