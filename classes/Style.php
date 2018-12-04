<?php

namespace Reusables;

class Style
{

    protected static $allcss = array();

    public static function addCSS($parent_dir, $file)
    {
        if (!isset(self::$allcss[$parent_dir][$file])) {
            self::$allcss[$parent_dir][$file] = true;
            // exit( json_encode( PROJECT_ROOT ) );
            // echo "<link rel=stylesheet href='/vendor/miltonian/reusables/assets/css/" . $parent_dir . "/" . $file . ".css' type='text/css'>";
            if ($parent_dir == "custom") {
                $currentversion = CustomView::getCurrentVersion();
                if ($currentversion) {
                    $parent_dir = PROJECT_ROOT . "/vendor/miltonian/custom/" . $currentversion . "/css/views/";
                } else {
                    $parent_dir = PROJECT_ROOT . Page::$customviewscss;
                }

            } else if ($parent_dir == "customreusableview") {
                $currentversion = CustomView::getCurrentVersion();
                if ($currentversion) {
                    $parent_dir = PROJECT_ROOT . "/vendor/miltonian/custom/reusables/" . $currentversion . "/css/views/";
                } else {
                    $parent_dir = PROJECT_ROOT . "/vendor/miltonian/custom/reusables/css/views/";
                }
            } else if ($parent_dir != "") {
                $parent_dir = PROJECT_ROOT . "/vendor/miltonian/reusables/assets/css/" . $parent_dir . "/";
            } else {
                $parent_dir = PROJECT_ROOT . "/vendor/miltonian/reusables/assets/css/";
            }

            if (strpos($parent_dir, 'css/custom') !== false) {
                $parent_dir = str_replace('miltonian/reusables/assets/css/custom', 'miltonian/custom/css/views', $parent_dir);
            }

            if (file_exists(BASE_DIR . $parent_dir . $file . ".css")) {
                echo "<link rel=stylesheet href='" . $parent_dir . $file . ".css' type='text/css'>";
            }
        }
    }

	// Default styling for a view
    public static function defaultView($file, $identifier, $viewvalues)
    {
		// Get view data and options
        $viewdict = Data::get($identifier);
        $viewoptions = Options::get($identifier);

		// Convert options styling attributes to variables
        $text_color = Data::getValue($viewoptions, "text_color");
        $background_color = Data::getValue($viewoptions, "background_color");
        $image_size = Data::getValue($viewoptions, "image_size");
        $image_corner_radius = Data::getValue($viewoptions, "image_corner_radius");
        $text_align = Data::getValue($viewoptions, "text_align");
        $title_size = Data::getValue($viewoptions, "title_size");
        $subtitle_size = Data::getValue($viewoptions, "subtitle_size");
        $description_size = Data::getValue($viewoptions, "description_size");
        $title_color = Data::getValue($viewoptions, "title_color");
        $subtitle_color = Data::getValue($viewoptions, "subtitle_color");
        $description_color = Data::getValue($viewoptions, "description_color");
        $text_offset_x = Data::getValue($viewoptions, "text_offset_x");
        $text_offset_y = Data::getValue($viewoptions, "text_offset_y");
        $padding = Data::getValue($viewoptions, "padding");
        $margin = Data::getValue($viewoptions, "margin");
        $width = Data::getValue($viewoptions, "width");
        $height = Data::getValue($viewoptions, "height");
        $columns = Data::getValue($viewoptions, "columns");

        if ($image_size == "") {
            $image_size = "cover";
        }
        if ($image_corner_radius == "") {
            $image_corner_radius = 0;
        }

        echo " <style> ";
        echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".inner { display: inline-block; position: relative; margin: 0; padding: 0; float: left; background-size: " . $image_size . "; background-repeat: no-repeat; background-position: center; ";
        if ($height != "") {
            // echo "height: ".$height.";";
        }

        echo " } ";
        echo " @media( min-width: 0px) { ";
        echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".inner { width: 100%; }";
        echo " } ";
        if( ReusableClasses::parentDir($file) != "gallery" ) {
          echo " @media( min-width: 768px) { ";
            if( $columns == "" ) {
              echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".inner { width: " . ((1.0 / sizeof($viewvalues)) * 100) . "%; }";
            } else {
              echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".inner { width: " . ((1.0 / intval($columns)) * 100) . "%; }";
            }
          echo " } ";
        }

        echo "@media (min-width: 0px) {";
          echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . ".main {";
          if ($height != "") {
              echo "min-height: " . $height . " !important;";
          }
          echo " } ";
        echo " } ";

        echo "@media (min-width: 768px) {";
          echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . ".main {";
          if ($height != "") {
              // echo "height: " . $height . " !important;";
          }
          echo " } ";
          echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".inner { ";
            if ($height != "") {
              echo "height: " . $height . " !important;";
            } else {
              if( $columns == "" ) {
                echo "height: " . strval(100 - ((25*sizeof($viewvalues)) - 25)) . "%;";
              } else {
                echo "height: " . strval(100 - ((25*intval($columns)) - 25)) . "%;";
              }
            }
          echo "}";
        echo " } ";

        echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".image { display: inline-block; position: relative; margin: 0; padding: 0; float: left; background-size: " . $image_size . "; background-repeat: no-repeat; background-position: center; border-radius: " . $image_corner_radius . " } ";

        if (Data::getValue($viewoptions, "dark") == "true" || Data::getValue($viewoptions, "dark") == true) {
            $text_color = "#fff";
            $background_color = "#333";
        }
        if ($text_color != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".title { color: " . $text_color . " ; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".subtitle { color: " . $text_color . " ; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " .description { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " p { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h1 { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h2 { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h3 { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h4 { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h5 { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h6 { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " label { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " a { color: " . $text_color . "; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " .link { color: " . $text_color . "; } ";
        } else {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".title { color: #333 ; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".subtitle { color: #333 ; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " .description { color: #333; } ";
        }

        if ($text_align != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".title { text-align: " . $text_align . " !important ; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".subtitle { text-align: " . $text_align . " !important ; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " .description { text-align: " . $text_align . " !important; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " p, ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h1, ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h2, ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h3, ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h4, ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h5, ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " h6 { text-align: " . $text_align . " !important; } ";
        }

        if ($text_offset_x != "") {
          echo "@media (min-width: 768px) {";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".content_container { margin-left: " . $text_offset_x . " !important ; } ";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".text_container { margin-left: " . $text_offset_x . " !important ; } ";
          echo "}";
        }

        if ($text_offset_y != "") {
            echo "@media (min-width: 768px) {";
              echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".content_container { margin-top: " . $text_offset_y . " !important ; } ";
              echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".text_container { margin-top: " . $text_offset_y . " !important ; } ";
            echo "}";
        }

        if ($title_size != "") {

          echo "@media (min-width: 768px) {";
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".title { font-size: " . $title_size . " !important ; } ";
          echo "}";
        }

        if ($subtitle_size != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".subtitle { text-align: " . $subtitle_size . " !important ; } ";
        }

        if ($description_size != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " .description { text-align: " . $description_size . " !important; } ";
        }

        if ($title_color != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".title { color: " . $title_color . " !important ; } ";
        }

        if ($subtitle_color != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " ." . basename($file, ".php") . ".subtitle { color: " . $subtitle_color . " !important ; } ";
        }

        if ($description_color != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " .description { color: " . $description_color . " !important; } ";
        }

        if ($background_color != "") {
            echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " { background-color: " . $background_color . "; } ";
        }

        $padding_arr = Views::getPaddingOrMargin($identifier);
        $padding = $padding_arr[0];
        $padding_width = $padding_arr[1];
        $margin_arr = Views::getPaddingOrMargin($identifier, "margin");
        $margin = $margin_arr[0];
        $margin_width = $margin_arr[1];

        if ($width == "") {
            $width = "100%";
        }
        echo " ." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " { margin: 0; padding: 0; }
		@media(min-width: 0px) {
			." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " { padding: 0 !important; margin: 0 !important; width: 100%; }
		}

		@media(min-width: 768px) {
			." . $identifier . ".viewtype_" . ReusableClasses::parentDir($file) . "." . basename($file, ".php") . " { padding: " . $padding . " !important; margin: " . $margin . " !important; width: calc(" . $width . " - " . $padding_width . " - " . $margin_width . "); }
		}";

		// $options_form_inputs = [
        //     "text_color"=>["field_value"=>$text_color]
        // ];
        //         Data::addOptions($options_form_inputs, "input_keys", $identifier . "_options_form");

        echo " </style> ";
    }

    public static function slider_2($identifier)
    {
        if (!isset(self::$allcss['slider'][$identifier])) {
            self::$allcss['slider'][$identifier] = "
			<style>
				." . $identifier . " { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; background-color: black; width: calc(100% - 40px); padding: 0 20px; margin: 0; overflow: hidden; }
					." . $identifier . " .backgroundimage { position: absolute; display: inline-block; margin: 0; padding: 0; top: -10%; left: -10%; width: 120%; height: 120%; background-position: center; background-size: cover; filter:blur(15px); }
					." . $identifier . " .image { display: inline-block; position: absolute; margin: 0; padding: 0; height: 100%; width: 100%; background-position: center; background-size: contain; background-size: cover; background-repeat: no-repeat; }
						." . $identifier . " .image.left { left: -100%; }
						." . $identifier . " .image.mid { left: 0; }
						." . $identifier . " .image.right { left: 100%; }

					." . $identifier . " .buttons { display: inline-block; position: absolute; margin: 0; padding: 0; height: 100%; width: 20%; top: 0; z-index: 1; -webkit-appearance: none; border: 0; cursor: pointer; background: transparent; background-position: center; background-size: 30% auto; background-repeat: no-repeat; opacity: 0.8; display: none; }
						." . $identifier . " .buttons:hover {background-color: rgba(0,0,0,0.5);}
					." . $identifier . " .buttons.left { left: 0; float: left; background-image: url('/reusables/uploads/icons/leftarrow-white.png'); }
					." . $identifier . " .buttons.right { right: 0; float: right; background-image: url('/reusables/uploads/icons/rightarrow-white.png'); }
					." . $identifier . ".editing { cursor: pointer; }

					." . $identifier . " .image#two { left: 0; animation: cycle 15s ease infinite; }
					." . $identifier . " .image#three { left: 0; transform: translateX(100%); animation: cycletwo 15s ease infinite;}
					." . $identifier . " .image#one { left: 0; transform: translateX(100%); animation: cyclethree 15s ease infinite;}

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
            return self::$allcss['slider'][$identifier];
        }
    }

}
