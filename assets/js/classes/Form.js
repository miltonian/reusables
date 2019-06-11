if ( typeof FormClasses !== 'function' )
{


  class FormClasses {

    // when a view is clicked on (with editing triggered), this function: populateview() is called
    // the index will be null if there is only one view
    // the index will not be null if there is more than one view in the row

    getTypeArray(input_onlykeys, multiple_updates=false)
    {
        typearray = [];

        var i=0;
        for (var k in input_onlykeys) {
            if (k == "download_script") {
                // array_push(typearray, 'copybutton_1');
                typearray.push("copybutton_1");
            } else {
                if (multiple_updates) {
                    typearray = Input.getInputTypes();
                    break;
                } else {
                    var inputtype = Input.getInputType(k);
                    // array_push(typearray, inputtype);
                    typearray.push(inputtype)
                }
            }
            i = i+5;
        }

        return typearray;
    }

    populateviewGlobalFunc( identifier, index=null ) {


      var viewdict = Data.get(identifier);
      var viewoptions = Options.get(identifier);
      var input_onlykeys = Info.input_onlykeys(identifier);
      var original_data_id = identifier;


      // convert ifnone_insert option into a boolean
      // (ifnone_insert option is to insert a value if nothing exists already)
      if ( typeof viewoptions['ifnone_insert'] === 'undefined' ) {
          var ifnone_insert = false;
      } else {
          var ifnone_insert = viewoptions['ifnone_insert'];
      }

      // convert multiple_inserts option into a boolean
      if (typeof viewoptions['multiple_inserts'] === 'undefined' ) {
          var multiple_inserts = false;
      } else {
          var multiple_inserts = viewoptions['multiple_inserts'];
      }

      // convert multiple_updates option into a boolean
      if (typeof viewoptions['multiple_updates'] === 'undefined' ) {
          var multiple_updates = false;
      } else {
          var multiple_updates = viewoptions['multiple_updates'];
      }

      // use passed formaction or default
      if ( typeof viewoptions['formaction'] === 'undefined' ) {
          // default
          var formaction = '/edit_view.php';
      } else {
          // custom
          var formaction = viewoptions['formaction'];
      }

      // remove formtitle if it exists
      if ( typeof viewdict['formtitle'] !== 'undefined' ) {
          // unset(viewdict['formtitle']);
      }

      // default to step 1
      var steps = 1;
      var onstep = 1;


    if (steps == onstep) {

      var input_keys = input_onlykeys;
      var typearray = Form.getTypeArray(input_onlykeys);
      var dataarray = Data.getFullArray(viewdict);
      var formatteddata = Data.get(original_data_id);








var connected_identifier = identifier.replace("_options_form", "");
connected_identifier = connected_identifier.replace("_form", "");


        // add insert_values to a variable
        var insert_values = [];
        if ( typeof viewoptions['insert_values'] !== 'undefined' ) {
            insert_values = viewoptions["insert_values"];
        }

    /* if option form, go through a list of options and perform the corresponding javascript */
    if( typeof viewoptions['is_option_form'] !== 'undefined'  ) {
      if( viewoptions['is_option_form'] == "1" ) {

        $('.'+identifier+' input[type="text"]').on('input', function() {


          var input_class = $(this).parent().attr("class");

          var viewtype_base = Info.viewtype_base(connected_identifier);
          var file_name = Info.file_name(connected_identifier);


          var container_class = "."+connected_identifier+".viewtype_"+viewtype_base+"."+file_name+".main";
          var inner_class = "."+file_name+".inner ";

          // container spacing
          if( input_class.includes('padding') ) {
            $('body').append( '<style> '+container_class+' { padding: '+$(this).val()+' !important; width: calc(100% - '+$(container_class).css("margin-left")+' - '+$(container_class).css("margin-left")+' - '+($(this).val()*2)+'px) !important; } </style>' );
          } else if( input_class.includes('margin') ) {
            $('body').append( '<style> '+container_class+' { margin: '+$(this).val()+' !important; width: calc(100% - '+$(container_class).css("padding-left")+' - '+$(container_class).css("padding-left")+' - '+($(this).val()*2)+'px) !important; } </style>' );
          }

          // text sizes
          if( input_class.includes('_title') && input_class.includes('size') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.title { font-size: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('subtitle') && input_class.includes('size') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.subtitle { font-size: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('description') && input_class.includes('size') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.description { font-size: '+$(this).val()+' !important;  } </style>' );
          }

          // image sizes
          if( input_class.includes('_image') && input_class.includes('_size') ) {
            $('body').append( '<style> '+container_class+' '+inner_class+' { background-size: '+$(this).val()+' !important;  } </style>' );
          }

          // corder radii
          if( input_class.includes('_image') && input_class.includes('corner_radius') ) {
            $('body').append( '<style> '+container_class+' '+inner_class+'.image { border-radius: '+$(this).val()+' !important;  } </style>' );
          }

          // text colors
          if( input_class.includes('_text') && input_class.includes('color') ) {
            $('body').append( '<style> '+container_class+' .content_container { color: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('_title') && input_class.includes('color') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.title { color: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('subtitle') && input_class.includes('color') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.subtitle { color: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('description') && input_class.includes('color') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.description { color: '+$(this).val()+' !important;  } </style>' );
          }

          // background colors
          if( input_class.includes('_background') && input_class.includes('color') ) {
            $('body').append( '<style> '+container_class+' { background-color: '+$(this).val()+' !important;  } </style>' );
          }

          // text alignment
          if( input_class.includes('_text') && input_class.includes('align') ) {
            $('body').append( '<style> '+container_class+' '+inner_class+' { text-align: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('_title') && input_class.includes('align') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.title { text-align: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('subtitle') && input_class.includes('align') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.subtitle { text-align: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('description') && input_class.includes('align') ) {
            $('body').append( '<style> '+container_class+' .'+file_name+'.description { text-align: '+$(this).val()+' !important;  } </style>' );
          }

          // text spacing
          if( input_class.includes('_text') && input_class.includes('offset_x') ) {
            $('body').append( '<style> '+container_class+' .content_container { margin-left: '+$(this).val()+' !important;  } </style>' );
          } else if( input_class.includes('_text') && input_class.includes('offset_y') ) {
            $('body').append( '<style> '+container_class+' .content_container { margin-top: '+$(this).val()+' !important;  } </style>' );
          }

          // overlays
          if( input_class.includes('overlay') ) {
            if( $(this).val() == '1' || $(this).val() == 'true' ) {
              $('body').append( '<style> '+container_class+' .overlay { display: inline-block !important;  } </style>' );
            } else if( $(this).val() == '0' || $(this).val() == 'false' ) {
              $('body').append( '<style> '+container_class+' .overlay { display: none !important;  } </style>' );
            }
          }

          // reversing
          if( input_class.includes('reverse') ) {
            if( $(this).val() == '1' || $(this).val() == 'true' ) {
              $('body').append( '<style> '+container_class+' .'+file_name+'.reversed { display: inline-block !important;  } </style>' );
              $('body').append( '<style> '+container_class+' .'+file_name+'.not_reversed { display: none !important;  } </style>' );
            } else if( $(this).val() == '0' || $(this).val() == 'false' ) {
              $('body').append( '<style> '+container_class+' .'+file_name+'.reversed { display: none !important;  } </style>' );
              $('body').append( '<style> '+container_class+' .'+file_name+'.not_reversed { display: inline-block !important;  } </style>' );
            }
          }

          // height
          if( input_class.includes('height') ) {
            $('body').append( '<style> '+container_class+' '+inner_class+' { height: '+$(this).val()+' !important;  } </style>' );
          }

        });

        $('.'+identifier+' select').change(function () {

          var connected_identifier = identifier.replace("_options_form", "");

          var input_class = $(this).parent().attr("class");

          var viewtype_base = Info.viewtype_base(connected_identifier);
          var file_name = Info.file_name(connected_identifier);

          var container_class = "."+connected_identifier+".viewtype_"+viewtype_base+"."+file_name+".main";
          var inner_class = "."+file_name+".inner ";

            if( input_class.includes('view') ) {
              console.log("getting code for: "+JSON.stringify($(this).val()))
              var view_path = $(this).val();
              var viewdata = Data.get(connected_identifier);
              var viewoptions = Options.get(connected_identifier);
              var viewinfo = Info.get(connected_identifier);
              var unformatteddata = Data.getUnformatted(connected_identifier);
              $.post("/vendor/miltonion/reusables/functions/get_view_code.php?view_path="+view_path+"&identifier="+connected_identifier+"&data="+viewdata+"&options="+viewoptions+"&unformatteddata="+unformatteddata,
              {
                view_path: view_path,
                identifier: connected_identifier,
                data: viewdata,
                options: viewoptions,
                unformatteddata: unformatteddata
              },
              function(data, status){

                var view_paths = view_path.split("/");

                var viewtype = "";
                var file = "";
                if( view_paths[0] == "custom" ) {
                    viewtype = view_paths[0] + "/" + view_paths[1];
                    file = view_paths[2];
                } else {
                  viewtype = view_paths[0];
                  file = view_paths[1];
                }

                Info.add(viewtype, "viewtype", connected_identifier)
                Info.add(file, "file", connected_identifier)
                $('.'+connected_identifier).replaceWith(data)
              });
            }
        });
      }

  }


      var newinput_keys = [];
      var newtypearray = [];
      var newinsertvalues = [];

      // get an array of the inputs associated types (e.g. textfield, textarea, select, etc.)
      var typearray = Form.getTypeArray(input_onlykeys, multiple_updates);

      // if multiple inserts flag is set
      if( multiple_inserts ) {
        for (var i = 0; i < input_keys.length; i++) {
          if( i!=0 && input_keys[i]=="value_string" ) {
            newinput_keys.push(false)
            newtypearray.push(false)
            newinsertvalues.push(false)
          }
          newinput_keys.push(input_keys[i])
          newtypearray.push(typearray[i])
          newinsertvalues.push(insert_values[i])
        }
        input_keys = newinput_keys
        typearray = newtypearray
        insert_values = newinsertvalues
      }

      // get unformatted array
      var dataarray = Data.getFullArray(viewdict);
      // get formatted array
      var formatteddata = Data.get(connected_identifier);

      // set the values for the inputs inside the smartform
      Reusable.setinputvalues( viewdict, input_keys, connected_identifier, typearray, dataarray, formatteddata, index, multiple_updates, insert_values )

      // check to see how many steps there are in this form. If there's more than one then show a next button
      if (steps > 1) {
        $('.'+connected_identifier+' .main_with_hidden.next').css({'display': 'inline-block'});
        $('.'+connected_identifier+' .main_with_hidden.save').css({'display': 'none'});
      } else {
        $('.'+connected_identifier+' .main_with_hidden.save').css({'display': 'inline-block'});
        $('.'+connected_identifier+' .main_with_hidden.next').css({'display': 'none'});
      }


    }


    }

    addAnotherViewColumnGlobalFunc( identifier, index=null ) {

      // get identifier

      var connected_identifier = identifier.replace("_options_form", "");
      // if( index != null && index.toString() != '0' ) {
      //   Reusable.addAnotherViewColumn($('.'+connected_identifier+' .inner.index_'+index)[0], connected_identifier);
      // } else {
        Reusable.addAnotherViewColumn($('.'+connected_identifier)[0], connected_identifier);
      // }

    }

    addNewViewGlobalFunc(view, identifier, new_identifier) {

      // get identifier
      var connected_identifier = identifier.replace("_options_form", "");
      Reusable.addNewView($('.'+connected_identifier)[0], connected_identifier, new_identifier);
    }

    // adds javascript to form. connecting actions to each textfield and their corresponding views
    addJSClassToFormGlobalFunc(identifier, viewdict, input_onlykeys, original_data_id)
    {

    }








  }

	var Form = new FormClasses();
}
