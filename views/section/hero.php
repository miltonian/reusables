<?php

namespace Reusables;

	Views::setParams( 
		[ "imagepath", "title", "subtitle", "slug" ], 
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
		.hero { cursor: pointer; }
			.hero:hover { opacity: 0.8; }
	<?php } ?>
		.hero.link { position: absolute; display: inline-block; margin: 0; padding: 0; width: 100%; height: 100%; }
	<?php if( $linkpath == "" && $optiontype == "") { ?>
		/*.hero.link { display: none; }*/
	<?php } ?>
</style>

<div class="viewtype_section hero <?php echo $identifier ?> main clicktoedit">
		<div class="hero backgroundimage" style="background-image: url('<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>');">
			<div class="hero overlay"></div>
			<div class="hero header">
				<img class="hero" id="logo" src="<?php echo Data::getValue( $viewdict, 'logo' ) ?>">
				<h3 class="hero" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h3>
				<h3 class="hero" id="subtitle"><?php echo Data::getValue( $viewdict, 'subtitle' ) ?></h3>
			</div>
		</div>
	<a class="hero link" href="<?php echo $linkpath ?>"></a>
</div>

<script>

		$('.<?php echo $identifier ?>.hero.clicktoedit').click(function(e){
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})


</script>