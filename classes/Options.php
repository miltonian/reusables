<?php

namespace Reusables;

if( !defined( 'PROJECT_ROOT' ) ){
	define( 'PROJECT_ROOT', "" );
}

class Options {

  public static function makeCellEditing( $identifier, $fullviewdict, $celltype ) {

    $viewdict = Data::retrieveDataWithID( $identifier );
    $viewoptions = Data::retrieveOptionsWithID( $identifier );


  }

  public static function makeViewEditing( $viewdict, $viewoptions, $identifier, $alwayseditable=false )
	{


	}

}
