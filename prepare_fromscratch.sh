cd ../
if [ ! -d "custom" ]; then
	# Control will enter here if \$DIRECTORY doesn't exist.
	mkdir custom
	cd custom
		mkdir css
		mkdir data
		mkdir images
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
		\$CONFIG[ 'domain' ] = '';
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




cd ../../../../
touch index.php

mkdir routing
mkdir views
mkdir structure
mkdir classes




cd routing
touch AltoRouter.php
echo "<?php

class AltoRouter {

	/**
	 * @var array Array of all routes (incl. named routes).
	 */
	protected \$routes = array();

	/**
	 * @var array Array of all named routes.
	 */
	protected \$namedRoutes = array();

	/**
	 * @var string Can be used to ignore leading part of the Request URL (if main file lives in subdirectory of host)
	 */
	protected \$basePath = '';

	/**
	 * @var array Array of default match types (regex helpers)
	 */
	protected \$matchTypes = array(
		'i'  => '[0-9]++',
		'a'  => '[0-9A-Za-z]++',
		'h'  => '[0-9A-Fa-f]++',
		'*'  => '.+?',
		'**' => '.++',
		''   => '[^/\.]++'
	);

	/**
	  * Create router in one call from config.
	  *
	  * @param array \$routes
	  * @param string \$basePath
	  * @param array \$matchTypes
	  */
	public function __construct( \$routes = array(), \$basePath = '', \$matchTypes = array() ) {
		\$this->addRoutes(\$routes);
		\$this->setBasePath(\$basePath);
		\$this->addMatchTypes(\$matchTypes);
	}
	
	/**
	 * Retrieves all routes.
	 * Useful if you want to process or display routes.
	 * @return array All routes.
	 */
	public function getRoutes() {
		return \$this->routes;
	}

	/**
	 * Add multiple routes at once from array in the following format:
	 *
	 *   \$routes = array(
	 *      array(\$method, \$route, \$target, \$name)
	 *   );
	 *
	 * @param array \$routes
	 * @return void
	 * @author Koen Punt
	 * @throws Exception
	 */
	public function addRoutes(\$routes){
		if(!is_array(\$routes) && !\$routes instanceof Traversable) {
			throw new \Exception('Routes should be an array or an instance of Traversable');
		}
		foreach(\$routes as \$route) {
			call_user_func_array(array(\$this, 'map'), \$route);
		}
	}

	/**
	 * Set the base path.
	 * Useful if you are running your application from a subdirectory.
	 */
	public function setBasePath(\$basePath) {
		\$this->basePath = \$basePath;
	}

	/**
	 * Add named match types. It uses array_merge so keys can be overwritten.
	 *
	 * @param array \$matchTypes The key is the name and the value is the regex.
	 */
	public function addMatchTypes(\$matchTypes) {
		\$this->matchTypes = array_merge(\$this->matchTypes, \$matchTypes);
	}

	/**
	 * Map a route to a target
	 *
	 * @param string \$method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
	 * @param string \$route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
	 * @param mixed \$target The target where this route should point to. Can be anything.
	 * @param string \$name Optional name of this route. Supply if you want to reverse route this url in your application.
	 * @throws Exception
	 */
	public function map(\$method, \$route, \$target, \$name = null) {

		\$this->routes[] = array(\$method, \$route, \$target, \$name);

		if(\$name) {
			if(isset(\$this->namedRoutes[\$name])) {
				throw new \Exception(\"Can not redeclare route '{\$name}'\");
			} else {
				\$this->namedRoutes[\$name] = \$route;
			}

		}

		return;
	}

	/**
	 * Reversed routing
	 *
	 * Generate the URL for a named route. Replace regexes with supplied parameters
	 *
	 * @param string \$routeName The name of the route.
	 * @param array @params Associative array of parameters to replace placeholders with.
	 * @return string The URL of the route with named parameters in place.
	 * @throws Exception
	 */
	public function generate(\$routeName, array \$params = array()) {

		// Check if named route exists
		if(!isset(\$this->namedRoutes[\$routeName])) {
			throw new \Exception(\"Route '{\$routeName}' does not exist.\");
		}

		// Replace named parameters
		\$route = \$this->namedRoutes[\$routeName];
		
		// prepend base path to route url again
		\$url = \$this->basePath . \$route;

		if (preg_match_all('\`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)\`', \$route, \$matches, PREG_SET_ORDER)) {

			foreach(\$matches as \$index => \$match) {
				list(\$block, \$pre, \$type, \$param, \$optional) = \$match;

				if (\$pre) {
					\$block = substr(\$block, 1);
				}

				if(isset(\$params[\$param])) {
					// Part is found, replace for param value
					\$url = str_replace(\$block, \$params[\$param], \$url);
				} elseif (\$optional && \$index !== 0) {
					// Only strip preceeding slash if it's not at the base
					\$url = str_replace(\$pre . \$block, '', \$url);
				} else {
					// Strip match block
					\$url = str_replace(\$block, '', \$url);
				}
			}

		}

		return \$url;
	}

	/**
	 * Match a given Request Url against stored routes
	 * @param string \$requestUrl
	 * @param string \$requestMethod
	 * @return array|boolean Array with route information on success, false on failure (no match).
	 */
	public function match(\$requestUrl = null, \$requestMethod = null) {

		\$params = array();
		\$match = false;

		// set Request Url if it isn't passed as parameter
		if(\$requestUrl === null) {
			\$requestUrl = isset(\$_SERVER['REQUEST_URI']) ? \$_SERVER['REQUEST_URI'] : '/';
		}

		// strip base path from request url
		\$requestUrl = substr(\$requestUrl, strlen(\$this->basePath));

		// Strip query string (?a=b) from Request Url
		if ((\$strpos = strpos(\$requestUrl, '?')) !== false) {
			\$requestUrl = substr(\$requestUrl, 0, \$strpos);
		}

		// set Request Method if it isn't passed as a parameter
		if(\$requestMethod === null) {
			\$requestMethod = isset(\$_SERVER['REQUEST_METHOD']) ? \$_SERVER['REQUEST_METHOD'] : 'GET';
		}

		foreach(\$this->routes as \$handler) {
			list(\$methods, \$route, \$target, \$name) = \$handler;

			\$method_match = (stripos(\$methods, \$requestMethod) !== false);

			// Method did not match, continue to next route.
			if (!\$method_match) continue;

			if (\$route === '*') {
				// * wildcard (matches all)
				\$match = true;
			} elseif (isset(\$route[0]) && \$route[0] === '@') {
				// @ regex delimiter
				\$pattern = '\`' . substr(\$route, 1) . '\`u';
				\$match = preg_match(\$pattern, \$requestUrl, \$params) === 1;
			} elseif ((\$position = strpos(\$route, '[')) === false) {
				// No params in url, do string comparison
				\$match = strcmp(\$requestUrl, \$route) === 0;
			} else {
				// Compare longest non-param string with url
				if (strncmp(\$requestUrl, \$route, \$position) !== 0) {
					continue;
				}
				\$regex = \$this->compileRoute(\$route);
				\$match = preg_match(\$regex, \$requestUrl, \$params) === 1;
			}

			if (\$match) {

				if (\$params) {
					foreach(\$params as \$key => \$value) {
						if(is_numeric(\$key)) unset(\$params[\$key]);
					}
				}

				return array(
					'target' => \$target,
					'params' => \$params,
					'name' => \$name
				);
			}
		}
		return false;
	}

	/**
	 * Compile the regex for a given route (EXPENSIVE)
	 */
	private function compileRoute(\$route) {
		if (preg_match_all('\`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)\`', \$route, \$matches, PREG_SET_ORDER)) {

			\$matchTypes = \$this->matchTypes;
			foreach(\$matches as \$match) {
				list(\$block, \$pre, \$type, \$param, \$optional) = \$match;

				if (isset(\$matchTypes[\$type])) {
					\$type = \$matchTypes[\$type];
				}
				if (\$pre === '.') {
					\$pre = '\.';
				}

				\$optional = \$optional !== '' ? '?' : null;
				
				//Older versions of PCRE require the 'P' in (?P<named>)
				\$pattern = '(?:'
						. (\$pre !== '' ? \$pre : null)
						. '('
						. (\$param !== '' ? \"?P<\$param>\" : null)
						. \$type
						. ')'
						. \$optional
						. ')'
						. \$optional;

				\$route = str_replace(\$block, \$pattern, \$route);
			}

		}
		return \"\`^\$route\$\`u\";
	}
}
" > AltoRouter.php;

cd ../

echo "<?php

error_reporting(E_ALL);
ini_set('display_errors','On');
// define( 'BASE_DIR', realpath( dirname( __FILE__ ) . '/../' ) );
define( 'BASE_DIR', realpath( dirname( __FILE__ ) . '/' ) );
global \$router, \$match;

require_once 'vendor/autoload.php';
require 'routing/AltoRouter.php';
\$router = new AltoRouter();

\$router->map( 'POST', '/edit_view.php', function() {
	global \$router, \$match;
	require 'vendor/miltonian/reusables/functions/edit_view.php';
}, \"\");

\$router->map( 'POST', '/functions/login', function() {
	global \$router, \$match;
	require 'vendor/miltonian/reusables/functions/login.php';
}, \"\");

\$router->map( 'GET', '/makereusablezip', function() {
	global \$router, \$match;
	require 'vendor/miltonian/custom/functions/makereusablezip.php';
}, \"\");

\$router->map( 'POST', '/custom/edit_view', function() {
	global \$router, \$match;
	require 'vendor/miltonian/custom/functions/edit_view.php';
}, \"\");

\$router->map( 'GET', '/login', function() {
	global \$router, \$match;
	require 'views/login.php';
}, \"\");

\$router->map( 'GET', '/logout', function() {
	global \$router, \$match;
	require 'views/logout.php';
}, \"\");

\$router->map( 'GET', '/', function() {
	global \$router, \$match;
	require 'views/home.php';
}, \"\");

\$router->map( 'GET', '/[*:trailing]', function() {
	global \$router, \$match;
	require 'views/' . \$match['params']['trailing'] . '.php';
}, \"\");

\$match = \$router->match();

// call closure or throw 404 status
if( \$match && is_callable( \$match['target'] ) ) {
	call_user_func_array( \$match['target'], \$match['params'] ); 
} else {
	// no route was matched
	header( \$_SERVER[\"SERVER_PROTOCOL\"] . ' 404 Not Found');
}" > index.php;

cd views

touch login.php
touch logout.php

echo "<?php


Reusables\Data::addData( [\"title\"=>\"Login\"], \"loginheader\" );

Reusables\Data::addOption( \"Email\", \"placeholder\", \"loginview\" );
Reusables\Data::addOption( \"admins\", \"tablename\", \"loginview\" );
Reusables\Data::addOption( \"email\", \"username_col\", \"loginview\" );


Reusables\ReusableClasses::startpage( __FILE__ );

echo Reusables\Wrapper::wrapper1(
	[],
	[
		Reusables\Header::make( \"basic\", \"loginheader\" ),
		Reusables\Section::make( \"login\", \"loginview\" )
	],
	\"main_wrapper\"
);


Reusables\ReusableClasses::endpage( \"\", __FILE__ );" > login.php;

echo "<?php

session_start();
\$_SESSION = [];
session_destroy();

header('Location: /' );" > logout.php;

cd ../

cd structure
touch header.php

echo "<?php

session_start();

\$loggedin = false;
if( isset( \$_SESSION['login'][0] ) ) {
	if( \$_SESSION['login'][0] == 1 ) {
		\$loggedin = true;
	}
}

\$editing = false;
if( isset( \$_GET['e'] ) ){ if( \$_GET['e']==1 && \$loggedin ){ \$editing=true; } }

\$editinglink = \"?e=1\";
if( \$editing ) {
	\$editinglink = \"?e=0\";
}
\$adminbardict = [
	\"buttons\" => [
		// [ \"name\" => \"Articles\", \"classname\"=> \"admin_articles_button\", \"slug\"=>\"#\", \"position\"=>\"right\", \"type\"=>\"modal\", \"modal\"=>\"admin_articles\" ],
		[ \"name\" => \"New Post\", \"classname\"=> \"admin_newpost_button\", \"slug\"=>\"\", \"position\"=>\"right\", \"type\"=>\"modal\", \"modal\"=>\"newpost_modal\" ],
		[ \"name\" => \"Edit: On/<b>Off</b>\", \"classname\"=> \"edit_switch\", \"slug\"=>\"\", \"position\"=>\"right\" ],
	]
];

\$allpostsarray = Reusables\CustomData::call( \"Posts\", \"getPosts\", [20] );

Reusables\Data::addData( \$allpostsarray, \"allposts_modal\" );

Reusables\Form::makeInsertOnly( \"posts\", \"newpost_modal\" );
	Reusables\Data::addOption( [\"title\", \"featured_imagepath\"=>[\"labeltext\"=>\"Featured Image\"], \"html_text\"=>[\"labeltext\"=>\"Post Text\", \"type\"=>\"wysi\"]], \"input_keys\", \"newpost_modal\" );


Reusables\Data::addData( \$adminbardict, \"adminbar\" );

	if( \$loggedin ) {
		
		Reusables\Menu::set( \"horizontal\", \"adminbar\" );


	}" > header.php

cd ../

cd vendor/miltonian/custom/data/
touch Posts.php

echo "<?php

require_once 'DBClasses.php';

class Posts {

	public static function getFeaturedContent( \$featuredid, \$multiple=false )
	{
		\$query = 'SELECT * FROM featured_content WHERE featured_id=?';
		\$values = [ \$featuredid ];
		\$type = 'select';
		if( \$multiple ) {
			\$result = DBClasses::querySQL( \$query, \$values, \$type )[1];
		}else{
			\$result = DBClasses::querySQL( \$query, \$values, \$type )[1][0];
		}

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"featured_content\" );

		return \$returningdict;
	}

	public static function getFeaturedPosts( \$featuredid )
	{
		\$query = 'SELECT * FROM featured_content INNER JOIN posts ON featured_content.post_id=posts.id WHERE featured_id=?';
		\$values = [ \$featuredid ];
		\$type = 'select';
		\$result = DBClasses::querySQL( \$query, \$values, \$type )[1];

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"featured_content\" );

		return \$returningdict;
	}

	public static function getPost( \$post_id )
	{
		\$query = 'SELECT * FROM posts WHERE id=?';
		\$values = [ \$post_id ];
		\$type = 'select';
		\$result = DBClasses::querySQL( \$query, \$values, \$type )[1][0];

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"posts\" );

		return \$returningdict;
	}

	public static function getPosts( \$thelimit )
	{
		\$query = 'SELECT * FROM posts WHERE was_deleted=0 ORDER BY id DESC LIMIT ?';
		\$values = [ intval(\$thelimit) ];
		\$type = 'select';
		\$result = DBClasses::querySQL( \$query, \$values, \$type )[1];

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"posts\" );

		return \$returningdict;
	}

	public static function getPostsForBrand( \$brand_id, \$thelimit )
	{
		\$query = 'SELECT * FROM posts WHERE brand=? AND was_deleted=0 ORDER BY id DESC LIMIT ?';
		\$values = [ \$brand_id, intval(\$thelimit) ];
		\$type = 'select';
		\$result = DBClasses::querySQL( \$query, \$values, \$type )[1];

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"posts\" );

		return \$returningdict;
	}

	public static function getPodcasts( \$thelimit )
	{
		\$query = 'SELECT * FROM posts WHERE type=\"podcast\" AND was_deleted=0 ORDER BY id DESC LIMIT ?';
		\$values = [ intval(\$thelimit) ];
		\$type = 'select';
		\$result = DBClasses::querySQL( \$query, \$values, \$type )[1];

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"posts\" );

		return \$returningdict;
	}

	public static function getTempAds()
	{
		\$query = 'SELECT * FROM tempads';
		\$values = [];
		\$type = 'select';
		\$result = DBClasses::querySQL( \$query, \$values, \$type )[1];

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"tempads\" );

		return \$returningdict;
	}

	public static function getCustomDataParams( \$customparamclassid )
	{
		\$query = 'SELECT * FROM customdata_params WHERE custom_param_classid=?';
		\$values = [ \$customparamclassid ];
		\$type = 'select';
		\$result = DBClasses::querySQL( \$query, \$values, \$type )[1];

		\$conditions = [[ \"key\"=>\"id\", \"value\"=>\"\" ]];
		\$returningdict = Reusables\ReusableClasses::toValueAndDBInfo( \$result, \$conditions, \"customdata_params\" );

		return \$returningdict;
	}

}" > Posts.php

cd ../../../../

cd views
touch home.php
echo "<?php 

require_once( BASE_DIR . '/structure/header.php' );

Reusables\ReusableClasses::testReusables();

" > home.php

cd ../vendor/miltonian/custom/css/pages
touch header.css
echo "

body { margin: 0; padding: 0; }

" > header.css


cd ../../../../../

























		
fi