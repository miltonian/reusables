<?php

namespace Reusables;

	/*
		$viewdict = [
			"left_imagepath"=>"",
			"right_imagepath"=>""
		]
	*/

		// exit( json_encode( Data::getValue($viewdict['left_imagepath']) ) );

		$left_linkpath = Data::getValue( $viewdict, "left_link" );
		$right_linkpath = Data::getValue( $viewdict, "right_link" );

?>

<style>
</style>

<div class="viewtype_section <?php echo $identifier ?> section_8 main">
	<div class="section_8 wrapper">
		<?php if( $left_linkpath != "" ) { ?>
			<a href="<?php echo $left_linkpath ?>" >
		<?php } ?>
		<div class="section_8 left" style="background-image: url('<?php echo Data::getValue($viewdict, 'left_imagepath') ?>');"></div>
		<?php if( $left_linkpath != "" ) { ?>
			</a>
		<?php } ?>
		<?php if( $right_linkpath != "" ) { ?>
			<a href="<?php echo $right_linkpath ?>">
		<?php } ?>
		<div class="section_8 right" style="background-image: url('<?php echo Data::getValue($viewdict, 'right_imagepath') ?>');"></div>
		<?php if( $right_linkpath != "" ) { ?>
			</a>
		<?php } ?>
	</div>
</div>

<script>
</script>