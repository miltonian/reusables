class cell_10_classes {

	setupactions( cellactions, editingfunctions )
	{

		$('.cell_10 button#select').off().click(function(e){
			e.preventDefault();
		});

		$('.cell_10 button.action').off().click(function(e){
			e.preventDefault();
			var theindex = Reusable.getIndexFromClass( "actionindex_", this )
			if(theindex != -1){
				var cellbutton = cellactions[theindex];

				Reusable.addAction( cellbutton, editingfunctions, theindex, null, this )
			}
		});
	}

}