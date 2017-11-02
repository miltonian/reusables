<?php

namespace Reusables;

// images => imagepath
// needs 3 images


	Views::setParams( 
		[ ["imagepath", "text"] ], 
		[],
		$identifier
	);

	$images = Data::getValue( $viewdict );
	$first = Data::getValue( $images, 0 );
	$second = Data::getValue( $images, 1 );
	$third = Data::getValue( $images, 2 );

?>

<style>
</style>


<div class="viewtype_section <?php echo $identifier ?> images_title_inline main">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<div class="images_title_inline graylabel" style="position: absolute; display: inline-block; width: 100%; text-align: center; left: 0; z-index: 1;">
				<div class="images_title_inline" id="greybox">
					<div class="images_title_inline  text-container" style="font-size: 0.8em;">
						<?php echo Data::getValue( $viewdict, 'thedate' ) ?> | <?php echo Data::getValue( $viewdict, 'name' ) ?>
					</div>
				</div>
			</div>
			<div class="images_title_inline picture one clicktoedit index_0" style="background-image: url('<?php echo Data::getValue( $first, "imagepath" ) ?>');"></div>
			<div class="images_title_inline picture two clicktoedit index_1" style="background-image: url('<?php echo Data::getValue( $second, "imagepath" ) ?>');"></div>
			<div class="images_title_inline picture three clicktoedit index_2" style="background-image: url('<?php echo Data::getValue( $third, "imagepath" ) ?>');"></div>
		</div>
		<div class="words">
			<div class="text-container">
				<br>
				<label style="font-size: 2.2em;"><?php echo Data::getValue( $viewdict, "text" ) ?></label>
				<br>
				<br>
			</div>
		</div>
	</div>
</div>

<script>
	$('.images_title_inline.clicktoedit').click(function(e){
		<?php
			ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
		?>
	})
</script>