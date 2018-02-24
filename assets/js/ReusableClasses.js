if ( typeof ReusableClasses !== 'function' )
{
var editingorder = false;
var editingon = false
	class ReusableClasses {

		testing(){
			alert("reached testing")
		}

		updateTextField( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }

			$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( thisdict['db_info']['tablenames'][key] );
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );
				for (var i = 0; i < thisdict['db_info']['conditions'].length; i++) {
					var conditions = thisdict['db_info']['conditions'];
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

		updateDatePicker( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{

			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }

				
				if(thisdict == null ){ return; }
				if(index == null || index == ""){ if(thisdict == null ){ return; } thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }

			$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( thisdict['db_info']['tablenames'][key] );
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );
				for (var i = 0; i < thisdict['db_info']['conditions'].length; i++) {
					var conditions = thisdict['db_info']['conditions'];
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
				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }

			$('.' + identifier + ' .' + inputclass + ' .field_value').val(thisdictvalue[key]);
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(thisdict['db_info']['tablenames'][key]);
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);
				for (var i = 0; i < thisdict['db_info']['conditions'].length; i++) {
					var conditions = thisdict['db_info']['conditions'];
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
				var thisdictvalue = [];
				thisdict = dataarray[data_id];

				if(thisdict == null ){ return; }
				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }
// console.log("IMAGE IS: "+JSON.stringify(thisdictvalue))
			$('.' + identifier + ' .' + inputclass + ' #imglabel').css({'background-image': 'url("'+thisdictvalue[key]+'")'});
				$('.' + identifier + ' .' + inputclass + ' .fieldvalue').val("");
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(thisdict['db_info']['tablenames'][key]);
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);
				for (var i = 0; i < thisdict['db_info']['conditions'].length; i++) {
					var conditions = thisdict['db_info']['conditions'];
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
			if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }
			var name = 'fieldarray_' + inputclass + '[' + fieldindex + '][field_value]'
			CKEDITOR.instances[name].setData( thisdictvalue[key] ); 

			$('.' + identifier + ' .' + inputclass + ' input.tablename').val(thisdict['db_info']['tablenames'][key]);
			$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);
			for (var i = 0; i < thisdict['db_info']['conditions'].length; i++) {
				var conditions = thisdict['db_info']['conditions'];
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
				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }
			// $('.' + identifier + ' .' + inputclass + ' input.field_value').val(thisdictvalue[key]);
	var colorvalue = "#"+thisdictvalue[key];

			$('.' + identifier + ' .' + inputclass + ' .field_value').spectrum({
				color: colorvalue
			});
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val(thisdict['db_info']['tablenames'][key]);
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val(db_key);
				for (var i = 0; i < thisdict['db_info']['conditions'].length; i++) {
					var conditions = thisdict['db_info']['conditions'];
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

				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }

			$('.' + identifier + ' .' + inputclass + ' input.field_value').val( thisdictvalue[key] );
				$('.' + identifier + ' .' + inputclass + ' input.tablename').val( thisdict['db_info']['tablenames'][key] );
				$('.' + identifier + ' .' + inputclass + ' input.col_name').val( db_key );
				for (var i = 0; i < thisdict['db_info']['conditions'].length; i++) {
					var conditions = thisdict['db_info']['conditions'];
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

		addAction( button, editingfunctions, index, dataarray=null, view=null, e, viewoptions=null )
		{

			// index is the button's index, not the cell's
			
			var identifier = ""
			var type = "";
			if( typeof type === 'undefined' ) {
				type = button['type']
				if( type == 'modal' ) {
					identifier = button['modal']['modalclass']
				}
				
			}
			if( viewoptions ) {
				if( typeof viewoptions['type'] !== 'undefined' ) {
					type = viewoptions['type']
					if( type == 'modal' ) {
						identifier = viewoptions['modal']['modalclass']
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
			}else if( type == "modal" ){
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
				}
			}
			return theindex

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

		setinputvalues( sectiondict, input_keys, identifier, typearray, dataarray, formatteddata, index, multiple_updates=false ) {

			var multipleupdate_type_count = 0
			var multipleupdate_type_i = 0
			for (var i = 0; i < input_keys.length; i++) {
				var key = input_keys[i];
				var colname = formatteddata['db_info']['colnames'][key];
				var type = typearray[i];
				// console.log("fieldindex: "+JSON.stringify(type['value_string'][20]))
				// console.log("AHHHH_"+i+": "+JSON.stringify(type))
				Reusable.fillinputvalues( type, dataarray, identifier, key, colname, index, i, multiple_updates, typearray )
				if(multiple_updates){
					break
				}
				// i+5
			}

		}

		fillinputvalues( type, dataarray, identifier, key, colname, index, fieldindex, multiple_updates=false, typearray=false ) {

			var inputclass = identifier + "_" + key + "_input_" + fieldindex
			if( multiple_updates ) {
				var thisdata = dataarray[identifier]['value'];
				if( $.isArray(thisdata ) ) {

				}else{
					thisdata = [thisdata]
				}

				for (var i = 0; i <= thisdata.length; i++) {
					var type = typearray['value_string'][fieldindex]
					console.log("THIS DATA_"+type+"_"+inputclass+": "+JSON.stringify(thisdict))
					inputclass = identifier + "_" + key + "_input_" + fieldindex
					var thisdict = dataarray
					thisdict[identifier]['value'] = thisdata[i]
					// var type = typearray[i]
					// console.log("THIS DATA_"+typearray+"_"+inputclass+": "+JSON.stringify(thisdict))
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
					}else if(type=="colorpicker"){
						Reusable.updateColorPicker( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}else if(type=="copybutton_1"){
						Reusable.updateCopyButton( thisdict, identifier, identifier, key, inputclass, colname, 0 );
					}
					fieldindex = fieldindex+5;
					// console.log("fieldindex: "+JSON.stringify(thisdata.length))
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
			if( editingon ) {
				editingon = false
				$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#ffffff'})
				$('.horizontal.button.edit_switch.wrapper.buttonindex_1  .horizontal.topbar-button label').html('Edit: On/<b>Off</b>');
			}else{
				editingon = true
				$('div.horizontal.main.adminbar.desktopnav.navbar-shadow').css({'background-color': '#FFF8E0'})
				$('.horizontal.button.edit_switch.wrapper.buttonindex_1  .horizontal.topbar-button label').html('Edit: <b style=\"color: green\">On</b>/Off');
			}

		}

		isEditing() {
			return editingon
		}	



	}
	var Reusable = new ReusableClasses();
}


	// alert( JSON.stringify( typeof ReusableClasses ) );
// if ( typeof ReusableClasses === 'function' )
// {


// }