class cell_10_classes {

	setupactions( cellactions, editingfunctions )
	{

		$('.cell_10 button#select').off().click(function(e){
			e.preventDefault();
		});

		$('.cell_10 button.action').off().click(function(e){
			e.preventDefault();
			var classes = $(this).attr('class');
			var classarray = classes.split(' ');
			var theindex = -1;
			for (var i = 0; i < classarray.length; i++) {
				if(classarray[i].match("^index_")){
					theindex = parseInt( classarray[i].split('_')[1] );
				}
			}
			if(theindex != -1){
				var cellbutton = cellactions[theindex];
				Reusable.addAction( cellbutton, editingfunctions, theindex )
			}
		});
	}

}