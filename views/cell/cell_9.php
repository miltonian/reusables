<?php
// exit( json_encode( $celldict['price'] ) );
?>

<style>
</style>

<div class="cell_9 <?php echo $identifier ?>">
	<label id="goal"><?php echo Data::getValue( $celldict['price'] ) ?></label>
	<h5 id="title"><?php echo Data::getValue( $celldict['title'] ) ?></h5>
	<p id="desc"><?php echo Data::getValue( $celldict['desc'] ) ?></p>
	<button id="select">Select</button>
</div>

<script>

$('.<?php echo $identifier ?> button#select').click(function(e){
	e.preventDefault();
	alert();
});

</script>