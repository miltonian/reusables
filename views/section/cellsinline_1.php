<?php

namespace Reusables;

$required = array(
	"postarray"=>array("link", "name|imagepath|emoji"), 
	"title"=>""
);

ReusableClasses::checkRequired( $identifier, $sectiondict, $required );



echo Structure::make( 
	"structure_2",
	[
		"maincolumn"=>array(
			Header::make(
				"linethrough_1",
				[
					"title" => $sectiondict['title']
				],
				"testsection_header"
			),
			Section::make( 
				"threecellsinline_1",
				[
					"postarray" => array( $sectiondict['postarray'][0], $sectiondict['postarray'][1], $sectiondict['postarray'][0] ),
					"cellname" => "cell_2",
					"cellactions" => []
				],
				"testsection"
			)
		)
	],
	$identifier
);