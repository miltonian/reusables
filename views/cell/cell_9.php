<?php

namespace Reusables;

// exit( json_encode( $celldict['price'] ) );
?>

<style>
</style>

<div class="cell_9 main <?php echo $identifier ?>">
	<label class="cell_9" id="goal">$<?php echo Data::getValue( $celldict, 'price' ) ?></label>
	<h5 class="cell_9" id="title"><?php echo Data::getValue( $celldict, 'title' ) ?></h5>
	<p class="cell_9" id="desc"><?php echo Data::getValue( $celldict, 'desc' ) ?></p>
	<button class="cell_9" id="select">Select</button>
</div>

<script>

$('.<?php echo $identifier ?> button#select').click(function(e){
	e.preventDefault();
	// alert();
});

</script>