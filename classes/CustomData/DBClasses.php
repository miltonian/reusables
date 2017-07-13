<?php

namespace Reusables\CustomData;

require_once( 'db_pdo.php' );

class DBClasses {

	public $PDO; // PHP Data Object

	public function __construct() 
	{
		$odp = new db_pdo();
		$this->PDO = $odp->PDO_Return();
	}

	public static function example()
	{
		$DBClasses = new DBClasses();
		$query = "SELECT * FROM posts WHERE id > ?";
		$values = [ 0 ];
		$type = "select";
		$result = $DBClasses->querySQL( $query, $values, $type );

		return $result;
	}

	// public static function standardquery( $pararameters )
	// {
	// 	$DBClasses = new DBClasses();
	// 	$query = "SELECT * FROM posts WHERE id > ?";
	// 	$values = [ $parameters ];
	// 	$type = "select";
	// 	$result = $DBClasses->querySQL( $query, $values, $type );

	// 	return $result;
	// }

	public function querySQL( $query, $values, $type )
	{
		$Q = $this->PDO->prepare($query);
		for($i=0;$i<sizeof($values);$i++){
			if(is_int($values[$i])){
				$Q->bindValue( $i+1, $values[$i], \PDO::PARAM_INT );
			}else{
				$Q->bindValue( $i+1, $values[$i], \PDO::PARAM_STR );
			}
		}
		$Q->execute();
		if( $Q->rowCount() > 0 )
		{
			$returnvalue = "Success";
			if(strtolower($type)=="select"){
				$returnvalue = $Q->fetchAll( \PDO::FETCH_ASSOC );
			}else if(strtolower($type)=="insert"){
				$returnvalue = $this->PDO->lastInsertId();
			}
			return( array( 1, $returnvalue ) );
		}
		else
		{
			$returnvalue = "Failure";
			if($type=="select"){
				$returnvalue = array();
			}else if($type=="insert"){
				$returnvalue = "0";
			}
			return( array( 0, $returnvalue ) );
		}
	}

	public function __destruct()
	{
		if( isset( $this->PDO ) ) unset( $this->PDO );
		if( isset( $this->cryptKey ) ) unset( $this->cryptKey );
	}

}