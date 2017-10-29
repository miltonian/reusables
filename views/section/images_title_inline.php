<?php

namespace Reusables;

// images => imagepath
// needs 3 images


	Views::setParams( 
		[ ["imagepath", "text"] ], 
		[],
		$identifier
	);

?>

<style>
</style>


<div class="viewtype_section <?php echo $identifier ?> featuredsection_4">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<div class="graylabel" style="position: absolute; display: inline-block; width: 100%; text-align: center; left: 0; z-index: 1;">
				<div id="greybox">
					<div class="text-container" style="font-size: 0.8em;">
						<?php echo Data::getValue( $viewdict, 'thedate' ) ?> | <?php echo Data::getValue( $viewdict, 'name' ) ?>
					</div>
				</div>
			</div>
			<div class="picture one" style="background-image: url('<?php echo Data::getValue( $viewdict['images'][0], "imagepath" ) ?>');"></div>
			<div class="picture two" style="background-image: url('<?php echo Data::getValue( $viewdict['images'][1], "imagepath" ) ?>');"></div>
			<div class="picture three" style="background-image: url('<?php echo Data::getValue( $viewdict['images'][2], "imagepath" ) ?>');"></div>
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
	
</script>