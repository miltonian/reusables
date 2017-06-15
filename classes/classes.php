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