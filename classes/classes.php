<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */


require_once( 'db_pdo.php' ); // Class that returns configured PHP Data Objects

class ReusableClasses {
	
	public $PDO; // PHP Data Object
	//public static $PDO;
	private $cryptKey = "Rxp45dn142etvQk9e17Oo3nx2xJKfkZs"; // Encryption Key
	
	public function __construct() 
	{
		$odp = new Reusables_db_pdo();
		$this->PDO = $odp->PDO_Return();
	}
	
	public function getProduct( $productid )
	{
		
		$Q = $this->PDO->prepare('
			SELECT *
			FROM products
			WHERE id = ?
		');
		$Q->bindValue( 1, $productid, PDO::PARAM_STR );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetch( PDO::FETCH_ASSOC );
			//$lastid = $this->PDO->lastInsertId();
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
		
	}

	public function getNavWebPages( $domainid )
	{
		
		$Q = $this->PDO->prepare('
			SELECT *
			FROM web_pages
			WHERE domain_id = ? AND in_menu="1"
		');
		$Q->bindValue( 1, $domainid, PDO::PARAM_STR );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			//$lastid = $this->PDO->lastInsertId();
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
		
	}

	public function getReusableObjects( $productobjectsid )
	{
		$Q = $this->PDO->prepare('
			SELECT reusables_content.*, reusable_objects.num_of_images, reusable_objects.position, posts.*
			FROM reusable_objects
			INNER JOIN product_objects
			ON reusable_objects.id=product_objects.reusable_object_id AND product_objects.id=?
			INNER JOIN reusables_content
			ON product_objects.id=reusables_content.product_object_id
			LEFT JOIN posts
			ON reusables_content.post_id=posts.id
			ORDER BY reusables_content.the_order
		');
		$Q->bindValue( 1, $productobjectsid, PDO::PARAM_STR );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			//$lastid = $this->PDO->lastInsertId();
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
	}
	public function getReusableObjectTextValues( $productobjectsid )
	{
		$Q = $this->PDO->prepare('
			SELECT reusables_content.*, reusable_objects.num_of_images, reusable_objects.position
			FROM reusable_objects
			INNER JOIN product_objects
			ON reusable_objects.id=product_objects.reusable_object_id AND product_objects.id=?
			INNER JOIN reusables_content
			ON product_objects.id=reusables_content.product_object_id AND reusables_content.textvalue!=""
			ORDER BY reusables_content.the_order
		');
		$Q->bindValue( 1, $productobjectsid, PDO::PARAM_STR );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			//$lastid = $this->PDO->lastInsertId();
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
	}
	public function getReusableObjectImages( $productobjectsid )
	{
		$Q = $this->PDO->prepare('
			SELECT reusables_content.*, reusable_objects.num_of_images, reusable_objects.position
			FROM reusable_objects
			INNER JOIN product_objects
			ON reusable_objects.id=product_objects.reusable_object_id AND product_objects.id=?
			INNER JOIN reusables_content
			ON product_objects.id=reusables_content.product_object_id AND reusables_content.imagepath!=""
			ORDER BY reusables_content.the_order
		');
		$Q->bindValue( 1, $productobjectsid, PDO::PARAM_STR );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			//$lastid = $this->PDO->lastInsertId();
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
	}
	public function getReusableObjectCSSValues( $productobjectsid )
	{
		$Q = $this->PDO->prepare('
			SELECT reusables_content.*, reusable_objects.num_of_images, reusable_objects.position
			FROM reusable_objects
			INNER JOIN product_objects
			ON reusable_objects.id=product_objects.reusable_object_id AND product_objects.id=?
			INNER JOIN reusables_content
			ON product_objects.id=reusables_content.product_object_id AND reusables_content.css_attr!=""
			ORDER BY reusables_content.the_order
		');
		$Q->bindValue( 1, $productobjectsid, PDO::PARAM_STR );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			//$lastid = $this->PDO->lastInsertId();
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
	}

	public function getPostsAfterWithLimit( $productobjectsid, $afterthisid, $limit )
	{
		$Q = $this->PDO->prepare('
			SELECT *
			FROM posts
			WHERE id > ? AND scheduled<? AND type!=? AND brand=0 AND product_object_id=?
			ORDER BY date_made DESC, id DESC
			LIMIT ?
		');
		$Q->bindValue( 1, $afterthisid, PDO::PARAM_INT );
		$Q->bindValue( 2, time(), PDO::PARAM_INT );
		$Q->bindValue( 3, "podcast", PDO::PARAM_STR );
		$Q->bindValue( 4, $productobjectsid, PDO::PARAM_INT );
		$Q->bindValue( 5, $limit, PDO::PARAM_INT );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
		
	}

	public function getPostsBeforeWithLimit( $beforethisid, $productobjectsid, $limit )
	{
		
		$Q = $this->PDO->prepare('
			SELECT *
			FROM posts
			WHERE id < ? AND scheduled<? AND type!=? AND brand=0 AND product_object_id=?
			ORDER BY date_made DESC, id DESC
			LIMIT ?
		');
		$Q->bindValue( 1, $beforethisid, PDO::PARAM_INT );
		$Q->bindValue( 2, time(), PDO::PARAM_INT );
		$Q->bindValue( 3, "podcast", PDO::PARAM_STR );
		$Q->bindValue( 4, $productobjectsid, PDO::PARAM_INT );
		$Q->bindValue( 5, $limit, PDO::PARAM_INT );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
		
	}

	public function getPostsOnlyArticles($productobjectsid)
	{
		
		$Q = $this->PDO->prepare('
			SELECT *
			FROM posts
			WHERE scheduled<? AND type != "podcast" AND featured_imagepath!="" AND type!="youtube" AND type!="video" AND brand=0 AND product_object_id=?
			ORDER BY id DESC
		');
		//$Q->bindValue( 1, $title, PDO::PARAM_STR );
		$Q->bindValue( 1, time(), PDO::PARAM_INT );
		$Q->bindValue( 2, $productobjectsid, PDO::PARAM_STR );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
		
	}

	public function randomizearrayof20($fullarray, $themax){
		$thearray = array(1,2,3);
		$newarray = array();
		//$themax = 20;
		if(sizeof($fullarray)<$themax){
			$themax = sizeof($fullarray);
		}
		for($i=0;$i<$themax;$i++){
			shuffle($fullarray);
			$thetime = $fullarray[0]['date_made'];
			$dt = new DateTime("@$thetime");
			$fullarray[0]['formatted_date'] = $dt->format('M d, Y');
			array_push($newarray,$fullarray[0]);
			array_shift($fullarray);
		}
		//array_shift($thearray);
		//exit(json_encode($newarray));
		return $newarray;
	}

	public function get2PodcastsAfter( $afterthisid, $lasttime )
	{
		
		$Q = $this->PDO->prepare('
			SELECT *
			FROM posts
			WHERE id > ? AND scheduled<? AND type=? AND scheduled>? AND brand=0
			ORDER BY date_made DESC, id DESC
			LIMIT 2
		');
		$Q->bindValue( 1, $afterthisid, PDO::PARAM_INT );
		$Q->bindValue( 2, time(), PDO::PARAM_INT );
		$Q->bindValue( 3, "podcast", PDO::PARAM_STR );
		$Q->bindValue( 4, $lasttime, PDO::PARAM_INT );
		$Q->execute();
		
		if( $Q->rowCount() > 0 )
		{
			$R = $Q->fetchAll( PDO::FETCH_ASSOC );
			return( array( 1, $R ) );
		}
		else
		{
			return( array( 0, array() ) );
		}
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