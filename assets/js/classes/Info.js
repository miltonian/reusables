if ( typeof InfoClasses !== 'function' )
{

  var allinfo = [];
  class InfoClasses {


    add(data, key, identifier)
    {
      var data = data

      if( typeof allinfo[identifier] === 'undefined' ) {
          allinfo[identifier] = [];
      }
      if( allinfo[identifier] == null ) {
          allinfo[identifier] = [];
      }

      allinfo[ identifier ][ key ] = data;

    }

    addInfoDict(data, identifier)
  	{

        if( typeof allinfo[identifier] === 'undefined' ) {
            allinfo[identifier] = [];
        }
        if( allinfo[identifier] == null ) {
            allinfo[identifier] = [];
        }

  			// data['data_id'] = identifier
        allinfo[ identifier ] = data;
  	}

    get(identifier)
    {

      if (Array.isArray(identifier)) {
          return null;
      }
      if( !allinfo ) {
        return null;
      }
      if ( typeof allinfo[ identifier ] === 'undefined' ) {
          return null;
      } else {
          return allinfo[ identifier ];
      }
    }








  }
  var Info = new InfoClasses();
}
