<?php

namespace Reusables;

if( !defined( 'PROJECT_ROOT' ) ){
	define( 'PROJECT_ROOT', "" );
}

class Options {

	protected static $alloptions = [];

	public static function get($identifier)
	{
		if (is_array($identifier)) {
			return null;
		}
		if (!isset(Options::$alloptions[ $identifier ])) {
			return null;
		} else {
			return Options::$alloptions[ $identifier ];
		}
	}

	public static function add($data, $key, $identifier)
	{
			if (!isset(Options::$alloptions[ $identifier ])) {
					Options::$alloptions[ $identifier ] = [];
			}
			if ($key == "input_keys") {
					if (isset(Options::$alloptions[ $identifier ][ $key ])) {
							$arr = Options::$alloptions[ $identifier ][ $key ];
							$data = array_merge($arr, $data);
					}
			}
			Options::$alloptions[ $identifier ][ $key ] = $data;
	}

	public static function addOptions($data, $identifier)
	{
			if (!isset(Options::$alloptions[ $identifier ])) {
					Options::$alloptions[ $identifier ] = $data;
			}
	}

  public static function makeCellEditing( $identifier, $fullviewdict, $celltype ) {

    $viewdict = Data::get( $identifier );
    $viewoptions = Options::get( $identifier );


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

		if( $optiontype == "options_modal" && isset($viewoptions['options_modal']['modalclass']) ){
			// extract( Input::convertInputKeys( $identifier . "_form" ));
			// 	echo ' ' . Form::addJSClassToForm( $identifier . "_form", $viewdict, $input_onlykeys, $identifier . "_form" ) . '; ';
			// 	echo " /*asdf*/ ";
			echo "thismodalclass = new " . $viewoptions['options_modal']['modalclass'] . "Classes();
			if( typeof optionmodalclasses === 'undefined' ) {
				optionmodalclasses = {};
			}
			optionmodalclasses['".$identifier."'] = thismodalclass;
			console.log('optionmodalclasses: '+JSON.stringify(optionmodalclasses))
			var dataarray = " . json_encode( $fullviewdict ) . ";";
		}
		echo "
		var optiontype = " . json_encode($optiontype) . ";";
		$formid = $identifier . "_options_form";
		$formviewoptions = Options::get($formid);
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

		Editing::getEditingFunctionsJS( $viewoptions, true ) ;
	}

}
