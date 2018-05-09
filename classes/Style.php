<?php

namespace Reusables;

class Style {

	protected static $allcss = array();

	public static function addcss( $parent_dir, $file )
	{
		if ( !isset( self::$allcss[$parent_dir][ $file ] ) ) {
			self::$allcss[$parent_dir][ $file ] = true;
			// exit( json_encode( PROJECT_ROOT ) );
			// echo "<link rel=stylesheet href='/vendor/miltonian/reusables/assets/css/" . $parent_dir . "/" . $file . ".css' type='text/css'>";
			if( $parent_dir == "custom" ){
				$currentversion = CustomView::getCurrentVersion();
				if( $currentversion ){
					$parent_dir = PROJECT_ROOT . "/vendor/miltonian/custom/" . $currentversion . "/css/views/";
				}else{
					$parent_dir = PROJECT_ROOT . Page::$customviewscss;
				}

			}else if( $parent_dir == "customreusableview" ){
				$currentversion = CustomView::getCurrentVersion();
				if( $currentversion ){
					$parent_dir = PROJECT_ROOT . "/vendor/miltonian/custom/reusables/" . $currentversion . "/css/views/";
				}else{
					$parent_dir = PROJECT_ROOT . "/vendor/miltonian/custom/reusables/css/views/";
				}
			}else if( $parent_dir != "" ){
				$parent_dir = PROJECT_ROOT . "/vendor/miltonian/reusables/assets/css/" . $parent_dir . "/";
			}else{
				$parent_dir = PROJECT_ROOT . "/vendor/miltonian/reusables/assets/css/";
			}

			if (strpos($parent_dir, 'css/custom') !== false) {
				$parent_dir = str_replace('miltonian/reusables/assets/css/custom', 'miltonian/custom/css/views', $parent_dir);
			}

			if( file_exists(BASE_DIR . $parent_dir . $file . ".css") ) {
				echo "<link rel=stylesheet href='" . $parent_dir . $file . ".css' type='text/css'>";
			}
		}
	}

	public static function slider_2( $identifier )
	{
		if(!isset(self::$allcss['slider'][ $identifier ])){
			self::$allcss['slider'][ $identifier ] = "
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
			return self::$allcss['slider'][ $identifier ];
		}
	}

}


