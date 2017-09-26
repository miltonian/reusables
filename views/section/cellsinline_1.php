<?php

namespace Reusables;

$required = array(
	"postarray"=>array("link", "name|imagepath|emoji"), 
	"title"=>""
);

ReusableClasses::checkRequired( $identifier, $viewdict, $required );



echo Structure::make( 
	"structure_2",
	[
		"maincolumn"=>array(
			Header::make(
				"linethrough_1",
				[
					"title" => $viewdict['title']
				],
				"testsection_header"
			),
			Section::make( 
				"threecellsinline_1",
				[
					"postarray" => array( $viewdict['postarray'][0], $viewdict['postarray'][1], $viewdict['postarray'][0] ),
					"cellname" => "cell_2",
					"cellactions" => []
				],
				"testsection"
			)
		)
	],
	$identifier
);