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
				if(conditions[i]['key'] == "maininfo_key"){
					conditions[i]['value'] = key; 
				}else{
					conditions[i]['value'] = thisdictvalue[conditions[i]['key']]; 
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
				if(conditions[i]['key'] == "maininfo_key"){
					conditions[i]['value'] = key; 
				}else{
					conditions[i]['value'] = thisdictvalue[conditions[i]['key']]; 
				}
				$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
				$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
			}
	}

	updateWysi( dataarray, identifier, data_id, key, inputclass, db_key, index=null, fieldindex )
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
				if(conditions[i]['key'] == "maininfo_key"){
					conditions[i]['value'] = key; 
				}else{
					conditions[i]['value'] = thisdictvalue[conditions[i]['key']]; 
				}
				$( '.' + identifier + ' .' + inputclass + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
				$( '.' + identifier + ' .' + inputclass + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
			}
	}



}

let Reusable = new ReusableClasses();