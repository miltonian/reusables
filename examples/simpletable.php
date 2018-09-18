<?php 

/* To connect the data to the reusable views, simply use the same identifier for each */

$headerdict = [ "title"=>"This is a Header!" ];

// this is for each individual cell in the table
$celldict = [
	"featured_imagepath" => "/vendor/miltonian/reusables/images/most-beautiful-places-in-the-world_g25_mobi.jpg",
	"imagepath" => "/vendor/miltonian/reusables/images/most-beautiful-places-in-the-world_g25_mobi.jpg",
	"title" => "Cell Title",
	"slug" => "#",
];

// this is the array of table cells
$tablearray = array(
	$celldict,
	$celldict,
	$celldict,
	$celldict,
	$celldict,
	$celldict,
);


// DATA
Reusables\Data::add( $headerdict, "page_header" );
Reusables\Data::add( $tablearray, "table" );

// this is for the table's reusable view
Reusables\Options::add( "imagetext_full", "cellname", "table" );

Reusables\ReusableClasses::startpage( __FILE__ );


	echo Reusables\Header::make( "underline_edit", "page_header" );
	echo Reusables\Table::make( "default", "table" );


Reusables\ReusableClasses::endpage( "", __FILE__ );