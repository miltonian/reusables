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

    viewtype(identifier)
    {
        var info = Info.get(identifier);
        return info['viewtype'];
    }

    viewtype_base(identifier)
    {
      return Info.basename((Info.viewtype(identifier)).toLowerCase());
    }

    input_onlykeys(identifier)
    {
      var info = Info.get(identifier);
      if( info != null ) {
        if( typeof info['input_onlykeys'] !== 'undefined' ) {
          return info['input_onlykeys'];
        }
      }
      return []
    }

    file_name(identifier)
    {

        info = Info.get(identifier);

        return info['file'];
    }

    basename(path)
    {
      return path.replace(/.*\//, '');
    }








  }
  var Info = new InfoClasses();
}
