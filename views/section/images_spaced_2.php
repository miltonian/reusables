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
		<a class="section_8 link clicktoedit index_0" href="<?php echo $left_linkpath ?>" >
			<div class="section_8 left" style="background-image: url('<?php echo Data::getValue($leftarray, 'imagepath') ?>');"></div>
		</a>
		<a class="section_8 link clicktoedit index_1" href="<?php echo $right_linkpath ?>">
			<div class="section_8 right" style="background-image: url('<?php echo Data::getValue($rightarray, 'imagepath') ?>');"></div>
		</a>
	</div>
</div>

<script>

		$('.section_8.clicktoedit').click(function(e){
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})

</script>