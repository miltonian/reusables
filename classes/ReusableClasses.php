<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

// namespace Reusables\Classes;

require_once 'classes/classes.php';
$MainClasses = new MainClasses();

class ReusableClasses {
	
	public $PDO; // PHP Data Object
	//public static $PDO;
	private $cryptKey = "Rxp45dn142etvQk9e17Oo3nx2xJKfkZs"; // Encryption Key

	//protected static
	public static function capture( $view_filename, array $view_data )
	{
		// Import the view variables to local namespace
		extract( $view_data, EXTR_SKIP );

		// Capture the view output
		ob_start();

		try
		{
			// Load the view within the current scope
			include 'reusables/views/'.$view_filename;
		}
		catch( \Exception $e )
		{
			// Delete the output buffer
			ob_end_clean();

			// Re-throw the exception
			throw $e;
		}

		// Get the captured output and close the buffer
		return ob_get_clean();
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

	public static function getPosts( $type )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT posts.* FROM posts WHERE posts.id > ? AND posts.scheduled<? ORDER BY posts.date_made DESC, posts.id DESC LIMIT 20';
		$values = [ 0, time() ];
		$type = "select";
		return $MainClasses->querySQL( $query, $values, $type )[1];
	}

	public static function getNetworkInfo( $networkid )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT networks.* FROM networks WHERE networks.id=?';
		$values = [ $networkid ];
		$type = "select";
		$networkname = $MainClasses->querySQL( $query, $values, $type )[1][0]['name'];

		$query = 'SELECT network_info.* FROM network_info WHERE network_info.network_id=?';
		$values = [ $networkid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1];
		$networkdict = [];
		foreach ($result as $pair) {
			$networkdict[$pair['maininfo_key']] = $pair['maininfo_value'];
		}
		$networkdict['name'] = $networkname;

		return $networkdict;
	}
	public static function getPostInfo( $postid )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT posts.* FROM posts WHERE posts.id = ?';
		$values = [ $postid ];
		$type = "select";
		return $MainClasses->querySQL( $query, $values, $type )[1][0];
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