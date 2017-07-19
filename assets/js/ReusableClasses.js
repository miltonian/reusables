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
		$('.' + identifier + ' .' + inputclass + ' input.field_value').val(thisdictvalue[key]);
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
				if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
					conditions[i]['value'] = key; 
				}else{
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

	addAction( button, editingfunctions, index, dataarray=null )
	{
		var type = button['type'];
		if( type == "link" ){
			window.open(button[type]);
		}else if( type == "modal" ){
			editingfunctions[index].populateview(this.id);
			$('.modal_background').css({'display': 'inline-block'});
			$('.' + button[type]['parentclass']).css({'display': 'inline-block'});
		}else if( type == "dropdown" ){
			

			
		}
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

	addSortable(  ){
		
	}



}

let Reusable = new ReusableClasses();