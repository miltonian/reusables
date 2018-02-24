<?php 

	namespace Reusables;

	extract( Cell::prepareCell( $identifier ) );

	$category = Data::getValue( $viewdict, 'category' );
	if( $category == "" ) {
		$category = "Category";
	}

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "description", "celldate", "celltype", "title", "html_text", "slug" ],
		[],
		$identifier
	);

?>

<style>
</style>



<div class="viewtype_cell category_and_text main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="category_and_text category"><?php echo $category ?></div>
	<h3 class="category_and_text title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h3>
	<label class="category_and_text thedate"><?php echo Data::getValue( $viewdict, 'celldate' ) ?></label>
	<p class="category_and_text desc"><?php echo Data::getValue( $viewdict, 'html_text' ) ?></p>
</div>

<script>

	<?php
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>