cd ../
if [ ! -d "custom" ]; then
	# Control will enter here if $DIRECTORY doesn't exist.
	mkdir custom
	cd custom
		mkdir css
		mkdir data
		mkdir images
		mkdir functions
		mkdir reusables
		mkdir uploads
		mkdir views

	cd css
		mkdir pages
		mkdir views

	cd ../reusables
		mkdir css
		mkdir download
		mkdir images
		mkdir js
		mkdir views
		mkdir zips

		cd css
			mkdir pages
			mkdir views

		cd ../js
			mkdir before

	cd ../../uploads
		mkdir ads
		mkdir icons
		mkdir thumbs_large
		mkdir thumbs_med
		mkdir thumbs_small

	cd ../data
		touch DBClasses.php
		touch config.php
		touch db_pdo.php

		echo "<?php 

// namespace Reusables\CustomData;

// Settings: -------------------------------------- //
	date_default_timezone_set('America/New_York');
// ------------------------------------------------ //

function return_gen_config() {

	\$CONFIG = array();
	// General Configuration Settings: ---------------- //
		\$CONFIG[ 'domain' ] = 'theanywherecard.com';
	// ------------------------------------------------ //

	return( \$CONFIG );

}

function return_db_config() {

	\$DB = array(); // Database Connection Configuration:
	// ------------------------------------------------ //
		if(\$_SERVER['HTTP_HOST'] == 'localhost:8888'){
			\$DB[ 'hostname' ] = '173.254.65.122';
		}else{
			\$DB[ 'hostname' ] = 'localhost';
		}
		\$DB[ 'database' ] = 'atabuysc_reusables_views';
		\$DB[ 'username' ] = 'atabuysc_tester';
		\$DB[ 'password' ] = '~]@3I{aaQp*a';
	// ------------------------------------------------ //

	return( \$DB );

}

// --------------------------
/* END: include/config.php */ ?>" > config.php;

echo "<?php 

// namespace Reusables\CustomData;

class db_pdo {
	public \$pdo;
	public function __construct()
	{
		\$DB = array(); // Database Connection Configuration:
		// ------------------------------------------------ //
			if(\$_SERVER['HTTP_HOST'] == 'localhost:8888'){
				\$DB[ 'hostname' ] = '173.254.65.122';
			}else{
				\$DB[ 'hostname' ] = 'localhost';
			}
			\$DB[ 'database' ] = 'atabuysc_reusables_views';
			\$DB[ 'username' ] = 'atabuysc_tester';
			\$DB[ 'password' ] = '~]@3I{aaQp*a';

		// ------------------------------------------------ //
		\$this->pdo = new \PDO( 'mysql:host=' . \$DB[ 'hostname' ] . ';dbname=' . \$DB[ 'database' ] . ';', \$DB[ 'username' ], \$DB[ 'password' ] );
		if( isset( \$DB ) ) unset( \$DB );
	}
	public function PDO_Return() { return( \$this->pdo ); }
	public function __destruct() { if( isset( \$this->pdo ) ) unset( \$this->pdo ); }
}

// --------------------------
/* END: include/db_pdo.php */ ?>" > db_pdo.php;

echo "<?php

// namespace Reusables\CustomData;

// namespace Reusables;

require_once( 'db_pdo.php' );

class DBClasses {

	public \$PDO; // PHP Data Object
	private \$cryptKey;
	
	public function __construct() 
	{
		\$this->cryptKey = \"Rxp45dn142etvQk9e17Oo3nx2xJKfkZs\";
		\$odp = new db_pdo();
		\$this->PDO = \$odp->PDO_Return();
	}

	private function encryptIt( \$password )
	{
		\$encoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( \$this->cryptKey ), \$password, MCRYPT_MODE_CBC, md5( md5( \$this->cryptKey ) ) ) );
		return( str_replace( '/', '', \$encoded ) ); 
	}

	public static function example()
	{
		\$DBClasses = new DBClasses();
		\$query = 'SELECT * FROM posts WHERE id > ?';
		\$values = [ 0 ];
		\$type = 'select';
		\$result = \$DBClasses->nonstatic_querySQL( \$query, \$values, \$type );

		return \$result;
	}

	public static function checkLogin( \$query, \$username, \$password )
	{
		\$DBClasses = new DBClasses();
		\$encryptedPass = \$DBClasses->encryptIt( \$password );
		\$result = \$DBClasses->nonstatic_querySQL( \$query, [ \$username, \$encryptedPass ], 'select' );
		return \$result;
	}

	public static function querySQL( \$query, \$values, \$type )
	{
		\$DBClasses = new DBClasses();
		\$result = \$DBClasses->nonstatic_querySQL( \$query, \$values, \$type );

		return \$result;
	}

	// public static function standardquery( \$pararameters )
	// {
	// 	\$DBClasses = new DBClasses();
	// 	\$query = 'SELECT * FROM posts WHERE id > ?';
	// 	\$values = [ \$parameters ];
	// 	\$type = 'select';
	// 	\$result = \$DBClasses->querySQL( \$query, \$values, \$type );

	// 	return \$result;
	// }

	public function nonstatic_querySQL( \$query, \$values, \$type )
	{
		\$Q = \$this->PDO->prepare(\$query);
		for(\$i=0;\$i<sizeof(\$values);\$i++){
			if(is_int(\$values[\$i])){
				\$Q->bindValue( \$i+1, \$values[\$i], \PDO::PARAM_INT );
			}else{
				\$Q->bindValue( \$i+1, \$values[\$i], \PDO::PARAM_STR );
			}
		}
		\$Q->execute();
		if( \$Q->rowCount() > 0 )
		{
			\$returnvalue = 'Success';
			if(strtolower(\$type)=='select'){
				\$returnvalue = \$Q->fetchAll( \PDO::FETCH_ASSOC );
			}else if(strtolower(\$type)=='insert'){
				\$returnvalue = \$this->PDO->lastInsertId();
			}
			return( array( 1, \$returnvalue ) );
		}
		else
		{
			\$returnvalue = 'Failure';
			if(\$type=='select'){
				\$returnvalue = array();
			}else if(\$type=='insert'){
				\$returnvalue = '0';
			}
			return( array( 0, \$returnvalue ) );
		}
	}

	private function decryptIt( \$password )
	{
		\$decoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( \$this->cryptKey ), base64_decode( \$password ), MCRYPT_MODE_CBC, md5( md5( \$this->cryptKey ) ) ), \"\\0\");
		return( \$decoded );
	}

	public function __destruct()
	{
		if( isset( \$this->PDO ) ) unset( \$this->PDO );
		if( isset( \$this->cryptKey ) ) unset( \$this->cryptKey );
	}

}" > DBClasses.php;
		
fi