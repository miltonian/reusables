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
				// alert("index is "+theindex)
				Reusable.addAction( cellbutton, editingfunctions, theindex, dataarray, this, e )
			}
		});
	}

}