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
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				var db_info = Reusable.getInputDBInfo(thisdict, index)
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				var key = Reusable.getValidKey(db_info, key)

				if(typeof thisdictvalue === 'undefined'){
					return
				}

			$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
						// alert(JSON.stringify(thisdictvalue));
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
					// .testview_form .testview_form_new_apps_client_information.state_input_0 input.conditionvalue_0
					// viewtype_input testview_form_new_apps_client_information.state_input_0 textfield size_large
				}
				// if( key == "name" ){ alert( JSON.stringify( thisdict['db_info']['tablenames'] ) ); }

		}

		updateDatePicker( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{

			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				var db_info = Reusable.getInputDBInfo(thisdict, index)
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				var key = Reusable.getValidKey(db_info, key)

				if(typeof thisdictvalue === 'undefined'){
					return
				}

			$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
						// alert(JSON.stringify(thisdictvalue));
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}
				// if( key == "name" ){ alert( JSON.stringify( thisdict['db_info']['tablenames'] ) ); }

		}

		updateTimePicker( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{

			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				var db_info = Reusable.getInputDBInfo(thisdict, index)
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				var key = Reusable.getValidKey(db_info, key)

				if(typeof thisdictvalue === 'undefined'){
					return
				}

			$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
						// alert(JSON.stringify(thisdictvalue));
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}
				// if( key == "name" ){ alert( JSON.stringify( thisdict['db_info']['tablenames'] ) ); }

		}


		updateTextArea( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				var db_info = Reusable.getInputDBInfo(thisdict, index)
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

				var key = Reusable.getValidKey(db_info, key)

				if(typeof thisdictvalue === 'undefined'){
					return
				}

			$('.' + identifier + ' .' + inputclass + ' .field_value').val(thisdictvalue[key]);
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][key]);
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
						// alert(JSON.stringify(thisdictvalue));
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}
				// if( key == "name" ){ alert( JSON.stringify( thisdict['db_info']['tablenames'] ) ); }

		}

		updateFileImage( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
				var thisdict = [];

				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				var db_info = Reusable.getInputDBInfo(thisdict, index)
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)
				var key = Reusable.getValidKey(db_info, key)

				if(typeof thisdictvalue === 'undefined'){
					return
				}

			$('.' + identifier + ' .' + inputclass + ' #imglabel').css({'background-image': 'url("'+thisdictvalue[key]+'")'});
				$('.' + identifier + ' .' + inputclass + ' .fieldvalue').val("");
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][key]);
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					// alert(JSON.stringify(conditions));
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						// alert(JSON.stringify(thisdictvalue))
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}
		}

		updateWysi( dataarray, identifier, data_id, key, inputclass, db_key, index, fieldindex )
		{
			var thisdict = [];
			var thisdictvalue = [];
			thisdict = dataarray[data_id];

			if(thisdict == null ){ return; }
			var db_info = Reusable.getInputDBInfo(thisdict, index)
			var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

			var key = Reusable.getValidKey(db_info, key)

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
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				var db_info = Reusable.getInputDBInfo(thisdict, index)
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

			// $('.' + identifier + ' .' + inputclass + ' input.field_value').val(thisdictvalue[key]);
	var colorvalue = "#"+thisdictvalue[key];

			$('.' + identifier + ' .' + inputclass + ' .field_value').spectrum({
				color: colorvalue
			});
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(db_info['tablenames'][key]);
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
						// alert(JSON.stringify(thisdictvalue));
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}
				// if( key == "name" ){ alert( JSON.stringify( thisdict['db_info']['tablenames'] ) ); }

		}


		updateSelect( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				var db_info = Reusable.getInputDBInfo(thisdict, index)
				var thisdictvalue = Reusable.getInputDictValue(thisdict, index)

			$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( db_info['tablenames'][key] );
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );
				for (var i = 0; i < db_info['conditions'].length; i++) {
					var conditions = db_info['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key;
					}else{
						conditions[i]['value'] = thisdictvalue[conditions[i]['key']];
						// alert(JSON.stringify(thisdictvalue));
					}
					$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}
				// if( key == "name" ){ alert( JSON.stringify( thisdict['db_info']['tablenames'] ) ); }

		}

		updateCopyButton( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
			$('.' + identifier + ' .copybutton_1.copy').text("Copy")
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];
				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }
	// alert(JSON.stringify('.' + identifier + ' .' + inputclass + ' .field_value'))
				$('.' + identifier + ' .copybutton_1.field_value').text(thisdictvalue[key]);

		}

		addAction( button, editingfunctions, index, dataarray=null, view=null, e, viewoptions=null, formviewoptions=null, identifier="", is_options=false )
		{

			// index is the button's index, not the cell's

			var identifier = ""
			var type = "";
			if( typeof type === 'undefined' ) {
				type = button['type']
				if(is_options) {
					type = button['options_type']
				}
				if( type == 'modal' ) {
					identifier = button['modal']['modalclass']
				}
				if( type == 'options_modal' ) {
					identifier = button['options_modal']['modalclass']
				}

			}
			if( viewoptions ) {
				if( typeof viewoptions['type'] !== 'undefined' ) {
					type = viewoptions['type']
					if(is_options) {
						type = viewoptions['options_type']
					}
					if( type == 'modal' ) {
						identifier = viewoptions['modal']['modalclass']
					}
					if( type == 'options_modal' ) {
						identifier = viewoptions['options_modal']['modalclass']
					}
				}
			}

			if( type == "link" ){
				// var pre_slug = button[type]
				// var slug = dataarray['slug']
				// var linkpath = ""
				// if( typeof pre_slug !== 'undefined' ) {
				// 	linkpath += pre_slug
				// }
				// if( typeof slug !== 'undefined' ) {
				// 	linkpath += slug
				// }
				// alert( JSON.stringify( linkpath ) )
				// window.open( linkpath );
			}else if( type == "modal" || type == "options_modal" ){
				e.preventDefault();

				var cellindex = null;
				if( view ){
					// theid=view.id
					// var Reusable = new ReusableClasses();
					var cellindex = Reusable.getIndexFromClass( "index_", view )
					// alert( JSON.stringify( "testing: "+cellindex ) );
				}
				if( editingfunctions[index] != "" ) {
					editingfunctions[index].populateview( cellindex );
				}

				$('.' + identifier + '_modalbackground').css({'display': 'inline-block'});
				if( viewoptions ) {
					if( typeof viewoptions['type'] !== 'undefined' ) {
						$('.' + identifier + '_modalbackground .' + viewoptions[type]['parentclass']).css({'display': 'inline-block'});
					}else{
						$('.' + identifier + '_modalbackground .' + button[type]['parentclass']).css({'display': 'inline-block'});
					}
				}else{
					$('.' + identifier + '_modalbackground .' + ' .' + button[type]['parentclass']).css({'display': 'inline-block'});
				}

				if( typeof viewoptions['modal_type'] !== 'undefined' ) {
					if( viewoptions['modal_type'] == "table" ) {
						let thelinkobject = $(view).find('a' )
						// alert(JSON.stringify(dataarray['featured_section']['value'][cellindex]))
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

						// thisdict = dataarray['featured_section']['value'][cellindex]
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
						// var theurl = $(view).find('a').attr('href')
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
						// alert(JSON.stringify('.viewtype_structure.'+datakey+'_modalbackground.modal_background.main'))
					}
				}
			}
		}

		getIndexFromClass( prefix, view )
		{
			let classesstring = $(view).attr( 'class' )
			// alert(JSON.stringify(view))
			var classes = classesstring.split(" ")
			for (var i = 0; i < classes.length ; i++) {
				// alert(JSON.stringify(classes[i]))
				if( classes[i].startsWith(prefix) ){
					var foundclass = classes[i].split("_")
					var theindex = foundclass[((foundclass.length)-1)]
					// alert( "index is: " + theindex )
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

		setinputvalues( sectiondict, input_keys, identifier, typearray, dataarray, formatteddata, index, multiple_updates=false ) {

			var multipleupdate_type_count = 0
			var multipleupdate_type_i = 0
			for (var i = 0; i < input_keys.length; i++) {
				var key = input_keys[i];
				var db_info = []
				if( typeof formatteddata['db_info'] === 'undefined' ) {
					if( typeof formatteddata[0] === 'undefined' ) {
						return
					}
					db_info = formatteddata[0]['db_info']
				} else {
					db_info = formatteddata['db_info']
				}
				let defaultTableName = Reusable.getDefaultTableName(db_info)

				var colname = ""
				if( typeof db_info['colnames'][key] === 'undefined' ) {
					colname = db_info['colnames'][defaultTableName+key];
				} else {
					colname = db_info['colnames'][key];
				}

				var type = typearray[i];
				Reusable.fillinputvalues( type, dataarray, identifier, key, colname, index, i, multiple_updates, typearray )
				if(multiple_updates){
					break
				}
				// i+5
			}

		}

		fillinputvalues( type, dataarray, identifier, key, colname, index, fieldindex, multiple_updates=false, typearray=false ) {

			var inputclass = identifier + "_" + key + "_input_" + fieldindex
			inputclass = inputclass.replace('.', '\\.')
			if( multiple_updates ) {
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



	}
	var Reusable = new ReusableClasses();
}


	// alert( JSON.stringify( typeof ReusableClasses ) );
// if ( typeof ReusableClasses === 'function' )
// {


// }
