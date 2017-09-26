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
var viewdict = <?php echo json_encode($viewdict) ?>;
var images = viewdict['images']
var num_images = images.length


function slider_3_start(){
	slider_3.startslider( images );
}

</script>