<?php

namespace Reusables;

if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', "");
}

class Page
{
    public static $customdir = "custom/views/";
    public static $custompagescss = '/vendor/miltonian/custom/css/pages/';
    public static $customviewscss = '/vendor/miltonian/custom/css/views/';
    public static $custompagesjs = '/vendor/miltonian/custom/js/pages/';
    public static $customviewsjs = '/vendor/miltonian/custom/js/views/';

    protected static $page_in_html = false;
    protected static $file_assets = [];
    protected static $addedjs = "";

    public static function start($in_html = false)
    {
        // IMPORTANT: this function isnt needed unless page is mainly custom code
        self::$page_in_html = $in_html;
        ob_start('Reusables\Page::reusables');
    }

    public static function end($page, $endbody = true, $addjquery = true, $addeditor = true)
    {
        // End the Reusables buffer and capture the contents
        if (sizeof(ob_get_status('Reusables\Page::reusables')) > 0) {
            CustomCode::end();
        }

        // Set analyze views to true
        Views::analyze(true);

        // Loops through each view and combines its data and options to a new View object
        Views::setViews();

        // Loops through each buffered view, creates the View object and sets its parameters
        $viewoutput = Views::makeViews();

        // include css files
        Page::addCSS();

        // Add custom css and javascript files
        Page::addCustomCSSAndJS($page);

        // Include the default Reusable javascript files
        Page::addReusableJS($addjquery);

        // Add the wysiwig text editor for the forms
        Page::addEditor($addeditor);

        // Include the view specific javascript
        // This javascript is meant to read before the body tag
        Page::add_pre_javascript();

        // make page responsive styling
        echo ' <meta name="viewport" content="width=device-width, initial-scale=1.0"> ';

        // echo the buffered contents captured earlier
        echo $viewoutput;

        // echo Editing::set();

        // Include the view specific javascript
        // This javascript is meant to read after the body tag
        Page::addJavascript();

        // Clear the arrays used to create the page in Reusables because we don't need them anymore
        Views::clearArrays();

        // Define the ReusableClasses class
        Page::defineJSReusableVar();

        // Add the actions for the edit options and edit data buttons in the admin bar
        Page::addAdminBarEditButtonActions();
    }

    public static function addAdminBarEditButtonActions()
    {
        // Add the actions for the edit options and edit data buttons in the admin bar
        echo "
			<script>
				$('.horizontal.main.adminbar.desktopnav.navbar-shadow .horizontal.button.edit_switch.wrapper  a.horizontal.topbar-button').click(function(e){
					e.preventDefault()
					Reusable.toggleEditing()
				})

				$('.horizontal.main.adminbar.desktopnav.navbar-shadow .horizontal.button.edit_options_switch.wrapper  a.horizontal.topbar-button').click(function(e){
					e.preventDefault()
					Reusable.toggleEditingOptions()
				})

			</script>
		";
    }

    public static function defineJSReusableVar()
    {
        // Define the ReusableClasses class
        echo "
        <script>
            if( typeof Reusable === 'undefined' ) {
                var Reusable = new ReusableClasses();
            }
        </script>
        ";
    }

    public static function getParentAndPageName($page)
    {
        $arr = explode("/views/", $page);
        $important = $arr[1];
        $arr = explode("/", $important);
        $parent_dir = "";
        $i = 0;
        foreach ($arr as $str) {
            if ($i < sizeof($arr) - 1) {
                if ($i > 0) {
                    $parent_dir .= "/";
                }
                $parent_dir .= $str;
            }
            $i++;
        }
        $page = rtrim($page, ".php");

        return ["page" => $page, "parent_dir" => $parent_dir];
    }

    public static function getPageName($page)
    {
        return Page::getParentAndPageName($page)['page'];
    }

    public static function getParentDirName($page)
    {
        return Page::getParentAndPageName($page)['parent_dir'];
    }

    public static function addReusableJS($addjquery)
    {
        echo "
			<script src='/vendor/miltonian/reusables/assets/js/ReusableClasses.js'></script>
			<script src='/vendor/miltonian/reusables/assets/thirdparty/dropzone.js'></script>
			<script>

			if ( typeof ReusableClasses === 'function' ){
				let Reusables = new ReusableClasses();
				Reusables.addJQuery();
			}
			</script>
		";

        if ($addjquery) {
            echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";

            echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<link rel="stylesheet" href="/resources/demos/style.css">
			<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
			<link rel="stylesheet" href="/vendor/miltonian/reusables/assets/thirdparty/jquery.timepicker.css">
			<script src="/vendor/miltonian/reusables/assets/thirdparty/jquery.timepicker.min.js"></script>';
        }
    }

    // Page::addAssetFile() will queue the necessary css and js files related to the view
    public static function addAssetFile($parent_dir, $file)
    {
        array_push(Page::$file_assets, ["parent_dir" => $parent_dir, "file" => $file]);
    }

    // Page::addCSS() Loops through each file_asset and includes CSS files to the page
    public static function addCSS()
    {
        foreach (Page::$file_assets as $f) {
            Style::addCSS($f['parent_dir'], $f['file']);
        }

        // The header and footer are global asset files so we include them every time
        if (file_exists(BASE_DIR . self::$custompagescss . 'header.css')) {
            echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . "header.css'>";
        }

        // The header and footer are global asset files so we include them every time
        if (file_exists(BASE_DIR . self::$custompagescss . 'footer.css')) {
            echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . "footer.css'>";
        }
    }

    // addCustomCSSAndJS() Add custom css and javascript files
    public static function addCustomCSSAndJS($page)
    {
        // Filter $page for the name
        $page = Page::getPageName($page);

        // Filter $page for the parent directory
        $parent_dir = Page::getParentDirName($page);

        if ($parent_dir == "") {
            echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . basename($page, '.php') . ".css'>";
            if (file_exists(BASE_DIR . '/vendor/miltonian/custom/js/pages/before/' . basename($page, '.php') . ".js")) {
                echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . self::$customviewsjs . 'before/' . basename($page, '.php') . ".js" . "'></script>";
            }
        } else {
            if (file_exists(BASE_DIR . self::$custompagescss . $parent_dir . "/" . basename($page, '.php') . ".css")) {
                echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . $parent_dir . "/" . basename($page, '.php') . ".css'>";
            }
            if (file_exists(BASE_DIR . self::$custompagesjs . "before/" . $parent_dir . "/" . basename($page, '.php') . ".js")) {
                echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . self::$custompagesjs . 'before/' . $parent_dir . '/' . basename($page, '.php') . ".js" . "'></script>";
            }
        }
    }

    // Loops through each file_asset and includes CSS files to the page
    // Page::add_pre_javascript() happens before body tag
    public static function add_pre_javascript()
    {
        foreach (Page::$file_assets as $f) {
            Scripts::addbeforejs($f['parent_dir'], $f['file']);
        }
    }

    // Loops through each file_asset and includes Javascript files to the page
    // Page::addJavascript() happens after body tag
    public static function addJavascript()
    {
        foreach (Page::$file_assets as $f) {
            Scripts::addjs($f['parent_dir'], $f['file']);
        }

        echo Page::$addedjs;
    }

    public static function addEditor($addit)
    {
        if ($addit) {
            echo '<script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>';
            // exit(json_encode( $addit ) );
        }
    }

    public static function setCustomDir($dir)
    {
        Page::$customdir = $dir;
    }

    public static function setCustomCSSDir($dir)
    {
        Page::$custompagescss = $dir;
    }

    public static function setCustomCSSViews($dir)
    {
        Page::$customviewscss = $dir;
    }

    public static function setCustomJSDir($dir)
    {
        Page::$custompagesjs = $dir;
    }

    public static function setCustomJSViews($dir)
    {
        Page::$customviewsjs = $dir;
    }

    public static function reusables($a)
    {
        return $a;
    }

    public static function inhtml()
    {
        if (sizeof(ob_get_status('Reusables\Page::reusables')) > 0) {
            // CustomCode::end();
            return self::$page_in_html;
        }
    }
}
