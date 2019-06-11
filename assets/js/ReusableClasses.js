if ( typeof ReusableClasses !== 'function' )
{
var editingorder = false;
var editingon = false
var editing_options_on = false
	class ReusableClasses {

		testing(){
			alert("reached testing")
		}

		getInputDBInfo(thisdict, index) {

			var db_info = []

			if(index == null || index == ""){

				db_info = thisdict['db_info'];
			}else if(typeof thisdict['value'] !== 'undefined') {

				db_info = thisdict['db_info'];
			} else {

				db_info = thisdict[index]['db_info'];
			}

			return db_info
		}

		getInputDictValue(thisdict, index) {

			var thisdictvalue = []

			if(index == null || index == ""){

				thisdictvalue = thisdict['value'];
			}else if(typeof thisdict['value'] !== 'undefined') {

				thisdictvalue = thisdict['value'][index];
			} else {

				thisdictvalue = thisdict[index]['value'];
			}

			return thisdictvalue
		}

		getValidKey(db_info, key) {

			let defaultTableName = Reusable.getDefaultTableName(db_info)
			if(key.startsWith(".")){
				key = defaultTableName+key
			}
			return key
		}

		updateTextField( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
				// initialize some vars
				var thisdict = [];
				var thisdictvalue = [];

				// define dictionary for selected view
				thisdict = dataarray[data_id];

				// if the passed data is empty then you can't do anything so just return it
				if(thisdict == null ){
						return;
				}

				// get the db info from the passed data
				var db_info = Reusable.getInputDBInfo(thisdict, index)

				// get selected views data value (usually this is found in viewdict['value'] )
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				// get input key without the tablename connected to it
				var key = Reusable.getValidKey(db_info, key)

				// if the value for the passed data is undefined then you can't do anything so just return it
				if(typeof thisdictvalue === 'undefined'){
					return
				}

				// set the value of the main input in the form
				$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );

				// assign this input with the tablename
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );

				// assign this input with the column name
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );

				// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
				for (var i = 0; i < db_info['conditions'].length; i++) {

					// get the conditions from the view's db_info dictionary
					var conditions = db_info['conditions'];

					// get the condition's values
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						// this is probably not the case -- this is related to multiple_updates/multiple_inserts

						conditions[i]['value'] = key;
					}else{
						// this is how you get the value from the views data

						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
					}

					// add the key to the conditionkey input
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );

					// add the value to conditionvalue input
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}

		}

		updateDatePicker( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
				// initialize some vars
				var thisdict = [];
				var thisdictvalue = [];

				// define dictionary for selected view
				thisdict = dataarray[data_id];

				// if the passed data is empty then you can't do anything so just return it
				if(thisdict == null ){
						return;
				}

				// get the db info from the passed data
				var db_info = Reusable.getInputDBInfo(thisdict, index)

				// get selected views data value (usually this is found in viewdict['value'] )
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				// get input key without the tablename connected to it
				var key = Reusable.getValidKey(db_info, key)

				// if the value for the passed data is undefined then you can't do anything so just return it
				if(typeof thisdictvalue === 'undefined'){
					return
				}

				// set the value of the main input in the form
				$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );

				// assign this input with the tablename
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );

				// assign this input with the column name
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );

				// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}

		}

		updateTimePicker( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
				// initialize some vars
				var thisdict = [];
				var thisdictvalue = [];

				// define dictionary for selected view
				thisdict = dataarray[data_id];

				// if the passed data is empty then you can't do anything so just return it
				if(thisdict == null ){
						return;
				}

				// get the db info from the passed data
				var db_info = Reusable.getInputDBInfo(thisdict, index)

				// get selected views data value (usually this is found in viewdict['value'] )
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				// get input key without the tablename connected to it
				var key = Reusable.getValidKey(db_info, key)

				// if the value for the passed data is undefined then you can't do anything so just return it
				if(typeof thisdictvalue === 'undefined'){
					return
				}

				// set the value of the main input in the form
				$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );

				// assign this input with the tablename
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );

				// assign this input with the column name
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );

				// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}

		}


		updateTextArea( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{

				// initialize some vars
				var thisdict = [];
				var thisdictvalue = [];

				// define dictionary for selected view
				thisdict = dataarray[data_id];

				// if the passed data is empty then you can't do anything so just return it
				if(thisdict == null ){
					return;
				}

				// get the db info from the passed data
				var db_info = Reusable.getInputDBInfo(thisdict, index)

				// get selected views data value (usually this is found in viewdict['value'] )
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				// get input key without the tablename connected to it
				var key = Reusable.getValidKey(db_info, key)

				// if the value for the passed data is undefined then you can't do anything so just return it
				if(typeof thisdictvalue === 'undefined'){
					return
				}

				// set the value of the main input in the form
				$('.' + identifier + ' .' + inputclass + ' .field_value').val(thisdictvalue[key]);

				// assign this input with the tablename
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][key]);

				// assign this input with the column name
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);

				// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
				for (var i = 0; i < db_info['conditions'].length; i++) {

					// get the conditions from the view's db_info dictionary
					var conditions = db_info['conditions'];

					// get the condition's value
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						// this is probably not the case -- this is related to multiple_updates/multiple_inserts

						conditions[i]['value'] = key;
					}else{
						// this is how you get the value from the views data

						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
					}

					// add the key to the conditionkey input
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );

					// add the value to conditionvalue input
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}

		}

		updateFileImage( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
				var thisdict = [];

				thisdict = dataarray[data_id];

				// if the passed data is empty then you can't do anything so just return it
				if(thisdict == null ){
						return;
				}

				// get the db info from the passed data
				var db_info = Reusable.getInputDBInfo(thisdict, index)

				// get selected views data value (usually this is found in viewdict['value'] )
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				// get input key without the tablename connected to it
				var key = Reusable.getValidKey(db_info, key)

				var tablenames = dataarray[identifier]['db_info']['tablenames']
				var first_key = Object.keys(tablenames)[0];
				var tablename = tablenames[first_key]
				var input_name_secondpart = db_key.replace(tablename+'.', '')+'_input_';
				var input_index = inputclass.replace(identifier+'_'+tablename+'\\.'+input_name_secondpart, '')
				//gallery_form_featured_content.imagepath_input_0_file_image_image_container
				var input_identifier = identifier + '_' + tablename + '.' + 'imagepath_input_'+(input_index)//+'_file_image_image_container'
				var js_var = input_identifier.replace('.', '_');
				// alert(JSON.stringify(input_index))
				var field_name_multiple = "fieldimage_multiple[" + input_index + "][field_value]";
				var input_identifier_var = input_identifier.replace('.', '_')

				for (var i = 0; i < 10; i++) {
					$('#'+input_identifier_var+i+'_imglabel').remove()
				}

				// if the value for the passed data is undefined then you can't do anything so just return it
				if(typeof thisdictvalue === 'undefined'){
					return
				}
				if( typeof thisdictvalue[key] === 'undefined') {
					return
				}
				if(thisdictvalue[key].indexOf(",") >= 0){
					var images_array = thisdictvalue[key].split(",");
					for(var a=0; a<images_array.length;a++){
						var image_count = a;

						if(a==0){
							$('.' + identifier + ' .' + inputclass + ' #imglabel').css({'background-image': 'url("'+images_array[a]+'")'});
							$('.' + identifier + ' .' + inputclass + ' .fieldvalue').val("");
							$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][key]);
							$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);

							// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
							for (var i = 0; i < db_info['conditions'].length; i++) {
								var conditions = db_info['conditions'];
								// alert(JSON.stringify(conditions));
								if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
									conditions[i]['value'] = key;
								}else{
									conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
								}
								$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
								$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
							}
						} else {

							Reusable.changeMedia($('#'+input_identifier+'_input_to_add'), input_identifier, field_name_multiple, image_count-1, js_var)

							$('#'+input_identifier_var+(image_count-1)+'_imglabel').css({'background-image': 'url("'+images_array[a]+'")'});
						}
					}

				} else {
					$('.' + identifier + ' .' + inputclass + ' #imglabel').css({'background-image': 'url("'+thisdictvalue[key]+'")'});
					$('.' + identifier + ' .' + inputclass + ' .fieldvalue').val("");
					$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][key]);
					$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);

					// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
					for (var i = 0; i < db_info['conditions'].length; i++) {
						var conditions = db_info['conditions'];

						if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
							conditions[i]['value'] = key;
						}else{

							conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
						}
						$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
						$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
					}
				}

		}

		updateWysi( dataarray, identifier, data_id, key, inputclass, db_key, index, fieldindex )
		{
			// initialize some vars
			var thisdict = [];
			var thisdictvalue = [];

			// define dictionary for selected view
			thisdict = dataarray[data_id];

			// if the passed data is empty then you can't do anything so just return it
			if(thisdict == null ){
					return;
			}

			// get the db info from the passed data
			var db_info = Reusable.getInputDBInfo(thisdict, index)

			// get selected views data value (usually this is found in viewdict['value'] )
			var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

			// get input key without the tablename connected to it
			var key = Reusable.getValidKey(db_info, key)

			// if the value for the passed data is undefined then you can't do anything so just return it
			if(typeof thisdictvalue === 'undefined'){
				return
			}

			var name = 'fieldarray_' + inputclass + '[' + fieldindex + '][field_value]'
			var thisvalue = thisdictvalue[key]
			if( thisvalue == "" ) {
				thisvalue = thisdictvalue[db_key]
			}

			var normalname = name.replace('\\.', '.')
			if( typeof CKEDITOR.instances[normalname] !== "undefined" ) {
				CKEDITOR.instances[normalname].setData( thisvalue );
			}

			$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][db_key]);
			$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);

			// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
			for (var i = 0; i < db_info['conditions'].length; i++) {
				var conditions = db_info['conditions'];
				if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
					conditions[i]['value'] = key;
				}else{
					conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
				}
				$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
				$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
			}
		}

		updateColorPicker( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
				// initialize some vars
				var thisdict = [];
				var thisdictvalue = [];

				// define dictionary for selected view
				thisdict = dataarray[data_id];

				// if the passed data is empty then you can't do anything so just return it
				if(thisdict == null ){
						return;
				}

				// get the db info from the passed data
				var db_info = Reusable.getInputDBInfo(thisdict, index)

				// get selected views data value (usually this is found in viewdict['value'] )
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				// $('.' + identifier + ' .' + inputclass + ' input.field_value').val(thisdictvalue[key]);
				var colorvalue = "#"+thisdictvalue[key];

				// find the color in the color 'spectrum'
				$('.' + identifier + ' .' + inputclass + ' .field_value').spectrum({
					color: colorvalue
				});

				// assign this input with the tablename
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][key]);

				// assign this input with the column name
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);

				// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}

		}


		updateSelect( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
				// initialize some vars
				var thisdict = [];
				var thisdictvalue = [];

				// define dictionary for selected view
				thisdict = dataarray[data_id];

				// if the passed data is empty then you can't do anything so just return it
				if(thisdict == null ){
						return;
				}

				// get the db info from the passed data
				var db_info = Reusable.getInputDBInfo(thisdict, index)

				// get selected views data value (usually this is found in viewdict['value'] )
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				// set the value of the main input in the form
				$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );

				// assign this input with the tablename
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );

				// assign this input with the column name
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );

				// assign this input with the unique conditions (there could be more than one condition so we loop through them -- usually the condition is simply the id)
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}

		}

		updateCopyButton( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
			$('.' + identifier + ' .copybutton_1.copy').text("Copy")
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];
				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }

				$('.' + identifier + ' .copybutton_1.field_value').text(thisdictvalue[key]);

		}

		addAction( button, editingfunctions, index, dataarray=null, view=null, e, viewoptions=null, formviewoptions=null, identifier="", is_options=false )
		{

			// index is the button's index, not the cell's

			// initialize some variables
			var identifier = ""
			var type = "";


			// if( typeof type === 'undefined' ) {
			// 	type = button['type']
			// 	if(is_options) {
			// 		type = button['options_type']
			// 	}
			// 	if( type == 'modal' ) {
			// 		identifier = button['modal']['modalclass']
			// 	}
			// 	if( type == 'options_modal' ) {
			// 		identifier = button['options_modal']['modalclass']
			// 	}
			//
			// }

			// check if viewoptions exist
			if( viewoptions ) {
				if( typeof viewoptions['type'] !== 'undefined' ) {

					// define the editing type
					type = viewoptions['type']
					if(is_options) {
						type = viewoptions['options_type']
					}

					// if type is 'modal', then get the identifier for the data editing modal
					if( type == 'modal' ) {
						identifier = viewoptions['modal']['modalclass']
					}

					// if type is 'options_modal', then get the identifier for the options editing modal
					if( type == 'options_modal' ) {
						identifier = viewoptions['options_modal']['modalclass']
					}

				}
			}
			console.log("ADD ACTION: "+JSON.stringify(identifier))

			if( type == "link" ){

			} else if( type == "modal" || type == "options_modal" ) {
				e.preventDefault();

				var cellindex = null;
				if( view ){
					// get view's index
					var cellindex = Reusable.getIndexFromClass( "index_", view )
				}
				if( editingfunctions[index] != "" ) {
					// index is the editing button's index

					// if object exists at that index inside the editingfunctions array then pass it to this function
					console.log("INSTANCE OF editingfunctionsclass: "+JSON.stringify(typeof editingfunctions[index]))
					console.log("INSTANCE OF function : "+JSON.stringify(typeof editingfunctions[index].populateviewGlobalFunc))
					console.log("INSTANCE OF function : "+JSON.stringify(typeof editingfunctions[index].populateview))
					if(typeof editingfunctions[index].populateview == 'function') {
						editingfunctions[index].populateview( cellindex );
					} else /*if (typeof editingfunctions[index].populateviewGlobalFunc == 'function')*/ {
						// editingfunctions[index].populateviewGlobalFunc( identifier, cellindex );
						Form.populateviewGlobalFunc( identifier, cellindex );
					}


					// editingfunctions[index].( cellindex );
				}

				// show the modal's dark background
				$('.' + identifier + '_modalbackground').css({'display': 'inline-block'});

				// check if editing options or data
				if( viewoptions ) {
					if( typeof viewoptions['type'] !== 'undefined' ) {
						// if editing options, show options modal

						$('.' + identifier + '_modalbackground .' + viewoptions[type]['parentclass']).css({'display': 'inline-block'});
					}else{
						// if editing data, show options modal

						$('.' + identifier + '_modalbackground .' + button[type]['parentclass']).css({'display': 'inline-block'});
					}
				}else{
					// if editing data, show options modal

					$('.' + identifier + '_modalbackground .' + ' .' + button[type]['parentclass']).css({'display': 'inline-block'});
				}

				// check if the modal type is different from the normal smartform modal
				if( typeof viewoptions['modal_type'] !== 'undefined' ) {

					// if modal_type is table then show a table in the modal
					if( viewoptions['modal_type'] == "table" ) {

						let thelinkobject = $(view).find('a' )

						var thisdict = []
						var thekey = ""
						$.each(dataarray, function(key, value) {
						      thekey = key
						      return false;
						});
						if( typeof dataarray['value'] === 'undefined' ) {
							thisdict = dataarray[thekey]['value'][cellindex]
						} else {
							thisdict = dataarray['value'][cellindex]
						}

						var thetable = Reusable.getTableFromCell( view )
						var iscell = false
						if( typeof thetable === 'undefined' ) {
							iscell = false
						} else {
							iscell = true
						}

						var formtable = ""
						if( iscell ) {
							formtable = Reusable.getTableFromCell( view ) + "_form"
						} else {
							formtable = identifier
						}

						var postid = thisdict['id']
						var cellname = formviewoptions['cellname']
						if( typeof cellname === 'undefined' ) {
							cellname = 'imagetext_full'
						}

						$('.' + formtable + ' .viewtype_cell.' + cellname).click(function(){
							var theurl = $(this).find('a').attr('href')
							var goto_link = ""
							if( typeof formviewoptions['goto'] != 'undefined' ) {
								goto_link = formviewoptions['goto']
								theurl = theurl.replace("[[FEATURED_ID]]", postid + "&goto=" + goto_link )
							} else {
								theurl = theurl.replace("[[FEATURED_ID]]", postid )
							}
							$(this).find('a').attr({'href': theurl})
							window.location.href = theurl
						})
					}
				}
			}else if( type == "dropdown" ){
				e.preventDefault();

			}else if( type == "attached" ){
				e.preventDefault();

				if( viewoptions ) {
					if( typeof viewoptions['type'] !== 'undefined' ) {
						var datakey = ""
						$.each(dataarray, function(key, value) {
						      datakey = key
						});


						$( viewoptions['attached']['classname'] ).val( dataarray[datakey]['value'][index][viewoptions['attached']['key']] )
						$(view).parent().parent().parent().parent().parent().parent().parent().parent().css({'display': 'none'})
					}
				}
			}
		}

		getIndexFromClass( prefix, view )
		{
			let classesstring = $(view).attr( 'class' )

			var classes = classesstring.split(" ")
			for (var i = 0; i < classes.length ; i++) {

				if( classes[i].startsWith(prefix) ){
					var foundclass = classes[i].split("_")
					var theindex = foundclass[((foundclass.length)-1)]
					break
				}
			}

			return theindex
		}

		getLastIndexInView( identifier )
		{

			var view = $("."+identifier).find(".inner").last();
			var prefix = "index_";

			let classesstring = $(view).attr( 'class' )

			var classes = classesstring.split(" ")
			for (var i = 0; i < classes.length ; i++) {

				if( classes[i].startsWith(prefix) ){
					var foundclass = classes[i].split("_")
					var theindex = foundclass[((foundclass.length)-1)]
					break
				}
			}

			return theindex
		}

		getTableFromCell( cell )
		{
			var classesstring = $(cell).attr('class')
			var classes = classesstring.split(" ")
			for (var i = 0; i < classes.length ; i++) {
				if (classes[i].indexOf("_cell_") >= 0) {
					var theclass = classes[i].split('_cell_')[0]
					break
				}
			}
			return theclass
		}


		readthisURL(input, previewobj, newwidth, newheight) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        var extension = input.files[0].name.split('.').pop().toLowerCase();
		        var type = '';
		        var previewit = false;
		        if(extension == 'mp3' || extension == 'mp4' || extension == 'wma' || extension == 'm4v' ||  extension == 'mov' || extension == 'wmv' || extension == 'avi' || extension == 'mpg' || extension == 'ogv' || extension == '3gp' || extension == '3g2'){
		            previewit = true;
		            type='video';
		        }else if( extension == 'jpg' || extension == 'jpeg' || extension == 'gif' || extension == 'png'  ){
		            previewit = true;
		            type='image';
		        }
		        if(previewobj){
		            reader.onload = function (e) {
		                if ( previewobj.is( "img" ) ) {
		                    $(previewobj).attr('src', e.target.result);
		                }else if( previewobj.is( "label" ) ) {
		                    $(previewobj).css('background-image', 'url('+e.target.result+')');
		                }

		                $(previewobj).css('width', newwidth);
		                $(previewobj).css('height', newheight);
		             }
		            reader.readAsDataURL(input.files[0]);
		        }
		    }
		}

		addSortable(){

		}

		addJQuery(){
			// Only do anything if jQuery isn't defined
			if (typeof jQuery == 'undefined') {

				if (typeof $ == 'function') {
					// warning, global var
					thisPageUsingOtherJSLibrary = true;
				}

				function getScript(url, success) {

					var script     = document.createElement('script');
					     script.src = url;

					var head = document.getElementsByTagName('head')[0],
					done = false;

					// Attach handlers for all browsers
					script.onload = script.onreadystatechange = function() {

						if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {

						done = true;

							// callback function provided as param
							success();

							script.onload = script.onreadystatechange = null;
							head.removeChild(script);

						};

					};

					head.appendChild(script);

				};

				getScript('http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js', function() {

					if (typeof jQuery=='undefined') {

						// Super failsafe - still somehow failed...

					} else {

						// jQuery loaded! Make sure to use .noConflict just in case
						fancyCode();

						if (thisPageUsingOtherJSLibrary) {

							// Run your jQuery Code

						} else {

							// Use .noConflict(), then run your jQuery Code

						}

					}

				});

			} else { // jQuery was already loaded

				// Run your jQuery Code

			};
		}

		addDropzone( classname, callback=null, paramname=null ){

			if(!paramname){
				paramname='file';
			}
			$(classname).dropzone({
				url: "/file/post",
				paramName: paramname,
				drop: function(){

				},
				thumbnail: function(imgdict){
					var dataURL = imgdict['dataURL'];
					if(callback){
						callback(classname, dataURL );
					}
				}
			});
			// var thedropzone = new Dropzone("."+classname, { url: "/file/post" });
			// thedropzone.on("sending", function(file) { alert("Added file."); });


		}

		getDefaultTableName(db_info) {
			if(typeof db_info === 'undefined'){
				return ""
			}
			var tablenames = db_info['tablenames']
			let firstkey = Object.keys(tablenames)[0]
			let defaultTableName = tablenames[firstkey]

			return defaultTableName
		}

		// setinputvalues() loops through input keys and separates its data into understandable variables
		// calls function fillinputvalues() -- which fills in the inputs with their corresponding values needed for updating or inserting data in the database
		setinputvalues( sectiondict, input_keys, identifier, typearray, dataarray, formatteddata, index, multiple_updates=false ) {

			var multipleupdate_type_count = 0
			var multipleupdate_type_i = 0

			// loop through the input keys and collect data about the db and view for each one
			for (var i = 0; i < input_keys.length; i++) {

				// get the input key
				var key = input_keys[i];

				// get the views db info
				var db_info = []
				if( typeof formatteddata['db_info'] === 'undefined' ) {
					if( typeof formatteddata[0] === 'undefined' ) {
						return
					}
					db_info = formatteddata[0]['db_info']
				} else {
					db_info = formatteddata['db_info']
				}

				// get default tablename
				let defaultTableName = Reusable.getDefaultTableName(db_info)

				// get the inputs column name
				var colname = ""
				if( typeof db_info['colnames'][key] === 'undefined' ) {
					colname = db_info['colnames'][defaultTableName+key];
				} else {
					colname = db_info['colnames'][key];
				}

				// define input type for this input
				var type = typearray[i];

				// fill in the inputs with their corresponding values needed for updating or inserting data in the database
				Reusable.fillinputvalues( type, dataarray, identifier, key, colname, index, i, multiple_updates, typearray )

				// if this is multiple updates then stop it (chances are it's not)
				if(multiple_updates){
					break
				}
				// i+5
			}

		}

		// fills in input values in the smartform
		fillinputvalues( type, dataarray, identifier, key, colname, index, fieldindex, multiple_updates=false, typearray=false ) {

			// define inputclass -- this has to be pretty specific for each input
			var inputclass = identifier + "_" + key + "_input_" + fieldindex
			inputclass = inputclass.replace('.', '\\.')

			if( multiple_updates ) {
				// if multiple updates flag is set (it's probably not)

				var thisdata = dataarray[identifier]['value'];
				if( $.isArray(thisdata ) ) {

				}else{
					thisdata = [thisdata]
				}

				for (var i = 0; i <= thisdata.length; i++) {
					var type = typearray['value_string'][fieldindex]
					inputclass = identifier + "_" + key + "_input_" + fieldindex
					var thisdict = dataarray
					thisdict[identifier]['value'] = thisdata[i]
					// var type = typearray[i]
					if(type=="textarea"){
						Reusable.updateTextArea( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}else if(type=="wysi"){
						Reusable.updateWysi( thisdict, identifier, identifier, key, inputclass, colname, 0, fieldindex );
					}else if(type=="file_image"){
						Reusable.updateFileImage( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}else if(type=="textfield"){
						Reusable.updateTextField( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}else if(type=="datepicker"){
						Reusable.updateDatePicker( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}else if(type=="timepicker"){
						Reusable.updateTimePicker( thisdict, identifier, identifier, key, inputclass, colname, 0 )
					}else if(type=="colorpicker"){
						Reusable.updateColorPicker( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}else if(type=="copybutton_1"){
						Reusable.updateCopyButton( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}
					fieldindex = fieldindex+5;
				}
			}else{
				// depending on the input type, call the function that updates the individual input values

				if( type == "textarea" ){
					Reusable.updateTextArea( dataarray, identifier, identifier, key, inputclass, colname, index );
				} else if( type == "wysi" ) {
					Reusable.updateWysi( dataarray, identifier, identifier, key, inputclass, colname, index, fieldindex );
				} else if( type == "file_image" ) {
					Reusable.updateFileImage( dataarray, identifier, identifier, key, inputclass, colname, index );
				} else if( type == "textfield" ) {
					Reusable.updateTextField( dataarray, identifier, identifier, key, inputclass, colname, index );
				} else if( type == "datepicker" ) {
					Reusable.updateDatePicker( dataarray, identifier, identifier, key, inputclass, colname, index );
				} else if( type=="timepicker" ){
					Reusable.updateTimePicker( dataarray, identifier, identifier, key, inputclass, colname, index )
				} else if( type == "colorpicker" ) {
					Reusable.updateColorPicker( dataarray, identifier, identifier, key, inputclass, colname, index );
				} else if( type == "copybutton_1" ) {
					Reusable.updateCopyButton( dataarray, identifier, identifier, key, inputclass, colname, index );
				} else if( type == "select" ) {
					Reusable.updateSelect( dataarray, identifier, identifier, key, inputclass, colname, index );
				}
			}
		}


		switchEditing( turnOn ) {
			editingon = turnOn

			$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#FFF8E0'})
				$('.horizontal.button.edit_switch.wrapper.buttonindex_1  .horizontal.topbar-button label').html('Edit: <b style=\"color: green\">On</b>/Off');
		}

		toggleEditing() {

			editing_options_on = false
			if( editingon ) {
				editingon = false
				$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#ffffff'})
				$('.horizontal.button.edit_switch.wrapper  .horizontal.topbar-button label').html('Edit Data: On/<b>Off</b>');
			}else{
				editingon = true
				$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#FFF8E0'})
				$('.horizontal.button.edit_switch.wrapper  .horizontal.topbar-button label').html('Edit Data: <b style=\"color: green\">On</b>/Off');
			}
		}

		switchEditingOptions( turnOn ) {
			editing_options_on = turnOn

			$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#FFF8E0'})
				$('.horizontal.button.edit_options_switch.wrapper .horizontal.topbar-button label').html('Edit: <b style=\"color: green\">On</b>/Off');
		}

		toggleEditingOptions() {

			editingon = false
			if( editing_options_on ) {
				editing_options_on = false
				$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#ffffff'})
				$('.horizontal.button.edit_options_switch.wrapper .horizontal.topbar-button label').html('Edit Options: On/<b>Off</b>');
			}else{
				editing_options_on = true
				$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#D7FAFE'})
				$('.horizontal.button.edit_options_switch.wrapper .horizontal.topbar-button label').html('Edit Options: <b style=\"color: green\">On</b>/Off');
			}
		}

		isEditing() {
			return editingon
		}

		isEditingOptions() {
			return editing_options_on
		}

		changeMedia(view, identifier, field_name_multiple, image_count, js_var) {

			var next_image_count = window[js_var+'_image_count'] + 1;
			var identifier_var = identifier.replace('.', '\\.')
			// create the label for the image preview
			var new_image = document.createElement("label");

			document.getElementById(identifier+'_file_image_image_container').appendChild(new_image);
			new_image.classList.add("file_image");
			new_image.classList.add("file_image_look");
			$(new_image).prop({'for': identifier+window[js_var+'_image_count']})
			new_image.id = js_var+window[js_var+'_image_count']+'_imglabel';

			// create the input for the file
			var image_input = document.createElement("input");
			document.getElementById(identifier+'_file_image_image_inputs_container').appendChild(image_input);
			image_input.classList.add("field_value");
			image_input.classList.add(js_var+"_file_image_input");
			$(image_input).prop({'type': 'file', 'name': field_name_multiple+'['+next_image_count+']'})
			$(image_input).css({'visibility': 'hidden', 'z-index': '-1'})

			$('#'+identifier_var+'_input_to_add')[0].id = identifier+next_image_count

			image_input.id = identifier+'_input_to_add';

			var for_prop = identifier+next_image_count;

			Reusable.readthisURL(view, $(new_image), null, null);

			$('#'+identifier_var+window[js_var+'_image_count']).change(function(){

				Reusable.readthisURL(this, $('#'+js_var+window[js_var+'_image_count']+'_imglabel'), null, null);
			})

			$('.'+js_var+'_file_image_input').change(function(){
				input_has_changed(this, identifier, field_name_multiple)
			})

			// increment views image image
			window[js_var+'_image_count'] = next_image_count;
		}







		addAnotherViewColumn(view, identifier) {

			identifier = identifier.replace("_options", "")

			var index = 0;

			if( $(view).find(".inner")[0].className.includes('index') == false ) {
				$('.'+identifier).addClass('index_0');
			} else {
				// index = Reusable.getIndexFromClass( "index_", $(view).find(".inner")[0] )
				index = Reusable.getLastIndexInView( identifier )
			}

			if( index != "0" ) {
				var newview = $('.'+identifier).find('.inner'+'.index_'+index).clone()
			} else {
				var newview = $('.'+identifier).find('.inner').clone()
			}
			// newview.insertAfter( $('.'+identifier+'.index_'+index) );
			newview.insertAfter( $('.'+identifier).find('.inner'+'.index_'+index) );

			var nextindex = parseInt(index)+1;

			$(newview).removeClass('index_'+index).addClass('index_'+nextindex);
			$(newview).find('.clicktoedit').removeClass('index_'+index).addClass('index_'+nextindex);

			var newwidth = 100/(parseInt(index)+2);
			Reusable.changeViewWidth(identifier, newview, newwidth);

			var viewdict = Data.get(identifier);
			var viewoptions = Options.get(identifier);
			Editing.clickToEditSection(viewdict, viewoptions, identifier);
			var connected_identifier = identifier.replace("_form", "");
			// $(view).find("."+identifier+"_add_view_button").remove()
// 			$(newview).find("."+identifier+"_add_view_button").off().click(function(){

// 					Editing.addViewButtonAction(newview, identifier);
// 			});
		}

		addNewView(view, identifier, new_identifier) {

			identifier = identifier.replace("_options", "")

			var newview = $('.'+identifier).clone()

			var oldview_modal_id = identifier + "_form";
			var oldview_optionsmodal_id = identifier + "_options_form";
			var oldview_form_identifier = identifier + "_form_modalbackground";
			var oldview_optionsform_identifier = identifier + "_options_form_modalbackground";

			var newview_modal_id = new_identifier + "_form";
			var newview_optionsmodal_id = new_identifier + "_options_form";
			var newview_form_identifier = new_identifier + "_form_modalbackground";
			var newview_optionsform_identifier = new_identifier + "_options_form_modalbackground";

			var newview_form = $('.'+oldview_form_identifier).clone()
			var newview_optionsform = $('.'+oldview_optionsform_identifier).clone()




			var newview_form_html = $(newview_form).html();
			newview_form_html = Data.replaceAll(newview_form_html, identifier, new_identifier)

			$(newview_form).html(newview_form_html);

			var newview_optionsform_html = $(newview_optionsform).html();
			newview_optionsform_html = Data.replaceAll(newview_optionsform_html, identifier, new_identifier)

			$(newview_optionsform).html(newview_optionsform_html);

			var newview_html = $(newview).html();
			newview_html = Data.replaceAll(newview_html, identifier, new_identifier)

			$(newview).html(newview_html);

			newview_form.insertAfter( $('.'+identifier) );
			newview_optionsform.insertAfter( newview_form );
			newview.insertAfter( newview_optionsform );

			$(newview_form).removeClass(oldview_form_identifier).addClass(newview_form_identifier);
			$(newview_optionsform).removeClass(oldview_optionsform_identifier).addClass(newview_optionsform_identifier);
			$(newview).removeClass(identifier).addClass(new_identifier);

			var viewdict = Data.get(identifier);
			var viewoptions = Options.get(identifier);
			var dataform_viewdict = Data.get(oldview_modal_id);
			var optionsform_viewdict = Data.get(oldview_optionsmodal_id);
			var dataform_viewoptions = Options.get(oldview_modal_id);
			var optionsform_viewoptions = Options.get(oldview_optionsmodal_id);

			viewoptions["modal"] = newview_modal_id;
			viewoptions["options_modal"] = newview_optionsmodal_id;

			Data.add(viewdict, new_identifier)
			Options.addOptions(viewoptions, new_identifier)
			Data.add(dataform_viewdict, newview_modal_id)
			Data.add(optionsform_viewdict, newview_optionsmodal_id)
			Options.addOptions(dataform_viewoptions, newview_modal_id)
			Options.addOptions(optionsform_viewoptions, newview_optionsmodal_id)



			// (new_identifier, viewdict, input_onlykeys, new_identifier)

			modalclasses[new_identifier] = Form;

			// var modal = viewoptions['modal'];
			// viewoptions['modal'] = {}
			// viewoptions['modal']['modalclass'] = "featured_section_form"
			// viewoptions['modal']['parentclass'] = modal + "_wrapper"
			// var modal = viewoptions['options_modal'];
			// viewoptions['options_modal'] = {}
			// viewoptions['options_type'] = "options_modal"
			// viewoptions['options_modal']['modalclass'] = modal
			// viewoptions['options_modal']['parentclass'] = modal + "_wrapper"

			// optionmodalclasses[new_identifier] = optionmodalclasses[identifier];
			optionmodalclasses[new_identifier] = Form; // optionmodalclasses[identifier];
			allinfo[new_identifier] = allinfo[identifier];

			Editing.clickToEditSection(viewdict, viewoptions, new_identifier);

		}

		changeViewWidth(identifier, view, newwidth)
		{
			newwidth = "calc( "+newwidth.toString() + "% - "+$(view).css("padding-left")+" - "+$(view).css("padding-right")+" - "+$(view).css("margin-left")+" - "+$(view).css("margin-right")+" ) !important";
			$('body').append( '<style> .'+identifier+' .inner { width: '+newwidth+'; } </style>' );
		}
	}

	var Reusable = new ReusableClasses();


}


	// alert( JSON.stringify( typeof ReusableClasses ) );
// if ( typeof ReusableClasses === 'function' )
// {


// }
