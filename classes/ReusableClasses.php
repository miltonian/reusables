<?php

namespace Reusables;

if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', "");
}

class ReusableClasses
{
    public $PDO; // PHP Data Object
    protected static $forminputlastindexes = [];
    protected static $formonstep = [];



    //public static $PDO;
    private $cryptKey = "Rxp45dn142etvQk9e17Oo3nx2xJKfkZs"; // Encryption Key

    public static function parentDir($file)
    {
        $parentdir = ReusableClasses::dirname_r($file, 1);
        $parentdir = basename($parentdir);
        return $parentdir;
    }
    public static function dirname_r($path, $count=1)
    {
        if ($count > 1) {
            return dirname(ReusableClasses::dirname_r($path, --$count));
        } else {
            return dirname($path);
        }
    }



    public static function startpage($page)
    {
        ob_start('Reusables\Page::reusables');
    }

    public static function endpage($parent_dir, $page, $endbody=true, $addjquery=true, $addeditor=true)
    {
        Views::analyze(true);


        $viewoutput = Views::setViews();


        // $output = ob_get_contents();
        // ob_end_clean();

        Page::addCSS();
        Page::addReusableJS($addjquery);
        Page::addEditor($addeditor);
        Page::add_pre_javascript();

        // exit( json_encode( $page ) );
        $page = rtrim($page, ".php");

        if (file_exists(BASE_DIR . '/vendor/miltonian/custom/css/pages/header.css')) {
            echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/header.css'>";
        }
        if (file_exists(BASE_DIR . '/vendor/miltonian/custom/css/pages/footer.css')) {
            echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/footer.css'>";
        }

        if ($parent_dir == "") {
            echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/" . basename($page, '.php') . ".css'>";
            if (file_exists(BASE_DIR . '/vendor/miltonian/custom/js/pages/before/' . basename($page, '.php') . ".js")) {
                echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . '/vendor/miltonian/custom/js/pages/before/' . basename($page, '.php') . ".js" . "'></script>";
            }
        } else {
            echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/" . $parent_dir . "/" . basename($page, '.php') . ".css'>";

            if (file_exists(BASE_DIR . "/vendor/miltonian/custom/js/pages/before/" . $parent_dir . "/" . basename($page, '.php') . ".js")) {
                echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . '/vendor/miltonian/custom/js/pages/before/' . $parent_dir . '/' . basename($page, '.php') . ".js" . "'></script>";
            }
        }
        // echo "<link rel='stylesheet' type='text/css' href='/vendor/miltonian/custom/css/pages/" . basename($page, '.php') . ".css'>";


        echo $viewoutput;
        echo Editing::set();
        // echo $formoutput;

        Page::addJavascript();

        echo "
			<script>
				if( typeof Reusable === 'undefined' ) {
					var Reusable = new ReusableClasses();
				}
			</script>
		";

        Views::clearArrays();

        echo "
			<script>
				$('.horizontal.main.adminbar.desktopnav.navbar-shadow .horizontal.button.edit_switch.wrapper  a.horizontal.topbar-button').click(function(e){
					e.preventDefault()
					Reusable.toggleEditing()
				});

				$('.horizontal.main.adminbar.desktopnav.navbar-shadow .horizontal.button.edit_options_switch.wrapper  a.horizontal.topbar-button').click(function(e){
					e.preventDefault()
					Reusable.toggleEditingOptions()
				})

			</script>
		";
    }



    public static function testReusables()
    {
        // ReusableClasses::startpage( "" );
        Data::add(["title"=>"It works!"], "test_header");
        Header::set("underline_edit", "test_header");
        ReusableClasses::endpage("", "");
    }

    public static function getOnStepForm($identifier)
    {
        if (isset(self::$formonstep[ $identifier ])) {
            $laststep = intval(self::$formonstep[$identifier]);
            $onstep = $laststep + 1;
            return $onstep;
        } else {
            return 1;
        }
    }

    public static function setOnStepForm($identifier, $step)
    {
        if ($identifier == null) {
            return;
        }
        self::$formonstep[$identifier] = $step;
    }

    public static function getLastInputIndexForForm($identifier)
    {
        if (!isset(self::$forminputlastindexes[$identifier])) {
            return null;
        }

        $lastindex = self::$forminputlastindexes[$identifier];
        return $lastindex;
    }

    public static function setFormInputIndex($identifier, $index)
    {
        if ($identifier == null || $identifier=="") {
            return;
        }
        self::$forminputlastindexes[$identifier] = $index;
    }











    public static function getDropdownFunctionsJS($dict)
    {
        $action_key = RFormat::getViewActionKey($dict);
        if ($action_key == '') {
            return [];
        }

        echo "var dropdownfunctions = [];";
        $i=0;
        foreach ($dict[$action_key] as $ca) {
            $ca_type = Data::getValue($ca, 'type');
            if ($ca_type == "modal") {
                echo "var thismodalclass = new " . $ca['modal']['modalclass'] . "Classes();
				dropdownfunctions.push( thismodalclass );";
            } else {
                echo 'dropdownfunctions.push( "nothing" );';
            }
            $i++;
        }
    }


    public static function setUpEditingForSection($viewdict, $viewoptions, $identifier, $alwayseditable=false)
    {
        Editing::setUpEditingForSection($viewdict, $viewoptions, $identifier, $alwayseditable);
    }
    public static function clickToEditSection($viewdict, $viewoptions, $identifier, $filename, $alwayseditable=false)
    {
        return Editing::clickToEditSection($viewdict, $viewoptions, $identifier, $filename, $alwayseditable);
    }

    public static function toValueAndDBInfo($result, $conditions, $default_table, $customcolname=null)
    {
        return RFormat::toValueAndDBInfo($result, $conditions, $default_table, $customcolname);
    }









    // Function to echo chosen error message:
    private function error($msg)
    {
        echo "<br />! Error: $msg<br />";
    }
    // Function to return encrypted version of $x:
    private function encryptIt($x)
    {
        return(str_replace('/', '', base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(self::$cryptKey), $x, MCRYPT_MODE_CBC, md5(md5(self::$cryptKey))))));
    }
    // Function to return decrypted version of $x:
    private function decryptIt($x)
    {
        return(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(self::$cryptKey), base64_decode($x), MCRYPT_MODE_CBC, md5(md5(self::$cryptKey))), "\0"));
    }

    public function __destruct()
    {
        if (isset($this->PDO)) {
            unset($this->PDO);
        }
        if (isset($this->cryptKey)) {
            unset($this->cryptKey);
        }
    }
}


// --------------------------
/* END: ugoinout_classes/barhop_classes.php */
