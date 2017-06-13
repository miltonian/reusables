<?php /* FILE:    ugoinout_classes/config.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    7/07/2014
-------- Purpose: Stores sensitive configuration data and sets general/initial configuration settings. */

// Settings: -------------------------------------- //
	date_default_timezone_set('America/New_York');
// ------------------------------------------------ //

function return_gen_config() {

	$CONFIG = array();
	// General Configuration Settings: ---------------- //
		$CONFIG[ 'domain' ] = "***"; 
	// ------------------------------------------------ //

	return( $CONFIG );

}

function return_db_config() {

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

	return( $DB );

}

// --------------------------
/* END: include/config.php */ ?>