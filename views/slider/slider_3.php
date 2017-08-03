<?php 

namespace Reusables;

?>

<style>
</style>


<div class="slider_3 main <?php echo $identifier ?>">
	<div class="slider_3 two image"></div>
	<div class="slider_3 one image"></div>
</div>


<script>
var sliderdict = <?php echo json_encode($sliderdict) ?>;
var images = sliderdict['images']
var num_images = images.length


function slider_3_start(){
	slider_3.startslider( images );
}

</script>