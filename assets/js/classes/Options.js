if ( typeof OptionsClasses !== 'function' )
{

  var alloptions = [];

  class OptionsClasses {


    add(data, key, identifier)
    {
      var data = data

      if( typeof alloptions[identifier] === 'undefined' ) {
          alloptions[identifier] = [];
      }
      if( alloptions[identifier] == null ) {
          alloptions[identifier] = [];
      }

      alloptions[ identifier ][ key ] = data;

      // Views.addView(identifier);
    }

    addOptions(data, identifier)
  	{
        if( typeof alloptions[identifier] === 'undefined' ) {
            alloptions[identifier] = [];
        }
        if( alloptions[identifier] == null ) {
            alloptions[identifier] = [];
        }

  			// data['data_id'] = identifier
        alloptions[ identifier ] = data;
  	}

    get(identifier)
    {
        if (Array.isArray(identifier)) {
            return null;
        }
        if( !alloptions ) {
          return null;
        }
        if ( typeof alloptions[ identifier ] === 'undefined' ) {
            return null;
        } else {
            return alloptions[ identifier ];
        }
    }



    makeViewEditing( viewdict, viewoptions, identifier, e, view, alwayseditable=false )
    {

      var fullarray = Data.getFullArray( viewdict );

      if( typeof viewdict[identifier] !== 'undefined' ) {
        if( typeof viewdict[identifier]['value'] !== 'undefined' ) {
          var fullviewdict = Data.getFullArray( viewdict )[identifier]['value'];
        } else {
          var fullviewdict = Data.getFullArray( viewdict )[identifier];
        }
      }else{
        var fullviewdict = viewdict;
      }

      var thismodalclass = '';


      if( typeof viewoptions['modal']['modalclass'] === 'undefined' && typeof viewoptions['modal'] !== 'undefined' ) {
        var modal = viewoptions['modal'];
        viewoptions['modal'] = {}
        viewoptions['modal']['modalclass'] = modal
        viewoptions['modal']['parentclass'] = modal + "_wrapper"
      }

      if( typeof viewoptions['options_modal'] !== 'undefined' ) {
        if( typeof viewoptions['options_modal']['modalclass'] === 'undefined' && typeof viewoptions['options_modal'] !== 'undefined' ) {

          var modal = viewoptions['options_modal'];
          viewoptions['options_modal'] = {}
          viewoptions['options_type'] = "options_modal"
          viewoptions['options_modal']['modalclass'] = modal
          viewoptions['options_modal']['parentclass'] = modal + "_wrapper"
        }
      }

      var optiontype = Data.getValue( viewoptions, 'options_type' );
      var type = optiontype;

      if (type == "options_modal" && typeof viewoptions['options_modal']['modalclass'] !== 'undefined' ) {
          // initialize modalclass for this view and convert php full array to js full array var
          // thismodalclass = new " . $viewoptions['modal']['modalclass'] . "Classes();
          var thismodalclass = optionmodalclasses[identifier];
          var dataarray = fullviewdict;
      }


      var formid = identifier + "_options_form";
      var formviewoptions = Options.get(formid);


      if( optiontype == 'options_modal' || optiontype == 'dropdown' ) {
        e.preventDefault();
        if( typeof dataarray === 'undefined' ) {
          dataarray = []
        }

        Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, view, e, viewoptions, formviewoptions, identifier, true );
      }

      Editing.getEditingFunctionsJS( viewoptions, true ) ;
    }












  }

	var Options = new OptionsClasses();
}
