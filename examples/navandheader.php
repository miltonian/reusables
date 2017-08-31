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
Reusables\Data::addData( $navdict, "navbar" );
Reusables\Data::addData( $headerdict, "main_header" );

Reusables\ReusableClasses::startpage( __FILE__ );


	echo Reusables\Nav::make( "navbar_4", "navbar" );
	echo Reusables\Header::make( "header_3", "main_header" );


Reusables\ReusableClasses::endpage( "", __FILE__ );