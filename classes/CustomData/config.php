<?php 

namespace Reusables\CustomData;

// Settings: -------------------------------------- //
	date_default_timezone_set('America/New_York');
// ------------------------------------------------ //

function return_gen_config() {

	$CONFIG = array();
	// General Configuration Settings: ---------------- //
		$CONFIG[ 'domain' ] = "theanywherecard.com";
	// ------------------------------------------------ //

	return( $CONFIG );

}

function return_db_config() {

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

	return( $DB );

}

// --------------------------
/* END: include/config.php */ ?>