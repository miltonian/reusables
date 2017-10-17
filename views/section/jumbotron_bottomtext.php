<?php

namespace Reusables;

	/*
		$viewdict = [
			"featured_imagepath"=>"",
			"logo_imagepath"=>"",
			"title"=>"",
			"adposition"=>0,
			"desc"=>""
		]
	*/

	$viewdict = Data::convertKeys( $viewdict );

	if( isset( $viewdict['value'] ) ){ 
		$data_id = $identifier;
		// exit( json_encode( $viewdict ) );
		// $viewdict = Data::formatForDefaultData( $data_id );
	// exit( json_encode( Data::getValue( $viewdict, 'featured_imagepath' ) ) );
		// SHOULD CONTROL DATA WITH ID NOT VAR
	}
	if( isset($viewdict['editing']) ){ $isediting=1; }else{ $isediting=0; }
	

	$linkpath = Data::getValue( $viewoptions, 'pre_slug' ) . Data::getValue( $viewdict, 'slug' );
	if( $linkpath == "" ) {
		$linkpath = "#";
	}
	$optiontype = Data::getValue( $viewoptions, 'type' );
	$fullarray = Data::getFullArray( $viewdict );
if( isset( $viewdict[$identifier]['value'] ) ) {
	$fullviewdict = Data::getFullArray( $viewdict )[$identifier]['value'];
}else{
	$fullviewdict = $viewdict;
}
// exit( json_encode( "aiwljkefnds,cl akjdsmncx alsjdkfbcxailwkejsfdb,fmn" ) );

?>

<style>
	<?php if($isediting){ ?>
		.jumbotron_bottomtext { cursor: pointer; }
			.jumbotron_bottomtext:hover { opacity: 0.8; }
	<?php } ?>

		.jumbotron_bottomtext.link { position: absolute; display: inline-block; margin: 0; padding: 0; width: 100%; height: 100%; }
	<?php if( $linkpath == "" && $optiontype == "") { ?>
		/*.jumbotron_bottomtext.link { display: none; }*/
	<?php } ?>

</style>

<div class="viewtype_section jumbotron_bottomtext <?php echo $identifier ?> main">
		<div class="backgroundimage" style="background-image: url('<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>');">
			<div class="gradient"></div>
		</div>
		<div class="header">
			<img id="logo" src="<?php echo Data::getValue( $viewdict, 'logo_imagepath' ) ?>">
			<h3 id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h3>
		</div>
	<a class="jumbotron_bottomtext link" href="<?php echo $linkpath ?>"></a>
	
</div>

<script>

var viewdict = <?php echo json_encode($viewdict) ?>;
var isediting = <?php echo $isediting ?>;

var viewdict = <?php echo json_encode( $viewdict ) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	var thismodalclass = "";
	<?php $celltype = "" ?>
	var type = <?php echo json_encode( $optiontype ) ?>;

	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $viewoptions['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php } ?>

	var viewdict = <?php echo json_encode($viewdict) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	$('.<?php echo $identifier ?> .jumbotron_bottomtext.link').off().click(function(e){ 

		var optiontype = <?php echo json_encode($optiontype) ?>;
		if( optiontype == "modal" || optiontype == "dropdown" ) { 
			e.preventDefault();
			if( typeof dataarray === "undefined" ) { 
				dataarray = []
			}
			Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
		}

		<?php 
			ReusableClasses::getEditingFunctionsJS( $viewoptions ) ;
		?>

		if( typeof dataarray === "undefined" ) {
			dataarray = []
		}
		var viewdict = <?php echo json_encode($viewdict) ?>;
		var viewoptions = <?php echo  json_encode( $viewoptions ) ?>;
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
		
	});

</script>