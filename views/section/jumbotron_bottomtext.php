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
	Views::setParams( 
		[ "imagepath", "logo", "title", "slug" ], 
		[],
		$identifier
	);

	$viewdict = Data::convertKeys( $viewdict );

	if( isset( $viewdict['value'] ) ){ 
		$data_id = $identifier;
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

<div class="viewtype_section jumbotron_bottomtext <?php echo $identifier ?> main clicktoedit">
		<div class="backgroundimage" style="background-image: url('<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>');">
			<div class="gradient"></div>
		</div>
		<div class="header">
			<img id="logo" src="<?php echo Data::getValue( $viewdict, 'logo' ) ?>">
			<h3 id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h3>
		</div>
	<a class="jumbotron_bottomtext link" href="<?php echo $linkpath ?>"></a>
</div>

<script>

		$('.jumbotron_bottomtext.clicktoedit').click(function(e){
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})


</script>