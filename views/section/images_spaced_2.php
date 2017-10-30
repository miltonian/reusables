<?php

namespace Reusables;

	Views::setParams( 
		[ ["slug", "imagepath"] ], 
		[],
		$identifier
	);
	/*
		$viewdict = [
			"left_imagepath"=>"",
			"right_imagepath"=>""
		]
	*/

		// exit( json_encode( Data::getValue($viewdict['left_imagepath']) ) );

		// $left_linkpath = Data::getValue( $viewdict, "left_link" );
		// $right_linkpath = Data::getValue( $viewdict, "right_link" );

$leftarray = Data::getValue( $viewdict, 0 );
$rightarray = Data::getValue( $viewdict, 1 );
// exit( json_encode( $leftarray ) );
$left_linkpath = Data::getValue( $leftarray, 'slug' );
$right_linkpath = Data::getValue( $rightarray, 'slug' );

?>

<style>
</style>

<div class="viewtype_section <?php echo $identifier ?> section_8 main">
	<div class="section_8 wrapper">
		<?php if( $left_linkpath != "" ) { ?>
			<a href="<?php echo $left_linkpath ?>" >
		<?php } ?>
		<div class="section_8 left" style="background-image: url('<?php echo Data::getValue($leftarray, 'imagepath') ?>');"></div>
		<?php if( $left_linkpath != "" ) { ?>
			</a>
		<?php } ?>
		<?php if( $right_linkpath != "" ) { ?>
			<a href="<?php echo $right_linkpath ?>">
		<?php } ?>
		<div class="section_8 right" style="background-image: url('<?php echo Data::getValue($rightarray, 'imagepath') ?>');"></div>
		<?php if( $right_linkpath != "" ) { ?>
			</a>
		<?php } ?>
	</div>
</div>

<script>
</script>