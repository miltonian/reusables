<?php

		namespace Reusables;

		extract( Cell::prepareCell( $identifier ) );

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "html_text", "celldate", "celltype", "slug", "price", "title", "desc" ],
		[],
		$identifier
	);
		
?>

<style>
</style>

<div class="viewtype_cell price_text_button main <?php echo $identifier ?>">
	<label class="price_text_button" id="goal">$<?php echo Data::getValue( $viewdict, 'price' ) ?></label>
	<h5 class="price_text_button" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h5>
	<p class="price_text_button" id="desc"><?php echo Data::getValue( $viewdict, 'desc' ) ?></p>
	<a href="<?php echo $linkpath ?>"><button class="price_text_button" id="select">Select</button></a>
</div>

<script>

$('.<?php echo $identifier ?> button#select').click(function(e){
	// e.preventDefault();
	// alert();
});

</script>