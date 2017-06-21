<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

namespace Reusables\Classes;

require_once 'View.php';


class ReusableClasses {
	
	public $PDO; // PHP Data Object
	//public static $PDO;
	private $cryptKey = "Rxp45dn142etvQk9e17Oo3nx2xJKfkZs"; // Encryption Key

	//protected static
	public function capture( $view_filename, array $view_data )
	{
		// Import the view variables to local namespace
		extract( $view_data, EXTR_SKIP );

		// Capture the view output
		ob_start();

		try
		{
			// Load the view within the current scope
			include '../reusables/views/'.$view_filename;
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

	public function cell( $file, $data )
	{
		$View = View::factory( '../reusables/views/cell/' . $file );
		$View->set( 'celldict', $data );
		echo $View->render();
	}
	public function section( $file, $data )
	{
		$View = View::factory( '../reusables/views/section/' . $file );
		$View->set( 'sectiondict', $data );
		echo $View->render();
	}
	public function table( $file, $data )
	{
		$View = View::factory( '../reusables/views/table/' . $file );
		$View->set( 'tabledict', $data );
		echo $View->render();
	}
	public function header( $file, $data )
	{
		$View = View::factory( '../reusables/views/header/' . $file );
		$View->set( 'headerdict', $data );
		echo $View->render();
	}
	public function wrapper( $file, $data )
	{
		$View = View::factory( '../reusables/views/wrapper/' . $file );
		$View->set( 'children', $data['children'] );
		$View->set( 'wrapperdict', $data );
		echo $View->render();
	}
	public function postinternal( $file, $data )
	{
		$View = View::factory( '../reusables/views/postinternal/' . $file );
		$View->set( 'sharingdict', $data['sharingdict'] );
		$View->set( 'postdict', $data );
		echo $View->render();
	}
	public function structure( $file, $data )
	{
		$View = View::factory( '../reusables/views/structure/' . $file );
		$View->set( 'structuredict', $data );
		echo $View->render();
	}
	public function sharing( $file, $data )
	{
		$View = View::factory( '../reusables/views/sharing/' . $file );
		$View->set( 'sharingdict', $data );
		echo $View->render();
	}



	public function getTestArrays(){
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
			"header"=>"this is header",
			"featured_imagepath"=>"http://rocketjar.com/uploads/network-image/34.network-image.1496928583.IHS-(146).jpg",
			"logo_imagepath"=>"http://rocketjar.com/uploads/network-logo/34.network-logo.1496928761.mocklogo.png",
			"title"=>"Hamilton High School",
			"desc"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"html_text"=>"Hamilton High School, Hamilton is a public four-year high school located at 123 Newton Ave in Bicentennial Park, Tennessee, in the United States. It is part of Consolidated High School District 230, which also includes Victor J. Andrew High School and Amos Alonzo Stagg High School. The school is named for first treasurer of the United States of America, Alexander Hamilton.",
			"postarray"=>$postarray,
			"goal"=>"4000000",
			"funded"=>"2319900",
			"funders"=>"6",
			"sharingdict"=>["facebook"=>"", "twitter"=>""],
			// "children"=>array(["filename"=>"header_3", "viewtype"=>"header", "data"=>[] ])
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
			"sharingdict"=>["facebook"=>"", "twitter"=>""],
			"children"=>array(["filename"=>"header_4", "viewtype"=>"header", "data"=>[] ], ["filename"=>"table_2", "viewtype"=>"table", "data"=>$rewardsarray ])
		);
		for ($i=0; $i < sizeof($testarray2['children']); $i++) { 
			$testarray2['children'][$i]['data'] = $testarray2;
		}
		$postinternalarray = $testarray;
		for ($i=0; $i < 1; $i++) { 
			$postinternalarray['children'][$i]['filename'] = "postinternal_3";
			$postinternalarray['children'][$i]['viewtype'] = "postinternal";
			$postinternalarray['children'][$i]['data'] = $testarray;
		}

		$sendback = [
			"postarray"=>$postarray,
			"testarray"=>$testarray,
			"testarray2"=>$testarray2,
			"postinternalarray"=>$postinternalarray
		];
		
		return $sendback;
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