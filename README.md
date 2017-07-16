# Reusables
* By Alexander Hamilton






## Basic Guidelines and How-to

* write your own functions where you retrieve/deal with data in the /reusables/classes/CustomData directory with the namespace of CustomaData.
* create pages in the views directory from the root directory.
* add paths to pages in the index.php file
* add your own css to style pages in reusables/customcss. create a file with the same name as the page you want to modify ( with file extension .css ). if the page is in a directory ( or directories ) within /views then create that same directory in /customcss and place your custom css file in it

* in each page, add the following functions and add reusable views in between the two function:
	```
	ReusableClasses::startpage( __FILE__ );
	ReusableClasses::endpage( "", __FILE__ );
	```
* in the first parameter of the endpage function, add the directory the page is in, if its in the /views root directory then leave it as "". 
* when dealing with data in CustomData, make sure you return it to a variable in the format below (desired data format)
	* most of the time this can easily be done by first specifying the conditions (e.g. [ [ "key"=>"","value"=>"" ], [ "key"=>"","value"=>"" ] ] ). Make sure your condition keys are also in the returned dict/array. now pass both the data ( e.g. from an sql query ) and the conditions through the function \ReusableClasses::toValueAndDBInfo( $data, $conditions, "" ) where the third parameter is the default tablename
* this returns the array in a format very similar to the "desired data format". the only difference is that the array inside "value" is the same array returned previously (e.g. from the sql query). 
* when getting the above data in a page, we will save this array in the data class with this function: Data::addData( $data, $unique_identifier )
* then translate the data into the format each reusable view will understand with this function: formatForDefaultData( $dataid )
	* assign the returned value to a variable
* you can then add custom key value pairs to that variable by: $array[customkey] = customvalue
* data format for reusable view:
	```
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
	```
* echo each root reusable view
* each reusable view has a set of parameters you can define
* to add an existing reusable view to a page call the reusable view class (e.g. Header is the class for all the headers) then call the make function
	* this is different for wrappers, you call the wrapper class (Wrapper) then the function name is the same as the reusable view filename
* there are three parameters when calling the make function (filename, data, identifier)
	* two parameters for wrapper (data, identifier)
* to connect to your database change the information in the classes/CustomData/config.php and classes/CustomData/db_pdo.php files

* when dealing with data from the database, if you get from a "custom" table then use the function: Data::convertFromCustomTable( $data ) to turn it into a normal dictionary with key value pairs
* add the condition keys you'll need to change something in the data you fetched, leave the condition values as ""
* the condition values will come from this array that you fetched from the database, make sure the condition keys match the specific keys in the fetched data array. if certain keys you need for the condition aren't present in the data, add them right after the convertFromCustomTable function (if from customtable)
* convert data into default data by using the function: ReusableClasses::toValueAndDBInfo( $data, $conditions, $tablename )

* add this to include reusable assets 
	```
	<link rel=stylesheet href='/vendor/miltonian/reusables/assets/css/reusables.css' type=text/css>
	<script src='/vendor/miltonian/reusables/assets/js/reusable.js'></script>
	<script src='/vendor/miltonian/reusables/assets/js/ReusableClasses.js'></script>
	
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
	```

NAV
	example
	```
	data:
	[
		"logo|brandname"=>imagepath/text,
		"pages": {
			[ 
				"name"=>"", 
				"classname" => "", 
				"slug" => "", 
				"imagepath" => "", 
				"position" => "left/right", 
				"buttons" => array(
					[ "name" => "", "classname", "slug" => "" ]
				)
			]
		}
	]
	```

### HEADER
	* example
	```
	data:
	[
		"title" => "",
		"buttons" => array(
			[ "name"=>"", "classname"=>"", "type"=>"modal|link", "modal"=>[ "parentclass"=>"", "modalclass"=>"" ] ]
		)
	]
	```

in the above data, parentclass is for the outer most wrapper ( inside modal_background ) and modalclass is the main class inside the form in the modal


* make a form inside modal
```
echo Reusables\Structure::make(
	"modal_background",
	[
		Reusables\Wrapper::wrapper1(
			[],
			array(
				Reusables\Structure::make(
					"modalinner_1",
					[
						"title"=>"",
						"first"=>array(
							"<form class='theform' method='post' action='/edit_view.php' enctype='multipart/form-data'>",
							/* views inside form go here*/
							"/form"
						)
					],
					"editstructure"
				)
			),
			"editwrapper"
		)
	],
	"modalbackground"
);
```


### FORM 
	* for now, you have to create your own form. but its easy
	* create the php script for you form in the /views/CustomView directory
	* put this at the top of the file:
		```
		namespace Reusables\CustomView;
		extract( \Reusables\CustomView::makeFormVars( $customviewdict ) );
		```
	* now you have these already defined vars to work with: $data_id, $default_tablename, $customviewdict
	* put this right after "?>"
		```
		<div class="<?php echo $identifier ?> form_simple_2 main">
			<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
				<input type="hidden" name="goto" value="userprofile">

				// put your code here

				<button class="modalinner_1 save custombutton">Save</button>
			</div>
		</div>
		```
	* where it says "put your code here", put your code to make the form content
	* after the last <div> in this file, add this:
		```
		<script>
			var customviewdict = <?php echo json_encode($customviewdict) ?>;
			var dataarray = <?php echo json_encode( \Reusables\Data::getFullArray( $customviewdict ) ) ?>;
			var identifier = "<?php echo $identifier ?>";
			class <?php echo $identifier ?>Classes {
				populateview(index=null){
					// put your code here
					// use the below functions to add values and conditions to the form inputs
					/*
						Reusable.updateTextField( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
						Reusable.updateTextArea( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
						Reusable.updateFileImage( dataarray, identifier, data_id, key, inputclass, db_key, index=null )
						Reusable.updateWysi( dataarray, identifier, data_id, key, inputclass, db_key, index, fieldindex )
					*/
				}
			}
			if(<?php echo $identifier ?> !== undefined || <?php echo $identifier ?> !== null) {
				let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
				<?php echo $identifier ?>.populateview();
			}
		</script>
		```
	* again, where it says "put your code here", put your code to make the form content
	* after this you're done creating the form


### SECTION

	* most sections require a unique set of parameters so you have to look in the section file to see what exactly it needs
	* for example, we'll look at the section: threecellsinline_1
	```
	data:
	[
		"cellname"=>"",
		identifier . "_posts"
	]
	```


### TABLE

	* get data the same way as you do the other views
	 	* here's a brief overview of getting data
		 	* customdata -> query from db
		 	* conditions
		 	* toValueAndDBInfo
		 	* then return the data to the page file
		 	* addData( $data, $identifier )
		 		* IMPORTANT: the identifier of this must be the same plus "_posts" as the table identifer you are going to assign this to
		 			* e.g. 
		 				table identifier: "maintable"
		 				data_id: "maintable_posts"
	 	* now for the other reusable views you would normally call formatForDefaultData( $dataid )
	 	* instead of calling that function, call Data::retrieveDataWithID( $data_id ) and assign to variable
	 	* make dictionary where the above variable equals the key: tableidentifier + "_posts" ( like the above example )
	 	* now add a "cellname" key value pair to that table dict with the filename of the cell you would like to use ( minus the .php )
	 	* the default link on each cell in the table is to go to the posts slug. to add a "pre_slug" (before the slug) to the link, simply add a preslug key value pair to the table dictionary. to change the slug, add a "slug" key value pair to the table dictionary

### STRUCTURE

	* most structures have a "maincolumn", which is where you put an array of views
	```
	echo Structure::make(
		"structure_2",
		[
			"maincolumn" => array(
				// here is where you put your views inside of the structure
				// you also don't need to echo views that are inside of other views
				// for example
				Header::make( "header_5", $headerdict, "headeridentifier" )
			)
		],
		"structure_identifier"
	)
	```

### WRAPPER

	* set up like:
		```
		echo Wrapper::wrapper1( 
			[], 
			array(
				// here are the views inside of the wrapper
				// view 1,
				// view 2
			),
			"wrapper_identifier"
		)
		```



