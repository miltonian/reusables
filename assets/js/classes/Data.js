if ( typeof DataClasses !== 'function' )
{

  var alldata = [];

  class DataClasses {


      add(data, identifier)
      {

        var data = data
        if (Array.isArray(data) == false) {
            // data = Data.get(data);
        }
        if (data == null) {
            data = Data.get(identifier)
        }
        if ( data == null ) {
            data = []
        }


        data['data_id'] = identifier
        alldata[ identifier ] = data;

        Views.addView(identifier);
      }

      get(identifier)
      {
          if (Array.isArray(identifier)) {
              return null;
          }
          if( !alldata ) {
            return null;
          }
          if ( typeof alldata[ identifier ] === 'undefined' ) {
              return null;
          } else {
              return alldata[ identifier ];
          }
      }

      getDefaultTableNameWithID(identifier, key="")
      {
          data = Data.get(identifier);
          if (typeof data['db_info'] === 'undefined') {
              return "";
          }
          var tablenames = data['db_info']['tablenames'];

          if ( typeof tablenames[key] !== 'undefined') {
              if (tablenames[key] != "") {
                  return tablenames[key];
              }
          }
          var allkeys = array_keys(tablenames);
          return tablenames[allkeys[0]];
      }

      getValue(dict, key=-1, identifier="")
      {
          if ( typeof dict === 'string' ) {
              return dict;
          }

          // if (!is_array($dict)) {
          //     dict = Data.get(dict);
          // }

          if (key == -1) {
              var allkeys = arrayKeys(dict);
              var thevalue = {};
              for(var key in allkeys) {
                  var keyvalue = Data.getValue(dict, key);
                  thevalue[key] = keyvalue;
              }
              return thevalue;
          } else if (typeof dict[ key ] !== 'undefined' ) {
              var pair = dict[ key ];
          } else {
            console.log("key: "+JSON.stringify(key))
            console.log("dict[key]: "+JSON.stringify(dict[key]))
            console.log("dict: "+JSON.stringify(dict))
              if ( typeof dict['value'][ key ] !== 'undefined' ) {
                  var pair = dict['value'][ key ];
              } else {
                  var tablename = "";

                  if (typeof dict['db_info'] !== 'undefined' ) {
                      if (typeof dict['db_info']['tablenames'] !== 'undefined' ) {
                          var firstkey = Data.arrayKeys(dict['db_info']['tablenames'])[0];
                          tablename = dict['db_info']['tablenames'][firstkey];
                      }
                  } else {
                      if (typeof dict['data_id'] !== 'undefined' ) {
                          var info = Info.get(dict['data_id']);
                          if (info['viewtype'].toLowerCase() == "cell") {
                              var cellindex = Data.getValue(dict, 'index');
                              var table_identifier = Data.replaceAll(dict['data_id'], "_cell_".$cellindex, "");
                              tablename = Data.getDefaultTableNameWithID(table_identifier);
                          }
                      } else if (identifier != "") {
                          $info = Info.get(identifier);

                          if (strtolower(info['viewtype']) == "cell") {
                              var cellindex = Data.getValue(dict, 'index');
                              var table_identifier = Data.replaceAll(identifier, "_cell_".$cellindex, "");
                              tablename = Data.getDefaultTableNameWithID(table_identifier);
                          } else {
                              tablename = Data.getDefaultTableNameWithID(identifier);
                          }
                      }
                  }

                  if (tablename != "") {
                      key = tablename+"."+$key;
                      if (typeof dict[ key ] !== 'undefined') {
                          var pair = dict[ key ];
                      } else if (typeof dict['value'][ key ] !== 'undefined') {
                          var pair = dict['value'][ key ];
                      } else if (typeof dict['value'] !== 'undefined') {
                        if( typeof dict['value'][0] !== 'undefined' ) {
                          if( typeof dict['value'][0][key] !== 'undefined' ) {
                            return pair = dict['value'][0][key];
                          }else {
                            return "";
                          }
                        }else {
                          return "";
                        }
                      } else {
                          return "";
                      }
                  } else {
                      return "";
                  }
              }
          }

          var hasindex = false;
          if ( typeof pair['data_id'] === 'undefined') {
              return pair;
          }
          if (typeof pair['key'] === 'undefined') {
              return pair;
          }
          if ( typeof pair['index'] !== 'undefined') {
              hasindex = true;
          }

          if (hasindex) {
              var thevalue = Data.get(pair['data_id']);
              if (thevalue) {
                  thevalue = thevalue['value'][ pair['index'] ][ pair['key'] ];
              } else {
                  thevalue = "";
              }
          } else {
              var thevalue = Data.get(pair['data_id']);

              if (thevalue) {
                  thevalue = thevalue['value'][ pair['key'] ];
              } else {
                  thevalue = "";
              }
          }

          if (thevalue == null) {
              thevalue = "";
          }

          // Form::addDefaultInputKeys($key, $identifier);

          return thevalue;
      }



      getFullArray(viewdict)
      {
          // if (!is_array(viewdict)) {
              // viewdict = Data::get(viewdict);
          // }

          var allkeys = Data.arrayKeys(viewdict);
          var dataidarray = {};

          var dataid = false;
          if (typeof viewdict['index'] !== 'undefined' ) {

              if (typeof viewdict['index'] !== 'undefined' ) {
                  if ( typeof viewdict[allkeys[0]]['data_id'] !== 'undefined' ) {
                      dataid = viewdict[allkeys[0]]['data_id'];
                  }
              } else {
                  if ( typeof viewdict['data_id'] !== 'undefined' ) {
                      dataid = viewdict['data_id'];
                  }
              }
          } else {
              if ( typeof viewdict['data_id'] !== 'undefined' ) {
                  dataid = viewdict['data_id'];
              }
          }

          if (dataid) {
              if (dataid) {
                  if (dataid != null) {
                      if ( typeof dataidarray[ dataid ] === 'undefined' ) {
                          dataidarray[ dataid ] = Data.get(dataid);
                      }
                  }
              }
          } else {
              for (var k in allkeys) {
              // allkeys.forEach(function(k) {
                  dataid=null;
                  if ( typeof viewdict[k]['data_id'] !== 'undefined' ) {
                      dataid = viewdict[k]['data_id'];
                  }

                  if (dataid) {
                      if (dataid != null) {
                          if ( typeof dataidarray[ dataid ] === 'undefined' ) {
                              dataidarray[ dataid ] = Data.get(dataid);
                          }
                      }
                  }
              }
          }




          return dataidarray;
      }

      arrayKeys(input) {
          var output = new Array();
          var counter = 0;
          for (var i in input) {
          // console.log(JSON.stringify(input.length))
          // for( var index=0; index<input.length; index++ ) {
              // var i = input[index];
              output[counter++] = i;
          }
          return output;
      }





      makeViewEditing(viewdict, viewoptions, identifier, e, view, alwayseditable=false)
      {
          // get the unformatted array for the view
          var fullarray = Data.getFullArray(viewdict);

          // if the unformatted array is inside a value key pair then get it from that instead
          if ( typeof viewdict[identifier] == 'undefined' ) {
              var fullviewdict = viewdict;
          } else if ( typeof viewdict[identifier]['value'] !== 'undefined' ) {
              var fullviewdict = Data.getFullArray(viewdict)[identifier]['value'];
          } else {
              var fullviewdict = viewdict;
          }

          // get the type of editing this is
          // e.g. modal, dropdown, etc
          var type = Data.getValue(viewoptions, 'type');

          // initialize modalclass
        	// var thismodalclass = '';";

          // check if this is a modal type

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
          if (type == "modal" && typeof viewoptions['modal']['modalclass'] !== 'undefined' ) {
              // initialize modalclass for this view and convert php full array to js full array var
              // thismodalclass = new " . $viewoptions['modal']['modalclass'] . "Classes();
              var thismodalclass = modalclasses[identifier];
          		var dataarray = fullviewdict;
          }

          var optiontype = type;

          // get form identifier (which is just the view identifier + _form)
          var formid = identifier + "_form";

          console.log("optiontype: "+JSON.stringify(optiontype))
          // get options for the view's form
          var formviewoptions = Options.get(formid);

          // check to see if type is modal or dropdown
        	if( optiontype == 'modal' || optiontype == 'dropdown' ) {
        		e.preventDefault();

            // define dataarray var if undefined
        		if( typeof dataarray === 'undefined' ) {
        			dataarray = []
        		}

        		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, view, e, viewoptions, formviewoptions, identifier );
        	}

          Editing.getEditingFunctionsJS(viewoptions) ;
      }

      escapeRegExp(str) {
          return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
      }

      replaceAll(str, find, replace) {
          return str.replace(new RegExp(Data.escapeRegExp(find), 'g'), replace);
      }


    }

	var Data = new DataClasses();
}
