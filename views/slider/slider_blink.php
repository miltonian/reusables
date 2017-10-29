<?php 

namespace Reusables;

	Views::setParams( 
		[ "images"=>[] ], 
		[],
		$identifier
	);

?>

<style>
</style>


<div class="viewtype_slider slider_blink main <?php echo $identifier ?>">
	<div class="slider_blink two image"></div>
	<div class="slider_blink one image"></div>
</div>


<script>
var viewdict = <?php echo json_encode($viewdict) ?>;
var images = viewdict['images']
var num_images = images.length


function slider_blink_start(){
	slider_blink.startslider( images );
}

</script>