#reusables
-Alexander Hamilton






Basic Guidelines

- write your own functions where you retrieve/deal with data in the /reusables/classes/CustomData directory with the namespace of CustomaData.
- create pages in the views directory from the root directory.
- add paths to pages in the index.php file
- add your own css to style pages in reusables/customcss. create a file with the same name as the page you want to modify ( with file extension .css ). if the page is in a directory ( or directories ) within /views then create that same directory in /customcss and place your custom css file in it

- in each page, add the following functions and add reusable views in between the two function:
	ReusableClasses::startpage( __FILE__ );
	ReusableClasses::endpage( "", __FILE__ );
- in the first parameter of the endpage function, add the directory the page is in, if its in the /views root directory then leave it as "". 
- when dealing with data in CustomData, make sure you return it to a variable in the format below (desired data format)
	- most of the time this can easily be done by first specifying the conditions (e.g. [ [ "key"=>"","value"=>"" ], [ "key"=>"","value"=>"" ] ] ). Make sure your condition keys are also in the returned dict/array. now pass both the data ( e.g. from an sql query ) and the conditions through the function \ReusableClasses::toValueAndDBInfo( $data, $conditions, "" ) where the third parameter is the default tablename
- this returns the array in a format very similar to the "desired data format". the only difference is that the array inside "value" is the same array returned previously (e.g. from the sql query). 
- when getting the above data in a page, we will save this array in the data class with this function: Data::addData( $data, $unique_identifier )
- then translate the data into the format each reusable view will understand with this function: formatForDefaultData( $dataid )
	- assign the returned value to a variable
- you can then add custom key value pairs to that variable by: $array[customkey] = customvalue
- data format for reusable view:
	data:
	{
		"value": {
			key: { "data_id": "", "key": "", "index": "" },
			key: { "data_id": "", "key": "", "index": "" },
			key: { "data_id": "", "key": "", "index": "" }
		},
		"db_info": {
			"tablenames": {
				{ key: tablename }
			},
			"conditions": {
				{ "key": "", "value": ""},
				{ "key": "", "value": ""}
			}
		}
	}
- echo each root reusable view
- each reusable view has a set of parameters you can define
- to add an existing reusable view to a page call the reusable view class (e.g. Header is the class for all the headers) then call the make function
	- this is different for wrappers, you call the wrapper class (Wrapper) then the function name is the same as the reusable view filename
- there are three parameters when calling the make function (filename, data, identifier)
	- two parameters for wrapper (data, identifier)
- to connect to your database change the information in the classes/CustomData/config.php and classes/CustomData/db_pdo.php files


nav 
	data:
	{
		"logo|brandname"=>text or imagepath,
		"pages": {

		}
	}

