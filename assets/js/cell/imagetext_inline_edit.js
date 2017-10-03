class imagetext_inline_edit_classes {

	setupactions( cellactions, editingfunctions, dataarray=null )
	{

		$('.imagetext_inline_edit button#select').off().click(function(e){
			e.preventDefault();
		});

		$('.imagetext_inline_edit button.action').off().click(function(e){
			var theindex = Reusable.getIndexFromClass( "actionindex_", this )
			if(theindex != -1){
				var cellbutton = cellactions[theindex];
				// alert(JSON.stringify(cellbutton))
				// alert("index is "+theindex)
				// alert( JSON.stringify( dataarray ) )
				Reusable.addAction( cellbutton, editingfunctions, theindex, dataarray, this, e )
			}
		});

		$('.imagetext_inline_edit a.dropdown_action').off().click(function(e){
			var cellactionindex = Reusable.getIndexFromClass( "cellactionindex_", this )
			var dropdownindex = Reusable.getIndexFromClass( "dropdownindex_", this )
			if(cellactionindex != -1){
				var cellbutton = cellactions[cellactionindex];
				var dropdownbutton = cellbutton['actions'][dropdownindex]
				// alert(JSON.stringify(editingfunctions))
				// var dropdownbutton = cellbutton[]
				Reusable.addAction( dropdownbutton, editingfunctions, dropdownindex, null, this, e )
			}
		});
	}

}