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

    $fullarray = Data::getFullArray( $viewdict );
		if( isset( $viewdict[$identifier]['value'] ) ) {
			$fullviewdict = Data::getFullArray( $viewdict )[$identifier]['value'];
		}else{
			$fullviewdict = $viewdict;
		}

		$optiontype = Data::getValue( $viewoptions, 'options_type' );

		echo "var viewdict = " . json_encode( $viewdict ) . ";
		var viewoptions = " . json_encode( $viewoptions ) . ";

		var thismodalclass = '';

		var type = " . json_encode( $optiontype ) . ";";
		echo "console.log( JSON.stringify( ".json_encode( $optiontype )." ) );";

		if( $optiontype == "options_modal" && isset($viewoptions['options_modal']['modalclass']) ){
			// extract( Input::convertInputKeys( $identifier . "_form" ));
			// 	echo ' ' . Form::addJSClassToForm( $identifier . "_form", $viewdict, $input_onlykeys, $identifier . "_form" ) . '; ';
			// 	echo " /*asdf*/ ";
			echo "thismodalclass = new " . $viewoptions['options_modal']['modalclass'] . "Classes();
			var dataarray = " . json_encode( $fullviewdict ) . ";";
		}
		echo "
		var optiontype = " . json_encode($optiontype) . ";";
		$formid = $identifier . "_options_form";
		$formviewoptions = Data::retrieveOptionsWithID($formid);
		echo '
		var formviewoptions = ' . json_encode( $formviewoptions ) . ";
		var identifier = " . json_encode( $identifier ) . ";

		if( optiontype == 'options_modal' || optiontype == 'dropdown' ) {
			e.preventDefault();
			if( typeof dataarray === 'undefined' ) {
				dataarray = []
			}

			Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions, formviewoptions, identifier, true );
		}";

		ReusableClasses::getEditingFunctionsJS( $viewoptions, true ) ;
	}

}
