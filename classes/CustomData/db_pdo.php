<?php 

namespace Reusables\CustomData;

class db_pdo {
	public $pdo;
	public function __construct()
	{
		$DB = array(); // Database Connection Configuration:
		// ------------------------------------------------ //
			if($_SERVER['HTTP_HOST'] == "localhost:8888"){
				$DB[ 'hostname' ] = "173.254.65.122";
			}else{
				$DB[ 'hostname' ] = "localhost";
			}
			$DB[ 'database' ] = "atabuysc_reusables_test";
			$DB[ 'username' ] = "atabuysc_tester";
			$DB[ 'password' ] = "~]@3I{aaQp*a";

		// ------------------------------------------------ //
		$this->pdo = new \PDO( 'mysql:host=' . $DB[ "hostname" ] . ';dbname=' . $DB[ "database" ] . ';', $DB[ "username" ], $DB[ "password" ] );
		if( isset( $DB ) ) unset( $DB );
	}
	public function PDO_Return() { return( $this->pdo ); }
	public function __destruct() { if( isset( $this->pdo ) ) unset( $this->pdo ); }
}

// --------------------------
/* END: include/db_pdo.php */ ?>