class ReusableGlobalFunctions {
reusableDefaultTable(cellarray, cellsinrow ) {
    var myTableDiv = document.getElementById("reusableTableDiv")
    	var table = document.createElement('TABLE')
    	var tableBody = document.createElement('TBODY')
	
	table.id = 'reusableTable';
	table.style.borderSpacing = "20px";
	
    	table.appendChild(tableBody);
    	
    	
    	
    //TABLE ROWS
    
    var anumber = 1;
    
    //alert(cellarray.length);
    
    for (a = 0; a < cellarray.length; a++) {
    //for (i = 0; i < 5; i++) {
        var tr = document.createElement('TR');
        
        	var td = document.createElement('TD');
        	
        	
        	for(b = 0; b < cellsinrow; b++){
        		
        		if( b != 0 ){
        			a = a+1;
        		}
        		
        		//var celldivid = "celldiv_".concat(a);
        		
        		var thiscell = cellarray[a];
        		thiscell.className = 'reusablecelldiv';
        		
        		//thiscell.id = "reusablecellindex_".concat(a);
        		
        		if( (a) >= (cellarray.length - 1) ){
        			
        			b = cellsinrow.length;
        			
        			
        		}
        		
        		td.appendChild(thiscell);
        		
        		
        		/*var test = document.createElement('div');
        		test.id = 'testcell';
        		test.style.backgroundColor = "red";
        		
        		if( (a+1) > cellarray.length ){
        			
        			b = cellsinrow.length;
        			
        		}
        		
        		
        		td.appendChild(test);*/
        		
        	}
        	
        	
        	
        	tr.appendChild(td);
  		
  	
  	
  	//}
        
        tableBody.appendChild(tr);
    }  
    myTableDiv.appendChild(table);
    
}

setupReusableTableCell(celltype, inputdict, theindex, thisdiv) {
	
	if(celltype == 1){
		//just an button with text and background image
		
		//alert(thisdiv);
		
		var backgroundimg = inputdict['backgroundimg'];
		var buttontitle = inputdict['buttontitle'];
		var buttonwidth = inputdict['buttonwidth'];
		var buttonheight = inputdict['buttonheight'];
		
		var thebutton = document.createElement('button');
		thebutton.className = 'reusableCell1';
		thebutton.id = "reusablecellbutton_".concat(i);
		var backgroundimagestring = "url(".concat(backgroundimg);
		var backgroundimagestring2 = backgroundimagestring.concat(")");
		thebutton.style.backgroundImage = backgroundimagestring2;
		thebutton.style.width = buttonwidth;
		thebutton.style.height = buttonheight;
		var buttontextnode = document.createTextNode(buttontitle);
		thebutton.appendChild(buttontextnode);
		
		
		thisdiv.style.display = "inline-block";
		thisdiv.style.position = "relative";
		thisdiv.appendChild(thebutton);
		
		return thebutton;
		
	}else if(celltype == 2){
		//image on left; title to the right of img; desc under title; time on far right; entirety is a link.
		
	}
	
}

setuponload(){

	$('.reusablepopclosebutton').css('backgroundImage', 'url(http://www.alexanderhamiltondev.com/images/xmark-gray@2x.png)');
	
	$('.reusablepopclosebutton').click(function() {
				
		$('.reusablepopbackground').css('display','none');
				
	});
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
                // alert();
                if ( previewobj.is( "img" ) ) {
                    // alert(1)
                    $(previewobj).attr('src', e.target.result);
                }else if( previewobj.is( "label" ) ) {
                    // alert(2);
                    $(previewobj).css('background-image', 'url('+e.target.result+')');
                }
                
                $(previewobj).css('width', newwidth);
                $(previewobj).css('height', newheight);
                
                /*if( previewit == true ){
                    updateiffeaturedisvideo(type, e.target.result);
                }*/
                //updatesecondfeaturedimg();
                //checkfeaturedimage();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}

}

