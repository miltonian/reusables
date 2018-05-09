<?php 

namespace Reusables;

if( !defined( 'PROJECT_ROOT' ) ){
	define( 'PROJECT_ROOT', "" );
}

class Page {

	public static $customdir = "custom/views/";
	public static $custompagescss = '/vendor/miltonian/custom/css/pages/';
	public static $customviewscss = '/vendor/miltonian/custom/css/views/';
	public static $custompagesjs = '/vendor/miltonian/custom/js/pages/';
	public static $customviewsjs = '/vendor/miltonian/custom/js/views/';
	protected static $page_in_html = false;


	public static function setCustomDir( $dir )
	{
		Page::$customdir = $dir;
	}

	public static function setCustomCSSDir( $dir )
	{
		Page::$custompagescss = $dir;
	}

	public static function setCustomCSSViews( $dir )
	{
		Page::$customviewscss = $dir;
	}

	public static function setCustomJSDir( $dir )
	{
		Page::$custompagesjs = $dir;
	}

	public static function setCustomJSViews( $dir )
	{
		Page::$customviewsjs = $dir;
	}

	public static function reusables($a)
	{
	    return $a;
	}

	public static function inhtml()
	{
		if( sizeof( ob_get_status('Reusables\Page::reusables') ) > 0 ) {
			// CustomCode::end();
			return self::$page_in_html;
		}
		
	}

	public static function start( $in_html=false )
	{
		// IMPORTANT: this function isnt needed unless page is mainly custom code
		self::$page_in_html = $in_html;
		ob_start('Reusables\Page::reusables');
	}

	public static function end( $page, $endbody=true, $addjquery=true, $addeditor=true )
	{
		if( sizeof( ob_get_status('Reusables\Page::reusables') ) > 0 ) {
			CustomCode::end();
		}
		Views::analyze( true );


		$viewoutput = Views::setViews();
		// $formoutput = Views::setForms();

		// Views::makeViews();

		
		// $output = ob_get_contents();
		// ob_end_clean();

		ReusableClasses::addcss();
		ReusableClasses::addReusableJS( $addjquery );
		ReusableClasses::addEditor( $addeditor );
		ReusableClasses::addbeforejs();

		$arr = explode('/views/', $page);
		$important = $arr[1];
		$arr = explode('/', $important);
		$parent_dir = "";
		$i=0;
		foreach ($arr as $str) {
			if( $i < sizeof($arr)-1 ) {
				if( $i > 0 ) {
					$parent_dir .= "/";
				}
				$parent_dir .= $str;
			}
			$i++;
		}
		$page = rtrim($page, ".php");
		
		if( file_exists( BASE_DIR . self::$custompagescss . 'header.css' ) ) {
			echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . "header.css'>";
		}
		if( file_exists( BASE_DIR . self::$custompagescss . 'footer.css' ) ){
			echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . "footer.css'>";
		}

		if( $parent_dir == ""){
			// exit( json_encode( PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/" . basename($page, '.php') . ".css'>" ) );
			echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . basename($page, '.php') . ".css'>";
			if( file_exists( BASE_DIR . '/vendor/miltonian/custom/js/pages/before/' . basename($page, '.php') . ".js" ) ){
				echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . self::$customviewsjs . 'before/' . basename($page, '.php') . ".js" . "'></script>";
			}
		}else{
			// exit(json_encode( PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/" . $parent_dir . "/" . basename($page, '.php') . ".css'>" ) );
			if( file_exists(BASE_DIR . self::$custompagescss . $parent_dir . "/" . basename($page, '.php') . ".css") ) {
				// exit( json_encode( "<link rel='stylesheet' type='text/css' href='" . BASE_DIR . "/vendor/miltonian/custom/css/pages/" . $parent_dir . "/" . basename($page, '.php') . ".css'>" ) );
				echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . self::$custompagescss . $parent_dir . "/" . basename($page, '.php') . ".css'>";
			}

			if( file_exists( BASE_DIR . self::$custompagesjs . "before/" . $parent_dir . "/" . basename($page, '.php') . ".js" ) ){
				echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . self::$custompagesjs . 'before/' . $parent_dir . '/' . basename($page, '.php') . ".js" . "'></script>";
			}
		}
		// echo "<link rel='stylesheet' type='text/css' href='/vendor/miltonian/custom/css/pages/" . basename($page, '.php') . ".css'>";


		echo $viewoutput;
		echo ReusableClasses::makeEditing();
		// echo $formoutput;

		ReusableClasses::addjs();

		echo "
			<script> 
				if( typeof Reusable === 'undefined' ) {
					var Reusable = new ReusableClasses();
				}
			</script>
		";

		Views::cleararrays();

				// ReusableClasses::addEditing($editing);
		echo "
			<script>
				$('.horizontal.main.adminbar.desktopnav.navbar-shadow .horizontal.button.edit_switch.wrapper  a.horizontal.topbar-button').click(function(e){
					e.preventDefault()
					Reusable.toggleEditing()
				})

			</script>
		";

	}

}