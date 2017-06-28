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
						.".$identifier." .sidecolumn_right { display: inline-block; position: relative; margin: 10px; margin-left: 5px; padding: 0px; float: left; }
					@media (min-width: 0px) {
						.".$identifier." .maincolumn { width: calc(100% - 20px); }
						.".$identifier." .sidecolumn_right { width: calc( 100% - 20px ); }
					}
					@media (min-width: 768px) {
						.".$identifier." .maincolumn { width: calc(70% - 20px); }
						.".$identifier." .sidecolumn_right { width: calc( 30% - 20px ); }
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

	public static function three_columns( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
				<style>
					.".$identifier." { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%;  }
						.".$identifier." .maincolumn { display: inline-block; position: relative; margin: 10px; margin-right: 5px; padding: 0px; float: left; }
						.".$identifier." .sidecolumn_right { position: relative; margin: 10px; margin-left: 5px; padding: 0px; width: calc( 20% - 20px ); float: left; }
						.".$identifier." .sidecolumn_left { display: inline-block; position: relative; margin: 10px; margin-left: 5px; padding: 0px;  float: left; }
					@media (min-width: 0px) {
						.".$identifier." .maincolumn { width: calc(100% - 20px); }
						.".$identifier." .sidecolumn_right { width: calc(100% - 20px); }
						.".$identifier." .sidecolumn_left { width: calc(100% - 20px); }
					}
					@media (min-width: 768px) {
						.".$identifier." .maincolumn { width: calc(60% - 20px); }
						.".$identifier." .sidecolumn_right { width: calc(20% - 20px); }
						.".$identifier." .sidecolumn_left { width: calc(20% - 20px); }
					}
				</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

	public static function modal_background( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
				<style>
					." . $identifier . "{ position: fixed; display: inline-block; margin: 0; padding: 0; width: 100%; height: 100%; left: 0; top: 0; text-align: center; z-index: 99;}
						." . $identifier . " .overlay { position: absolute; display: inline-block; margin: 0; padding: 0; width: 100%; height: 100%; left: 0; top: 0; background-color: rgba(0,0,0,0.6); }
						." . $identifier . " .maincolumn { position: relative; display: inline-block; margin: 0; padding: 0; z-index: 2; text-align: left; }
				</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

	public static function main_with_hidden( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
				<style>
					." . $identifier . " { position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; overflow: hidden; }
						." . $identifier . " .column { position: absolute; display: inline-block; margin: 0; padding: 0; width: 100%; left: 0; top: 0; }
							." . $identifier . " .column.second { left: 100%; }
							." . $identifier . " .column.third { left: 200%; }
				</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

	public static function fieldwrapper( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
				<style>
					
				</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

	public static function floating_frame( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
				<style>
					
				</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

	public static function slider_2( $identifier )
	{
		if(!isset(self::$allcss[ $identifier ])){
			self::$allcss[ $identifier ] = "
			<style>
				.".$identifier." { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; background-color: black; width: calc(100% - 40px); padding: 0 20px; margin: 0; overflow: hidden; }
					.".$identifier." .backgroundimage { position: absolute; display: inline-block; margin: 0; padding: 0; top: -10%; left: -10%; width: 120%; height: 120%; background-position: center; background-size: cover; filter:blur(15px); }
					.".$identifier." .image { display: inline-block; position: absolute; margin: 0; padding: 0; height: 100%; width: 100%; background-position: center; background-size: contain; background-size: cover; background-repeat: no-repeat; }
						.".$identifier." .image.left { left: -100%; }
						.".$identifier." .image.mid { left: 0; }
						.".$identifier." .image.right { left: 100%; }

					.".$identifier." .buttons { display: inline-block; position: absolute; margin: 0; padding: 0; height: 100%; width: 20%; top: 0; z-index: 1; -webkit-appearance: none; border: 0; cursor: pointer; background: transparent; background-position: center; background-size: 30% auto; background-repeat: no-repeat; opacity: 0.8; display: none; }
						.".$identifier." .buttons:hover {background-color: rgba(0,0,0,0.5);}
					.".$identifier." .buttons.left { left: 0; float: left; background-image: url('/reusables/uploads/icons/leftarrow-white.png'); }
					.".$identifier." .buttons.right { right: 0; float: right; background-image: url('/reusables/uploads/icons/rightarrow-white.png'); }
					.".$identifier.".editing { cursor: pointer; }

					.".$identifier." .image#two { left: 0; animation: cycle 15s ease infinite; }
					.".$identifier." .image#three { left: 0; transform: translateX(100%); animation: cycletwo 15s ease infinite;}
					.".$identifier." .image#one { left: 0; transform: translateX(100%); animation: cyclethree 15s ease infinite;}

				@keyframes cycle { 
					0% { transform: translateX(0%); z-index: 0; opacity: 1;} 
					39% { transform: translateX(0%); z-index: 0; opacity: 1;}
					40% { transform: translateX(0%); z-index: 0; opacity: 0;} 
					41% { transform: translateX(100%); z-index: 0; opacity: 0;} 
					66% { transform: translateX(100%); z-index: -1; opacity: 0; } 
					71% { transform: translateX(100%); z-index: -1; opacity: 0;} 
					95% { transform: translateX(100%); z-index: 1; opacity: 0;} 
					100% { transform: translateX(0%); z-index: 1; opacity: 1; } 
				}
				@keyframes cycletwo { 
					0% { transform: translateX(100%); opacity: 0; } 
					33% { transform: translateX(100%); z-index: 1; opacity: 1;} 
					38% { transform: translateX(0%); z-index: 0; opacity: 1;} 
					67% { transform: translateX(0%); z-index: 0; opacity: 1;} 
					68% { transform: translateX(0%); z-index: 0; opacity: 1;} 
					71% { transform: translateX(0); z-index: -1; opacity: 0;} 
					100% { transform: translateX(0%); z-index: -1; opacity: 0;} 
				}
				@keyframes cyclethree {
					0% { transform: translateX(100%); }
					66% { transform: translateX(100%); z-index: 99; opacity: 1;}
					71% { transform: translateX(0%); z-index: 0; opacity: 1;}
					96% { transform: translateX(0%); z-index: 0; opacity: 1;}
					99% { transform: translateX(0%); z-index: 0; opacity: 0;}
					100% { transform: translateX(0%); z-index: 0; opacity: 0;}
				}
			</style>
			";
			return self::$allcss[ $identifier ];
		}
	}

}


