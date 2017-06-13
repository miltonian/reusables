<?php /* FILE:    ugoinout_classes/db_pdo.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    7/07/2014
-------- Purpose: Class to construct and return PDO (PHP Data Objects) initialized using configurations from include/config.php. */

class Reusables_db_pdo {
	public $pdo;
	public function __construct()
	{
		$DB = array(); // Database Connection Configuration:
		// ------------------------------------------------ //
			if($_SERVER['HTTP_HOST'] == "localhost:8888"){
				$DB[ 'hostname' ] = "***"; // ip address
			}else{
				$DB[ 'hostname' ] = "localhost";
			}
			
			$DB[ 'database' ] = "***";
			$DB[ 'username' ] = "***";
			$DB[ 'password' ] = "***";
		// ------------------------------------------------ //
		$this->pdo = new PDO( 'mysql:host=' . $DB[ "hostname" ] . ';dbname=' . $DB[ "database" ] . ';', $DB[ "username" ], $DB[ "password" ] );
		if( isset( $DB ) ) unset( $DB );
	}
	public function PDO_Return() { return( $this->pdo ); }
	public function __destruct() { if( isset( $this->pdo ) ) unset( $this->pdo ); }
}

// --------------------------
/* END: include/db_pdo.php */ ?>