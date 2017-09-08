<?php 

namespace Reusables;

if( !defined( 'PROJECT_ROOT' ) ){
	define( 'PROJECT_ROOT', "" );
}

class ReusableClasses {
	
	public $PDO; // PHP Data Object
	protected static $includedfiles = array();

	protected static $addedjs = "";

	//public static $PDO;
	private $cryptKey = "Rxp45dn142etvQk9e17Oo3nx2xJKfkZs"; // Encryption Key

	public static function addfile( $parent_dir, $file )
	{
		array_push( self::$includedfiles, [ "parent_dir" => $parent_dir, "file" => $file ] );
	}

	public static function addcss()
	{
		// exit( json_encode( self::$includedfiles ) );
		foreach (self::$includedfiles as $f) {
			Style::addcss( $f['parent_dir'], $f['file'] );
		}
	}

	public static function addjs()
	{
		// exit( json_encode( self::$includedfiles ) );
		foreach (self::$includedfiles as $f) {
			Scripts::addjs( $f['parent_dir'], $f['file'] );
		}

		echo self::$addedjs;
	}

	public static function addbeforejs()
	{
		foreach (self::$includedfiles as $f) {
			Scripts::addbeforejs( $f['parent_dir'], $f['file'] );
		}
	}

	public static function startpage( $page )
	{
		ob_start();
	}


	public static function endpage( $parent_dir, $page, $endbody=true, $addjquery=true )
	{
		if( $endbody ){
			echo "</body>";
		}
		$output = ob_get_contents();
		ob_end_clean();
		ReusableClasses::addcss();
		ReusableClasses::addReusableJS( $addjquery );
		ReusableClasses::addbeforejs();

		// exit( json_encode( $page ) );
		$page = rtrim($page, ".php");
		
		if( $parent_dir == ""){
			echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/" . basename($page, '.php') . ".css'>";
			if( file_exists( BASE_DIR . '/vendor/miltonian/custom/js/pages/before/' . basename($page, '.php') . ".js" ) ){
				echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . '/vendor/miltonian/custom/js/pages/before/' . basename($page, '.php') . ".js" . "'></script>";
			}
		}else{
			echo "<link rel='stylesheet' type='text/css' href='" . PROJECT_ROOT . "/vendor/miltonian/custom/css/pages/" . $parent_dir . "/" . basename($page, '.php') . ".css'>";

			if( file_exists( BASE_DIR . "/vendor/miltonian/custom/js/pages/before/" . $parent_dir . "/" . basename($page, '.php') . ".js" ) ){
				echo "<script type='text/javascript' src='" . PROJECT_ROOT . "" . '/vendor/miltonian/custom/js/pages/before/' . $parent_dir . '/' . basename($page, '.php') . ".js" . "'></script>";
			}
		}
		// echo "<link rel='stylesheet' type='text/css' href='/vendor/miltonian/custom/css/pages/" . basename($page, '.php') . ".css'>";
		echo $output;

		ReusableClasses::addjs();
	}

	public static function addReusableJS( $addjquery )
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

		if( $addjquery ){
			echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
		}
	}

	public static function testReusables()
	{
		ReusableClasses::startpage( "" );
		Data::addData(["title"=>"It works!"], "test_header" );
		echo Header::make( "header_3", "test_header" );
		ReusableClasses::endpage( "", "" );
	}

	public static function addJSToView( $file, $custom_identifier=null, $func )
	{
		self::$addedjs .= "<script>
			" . $file . "." . $func . "( '" . $custom_identifier . "' );
		</script>";
	}




	public static function cell( $file, $data )
	{
		$View = View::factory( 'reusables/views/cell/' . $file );
		$View->set( 'celldict', $data );
		echo $View->render();
	}
	public static function section( $file, $data )
	{
		$View = View::factory( 'reusables/views/section/' . $file );
		$View->set( 'sectiondict', $data );
		echo $View->render();
	}
	public static function table( $file, $data )
	{
		$View = View::factory( 'reusables/views/table/' . $file );
		$View->set( 'tabledict', $data );
		echo $View->render();
	}
	public static function header( $file, $data )
	{
		$View = View::factory( 'reusables/views/header/' . $file );
		$View->set( 'headerdict', $data );
		echo $View->render();
	}
	public static function wrapper( $file, $data )
	{
		$View = View::factory( 'reusables/views/wrapper/' . $file );
		$View->set( 'children', $data['children'] );
		$View->set( 'wrapperdict', $data );
		echo $View->render();
	}
	public static function postinternal( $file, $data )
	{
		$View = View::factory( 'reusables/views/postinternal/' . $file );
		$View->set( 'sharingdict', $data['sharingdict'] );
		$View->set( 'postdict', $data );
		echo $View->render();
	}
	public static function structure( $file, $data )
	{
		$View = View::factory( 'reusables/views/structure/' . $file );
		$View->set( 'structuredict', $data );
		echo $View->render();
	}
	public static function sharing( $file, $data )
	{
		$View = View::factory( 'reusables/views/sharing/' . $file );
		$View->set( 'sharingdict', $data );
		echo $View->render();
	}



	public static function getTestArrays( $whichone ){
		$sendback = [];
		if( $whichone==1 ){
			$sendback=self::getTestForHome();
		}else if( $whichone==2 ){
			$sendback=self::getTestForPost();
		}
		return $sendback;
	}

	public static function getTestForHome(){
		$sectiondict = [
			"post_id"=>"0",
			"title"=>"the title",
			"html_text"=>"lorem ipsum stuff you know you know?",
			"featured_imagepath"=>"https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Blue_Bird_Vision_Montevideo_54.jpg/250px-Blue_Bird_Vision_Montevideo_54.jpg",
			"isfeatured"=>false,
			"mediatype"=>"image",
		];
		$postarray = array(
			$sectiondict,
			$sectiondict,
			$sectiondict,
			$sectiondict,
			$sectiondict,
			$sectiondict
		);
		$testarray = array(
			"adposition"=>0,
			"featured_imagepath"=>"http://rocketjar.com/uploads/network-image/34.network-image.1496928583.IHS-(146).jpg",
			"logo_imagepath"=>"http://rocketjar.com/uploads/network-logo/34.network-logo.1496928761.mocklogo.png",
			"title"=>"Hamilton High School",
			"desc"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"html_text"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"postarray"=>$postarray,
			"children"=>array(["filename"=>"header_3", "viewtype"=>"header", "data"=>[] ], ["filename"=>"table_1", "viewtype"=>"table", "data"=>[] ])
		);
		for ($i=0; $i < sizeof($testarray['children']); $i++) { 
			$testarray['children'][$i]['data'] = $testarray;
		}
		$sectiondict1 = [
			"featured_imagepath"=>"http://rocketjar.com/uploads/network-image/34.network-image.1496928583.IHS-(146).jpg",
			"logo_imagepath"=>"http://rocketjar.com/uploads/network-logo/34.network-logo.1496928761.mocklogo.png",
			"title"=>"Hamilton High School",
			"adposition"=>0,
			"desc"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton."
		];
		$postdict = [
			"isfeatured"=>false,
			"mediatype"=>"image",
			"post_id"=>"0",
			"title"=>"The Title",
			"html_text"=>"lorem ipsum stuff you know you know?",
			"featured_imagepath"=>"https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Blue_Bird_Vision_Montevideo_54.jpg/250px-Blue_Bird_Vision_Montevideo_54.jpg",
			"date"=>"",
		];
		$tabledict = [
			"postarray"=>array($postdict, $postdict, $postdict, $postdict, $postdict, $postdict, $postdict, $postdict)
		];

		$sendback = [
			"postarray"=>$postarray,
			"testarray"=>$testarray,
			"sectiondict1"=>$sectiondict1,
			"tabledict"=>$tabledict
		];

		return $sendback;
	}

	public static function getTestForPost(){
		$sectiondict = [
			"post_id"=>"0",
			"title"=>"the title",
			"html_text"=>"lorem ipsum stuff you know you know?",
			"featured_imagepath"=>"https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Blue_Bird_Vision_Montevideo_54.jpg/250px-Blue_Bird_Vision_Montevideo_54.jpg",
			"isfeatured"=>false,
			"mediatype"=>"image",
		];
		$postarray = array(
			$sectiondict,
			$sectiondict,
			$sectiondict,
			$sectiondict,
			$sectiondict,
			$sectiondict
		);
		// only one featured_imagepath per post
		// only one logo_imagpeath per post
		$testarray = array(
			"adposition"=>0,
			"featured_imagepath"=>"http://rocketjar.com/uploads/network-image/34.network-image.1496928583.IHS-(146).jpg",
			"logo_imagepath"=>"http://rocketjar.com/uploads/network-logo/34.network-logo.1496928761.mocklogo.png",
			"title"=>"Hamilton High School",
			"desc"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"html_text"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"postarray"=>$postarray,
			"goal"=>"4000000",
			"funded"=>"2319900",
			"funders"=>"6",
			"sharingdict"=>["facebook"=>"", "twitter"=>""]
		);
		$rewardsdict = [
			"price"=>"$150",
			"title"=>"Sponsor a Seat",
			"desc"=>"What a huge help you are! We thank you so much and would like to put your name on one of our seats.",
		];
		$rewardsarray = array(
			$rewardsdict, $rewardsdict, $rewardsdict
		);
		$testarray2 = array(
			"adposition"=>0,
			"featured_imagepath"=>"http://rocketjar.com/uploads/network-image/34.network-image.1496928583.IHS-(146).jpg",
			"logo_imagepath"=>"http://rocketjar.com/uploads/network-logo/34.network-logo.1496928761.mocklogo.png",
			"title"=>"Rewards",
			"desc"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"html_text"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"postarray"=>$rewardsarray,
			"sharingdict"=>["facebook"=>"", "twitter"=>""]
		);
		$postinternalarray = $testarray;

		$sendback = [
			"postarray"=>$postarray,
			"testarray"=>$testarray,
			"testarray2"=>$testarray2,
			"postinternalarray"=>$postinternalarray
		];

		return $sendback;
	}

	
		public static function getPosts_tablenames($postarray){
			// make dict for tablenames
			$tablenames = [];
			$allkeys = array_keys($postarray[0]);
			foreach ($allkeys as $k) {
				$tablenames[$k] = "posts";
			}
			return $tablenames;
		}
	
		public static function getMainCategories_tablenames( $categories )
		{
			// make dict for tablenames
			$tablenames = [];
			$allkeys = array_keys($categories[0]);
			foreach ($allkeys as $k) {
				$tablenames[$k] = "main_categories";
			}
			return $tablenames;
		}

	

	public static function toValueAndDBInfo( $result, $conditions, $default_table, $customcolname=null ){
		$tablenames = [];
		$colnames = [];
		$thisdict = [];
		if ( Data::isAssoc( $result ) ) {
			// is dict
			if( $result == null ){
				return [];
			}
			$thisdict = $result;
		}else{
			// is array
			if( !isset($result[0]) ){
				return [];
			}

			$thisdict = $result[0];

		}
		$allkeys = array_keys($thisdict);

		foreach ($allkeys as $k) {
			$tablenames[$k] = $default_table;
			if( $customcolname ){
				$colnames[$k] = $customcolname;
			}else{
				$colnames[$k] = $k;
			}
		}

		$returningdict = [
			"value" => $result,
			"db_info" => [
				"tablenames" => $tablenames,
				"colnames" => $colnames,
				"conditions" => $conditions
			]
		];

		return $returningdict;
	}

	
		public static function getNetworkInfo_db($networkinfo){
			// make dict for tablenames
			$array_for_db = [];
			$allkeys = array_keys($networkinfo[0]);
			// exit(json_encode())
			foreach ($allkeys as $k) {

				if($k=="name"){
					$array_for_db[$k]['tablename'] = "networks";
				}else{
					$array_for_db[$k]['tablename'] = "network_info";
				}
			}
			return $array_for_db;
		}

	public static function checkRequired( $filename, $viewdict, $required )
	{
		$requiredkeys = array_keys($required);

		$missing = false;
		foreach ($requiredkeys as $r) {
			$keys = explode("|", $r);
			// $condition = str_replace("|", " || ", $r);
			$condition = "";
			$i=0;
			$found=false;
			foreach ($keys as $k) {
				if( isset( $viewdict[$k] ) ){ $found=true; }
			}
			
			if( !$found ){ 
				$missing=true; echo $filename . " is missing " . $r . "<br>"; 
			}
		}

		if ($missing) {
			exit();
		}
	}

	public static function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13))
	        return $number. 'th';
	    else
	        return $number. $ends[$number % 10];
	}



	// Function to echo chosen error message:
	private function error( $msg ) { echo "<br />! Error: $msg<br />"; }
	// Function to return encrypted version of $x:
	private function encryptIt( $x ) { return( str_replace( '/', '', base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( self::$cryptKey ), $x, MCRYPT_MODE_CBC, md5( md5( self::$cryptKey ) ) ) ) ) ); }
	// Function to return decrypted version of $x:
	private function decryptIt( $x ) { return( rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( self::$cryptKey ), base64_decode( $x ), MCRYPT_MODE_CBC, md5( md5( self::$cryptKey ) ) ), "\0") ); }
	
	public function __destruct()
	{
		if( isset( $this->PDO ) ) unset( $this->PDO );
		if( isset( $this->cryptKey ) ) unset( $this->cryptKey );
	}

}


// --------------------------
/* END: ugoinout_classes/barhop_classes.php */ ?>