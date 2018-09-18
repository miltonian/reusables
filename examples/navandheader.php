<?php 

$navdict = [
	"brandname" => "Navbar Logo",
	"pages" => [
		[ "name" => "Page1", "classname" => "page1_class", "slug"=>"#", "position"=>"right" ],
		[ "name" => "Page2", "classname" => "page1_class", "slug"=>"#", "position"=>"right" ],
		[ "name" => "Page3", "classname" => "page1_class", "slug"=>"#", "position"=>"right" ],
	]
];
$headerdict = [ "title"=>"This is a Header!" ];

// DATA
Reusables\Data::add( $navdict, "navbar" );
Reusables\Data::add( $headerdict, "main_header" );

Reusables\ReusableClasses::startpage( __FILE__ );


	echo Reusables\Nav::make( "slim", "navbar" );
	echo Reusables\Header::make( "underline_edit", "main_header" );


Reusables\ReusableClasses::endpage( "", __FILE__ );