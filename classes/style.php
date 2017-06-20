<?php

namespace Reusables\Classes;

require_once 'View.php';
require_once 'classes.php';

$ReusableClasses = new ReusableClasses();

// $allcss = [];

class Style {

	protected static $allcss = array();

	public static function structure1()
	{
		if(!isset(self::$allcss['structure1'])){
			self::$allcss['structure1'] = "
				<style>
					.structure_1 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; min-height: 100%; }
						.structure_1 .maincolumn { display: inline-block; position: relative; margin: 10px; margin-right: 5px; padding: 0px; float: left; }
						.structure_1 .sidecolumn_right { position: relative; margin: 10px; margin-left: 5px; padding: 0px; width: calc( 30% - 20px ); float: left; }
					@media (min-width: 0px) {
						.structure_1 .maincolumn { width: calc(100% - 20px); }
						.structure_1 .sidecolumn_right { display: none; }
					}
					@media (min-width: 768px) {
						.structure_1 .maincolumn { width: calc(70% - 20px); }
						.structure_1 .sidecolumn_right { display: inline-block; }
					}
				</style>
			";
			return self::$allcss['structure1'];
		}
	}

}


