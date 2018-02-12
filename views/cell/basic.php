<?php 

	namespace Reusables;

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "description", "celldate", "celltype", "featured_imagepath", "title", "slug" ],
		[],
		$identifier
	);

	$viewdict = Data::convertKeysInTable( $identifier, $viewdict );
	


	extract( Cell::prepareCell( $identifier ) );


?>

<style>
</style>

<div class="viewtype_cell basic main <?php echo $identifier ?> index_<?php echo $cellindex ?> index_<?php echo $cellindex ?> clicktoedit" >
	<a href="<?php echo Data::getValue( $viewoptions, 'pre_slug') ?><?php echo Data::getValue( $viewdict, 'slug' ) ?>" class="basic link">
		<p class="basic title"><?php echo Data::getValue($viewdict, 'title') ?></p>
		<p class="basic description"><?php echo Data::getValue($viewdict, 'description') ?></p>
	</a>
</div>


<script>

	<?php
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>