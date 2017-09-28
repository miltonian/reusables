<?php

		namespace Reusables;

		extract( Cell::prepareCell( $identifier ) );
		
?>

<style>
</style>

<div class="cell_9 main <?php echo $identifier ?>">
	<label class="cell_9" id="goal">$<?php echo Data::getValue( $viewdict, 'price' ) ?></label>
	<h5 class="cell_9" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h5>
	<p class="cell_9" id="desc"><?php echo Data::getValue( $viewdict, 'desc' ) ?></p>
	<a href="<?php echo $linkpath ?>"><button class="cell_9" id="select">Select</button></a>
</div>

<script>

$('.<?php echo $identifier ?> button#select').click(function(e){
	// e.preventDefault();
	// alert();
});

</script>