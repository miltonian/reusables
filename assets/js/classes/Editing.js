if ( typeof EditingClasses !== 'function' )
{
  var modalclasses = {};
  var optionmodalclasses = {};
  class EditingClasses {


    baseName(str)
    {
       var base = new String(str).substring(str.lastIndexOf('/') + 1);
        if(base.lastIndexOf(".") != -1)
            base = base.substring(0, base.lastIndexOf("."));
       return base;
    }

    clickToEditSection(viewdict, viewoptions, identifier, alwayseditable=false) {


      // add click action to view -- connected to the container that wraps around every reusable view
      $('.'+identifier+' .clicktoedit').click(function(e){

        console.log("clicktoedit identifier: "+JSON.stringify(identifier))
        var viewdict = Data.get(identifier);
        var viewoptions = Options.get(identifier);
        console.log("viewoptions: "+JSON.stringify(viewoptions))
        if( Reusable.isEditing() || alwayseditable ) {
            Data.makeViewEditing(viewdict, viewoptions, identifier, e, this, alwayseditable);
        }

        // check if editing options
        if( Reusable.isEditingOptions() ) {

            // if you are editing options,
            Options.makeViewEditing(viewdict, viewoptions, identifier, e, this, alwayseditable);
        }

      });
      var connected_identifier = identifier.replace("_form", "");

      $("."+connected_identifier+"_add_view_button").off().click(function(){
          var viewindex = Reusable.getLastIndexInView(connected_identifier);
          var view = $("."+connected_identifier+" .index_"+viewindex+".clicktoedit");

          Editing.addViewButtonAction(view, connected_identifier)
      });

      $("."+connected_identifier+"_add_newview_button").off().click(function(){

          var milliseconds = (new Date).getTime();
          var new_identifier = "newview_"+milliseconds;
          var view = $("."+connected_identifier+"");

          Editing.addNewViewButtonAction(view, connected_identifier, new_identifier)
      });

      // console.log("filename from JS: "+JSON.stringify(Editing.baseName(filename)))
    }

    addViewButtonAction(view, identifier)
    {
      var cellindex = null;

      if( view ){
        // get view index
        if( $(view).attr( "class" ).includes("index_") ) {

          // cellindex = Reusable.getIndexFromClass( "index_", view )
          cellindex = Reusable.getLastIndexInView(identifier);
        }
      }

      if(typeof modalclasses[identifier].addAnotherViewColumn == 'function') {
          modalclasses[identifier].addAnotherViewColumn( cellindex );
      } else {
          Form.addAnotherViewColumnGlobalFunc( identifier, cellindex );
      }
    }

    addNewViewButtonAction(view, identifier, new_identifier)
    {
      if(typeof modalclasses[identifier].addNewView == 'function') {
          modalclasses[identifier].addNewView(view, identifier, new_identifier)
      } else {
          Form.addNewViewGlobalFunc( view, identifier, new_identifier );
      }
    }

    getEditingFunctionsJS(dict, is_options=false)
    {
        var action_key = RFormat.getViewActionKey(dict);

        var multiple = false;
        if (action_key == '') {
            var actiondict = dict;
        } else {
            var actiondict = dict[action_key];
            multiple = true;
        }
        var editingfunctions = [];
        if (multiple) {
            // var i=0;
            // for (ca in actiondict) {
            //     if (ca_type == "modal") {
            //         if (isset($ca_type[ 'modal' ])) {
            //             echo "var thismodalclass = new " . $ca['modal']['modalclass'] . "Classes();
            // 						editingfunctions.push( thismodalclass );";
            //         } else {
            //             echo 'editingfunctions.push( "nothing" );';
            //         }
            //     } else {
            //         echo 'editingfunctions.push( "nothing" );';
            //     }
            //     $i++;
            // }
        } else {
            if (is_options) {
                var ca_type = Data.getValue(actiondict, 'options_type');
            } else {
                var ca_type = Data.getValue(actiondict, 'type');
            }

            if (ca_type == "modal") {
                if ( typeof actiondict[ 'modal' ] !== 'undefined' ) {
                    // var thismodalclass = new " . $actiondict['modal']['modalclass'] . "Classes();
                    var thismodalclass = modalclasses[identifier];
          					editingfunctions.push( thismodalclass );
                } else {
                    editingfunctions.push( "nothing" );
                }
            } else if (ca_type == "options_modal") {
                if ( typeof actiondict[ 'options_modal' ] != 'undefined') {
                    // echo "var thismodalclass = new " . $actiondict['options_modal']['modalclass'] . "Classes();
                    var thismodalclass = optionmodalclasses[identifier];
          					editingfunctions.push( thismodalclass );
                    console.log("editingfunctions: "+JSON.stringify(thismodalclass));
                } else {
                    editingfunctions.push( "nothing" );
                }
            } else {
                editingfunctions.push( "nothing" );
            }
        }
    }











  }
  var Editing = new EditingClasses();
}
