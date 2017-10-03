if ( typeof ReusableClasses !== 'function' )
{
var editingorder = false;
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

		updateTextArea( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
		{
			var thisdict = [];
				var thisdictvalue = [];
				thisdict = dataarray[data_id];
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
				if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }

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
			if(index == null || index == ""){ thisdictvalue = thisdict['value']; }else { thisdictvalue = thisdict['value'][index]; }
			
			CKEDITOR.instances['fieldarray[' + fieldindex + '][field_value]'].setData( thisdictvalue[key] ); 

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

		addAction( button, editingfunctions, index, dataarray=null, view=null, e )
		{
			// index is the button's index, not the cell's
			var type = button['type'];
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
				editingfunctions[index].populateview( cellindex );
				$('.modal_background').css({'display': 'inline-block'});
				$('.' + button[type]['parentclass']).css({'display': 'inline-block'});
			}else if( type == "dropdown" ){
				e.preventDefault();
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
					var theindex = classes[i].split("_")[1]
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

		setinputvalues( sectiondict, input_keys, identifier, typearray, dataarray, formatteddata, index ) {

			for (var i = 0; i < input_keys.length; i++) {
				var key = input_keys[i];
				var colname = formatteddata['db_info']['colnames'][key];
				var type = typearray[i];
				Reusable.fillinputvalues( type, dataarray, identifier, key, colname, index, i )
			}

		}

		fillinputvalues( type, dataarray, identifier, key, colname, index, fieldindex ) {

			var inputclass = identifier + "_" + key + "_input_" + fieldindex

			if(type=="textarea"){
				Reusable.updateTextArea( dataarray, identifier, identifier, key, inputclass, colname, index );
			}else if(type=="wysi"){
				Reusable.updateWysi( dataarray, identifier, identifier, key, inputclass, colname, index, fieldindex );
			}else if(type=="file_image"){
				Reusable.updateFileImage( dataarray, identifier, identifier, key, inputclass, colname, index );
			}else if(type=="textfield"){
				Reusable.updateTextField( dataarray, identifier, identifier, key, inputclass, colname, index );
			}else if(type=="colorpicker"){
				Reusable.updateColorPicker( dataarray, identifier, identifier, key, inputclass, colname, index );
			}else if(type=="copybutton_1"){
				Reusable.updateCopyButton( dataarray, identifier, identifier, key, inputclass, colname, index );
			}
		}

		



	}
	var Reusable = new ReusableClasses();
}


	// alert( JSON.stringify( typeof ReusableClasses ) );
// if ( typeof ReusableClasses === 'function' )
// {


// }