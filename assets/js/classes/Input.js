if ( typeof InputClasses !== 'function' )
{

  var inputtypes = [];

  class InputClasses {

    getInputTypes()
  	{
  		return inputtypes;
  	}

    getInputType( key, multiple_updates=false, field_index=-1 )
  	{

  		if( typeof inputtypes[key] !== 'undefined' ){
  			if( multiple_updates ) {
  				// if( is_array( inputtypes[key] ) ) {
  				// 	$dict = [];
  				// 	for (var k as inputtypes[key]) {
          //     var value = inputtypes[key][k]
  				// 		dict[key] = value;
  				// 	}
  				// 	if( typeof dict[field_index.toString()] !== 'undefined' ) {
  				// 		return dict[field_index.toString()];
  				// 	}
  				// }else{
  				// 	return inputtypes[key];
  				// }
  			}else{
  				return inputtypes[key];
  			}
  		}

  		if( key.includes("text") !== false || key.includes("desc") || key.includes("description") || key.includes("comment") || key.includes("snippet") ){
  			if( key.includes(key, "html") !== false || key.includes("html") !== false ) {
  				var type = "wysi";
  			} else {
  				var type = "textarea";
  			}
  		}else if( key.includes("image" ) !== false ) {
  			var type = "file_image";
  		}else if( key.includes("color" ) ) {
  			var type = "colorpicker";
  		}else{
  			var type = "textfield";
  		}

  		return type;
  	}



  }
  var Input = new InputClasses();
}
