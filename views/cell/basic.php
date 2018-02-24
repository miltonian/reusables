<?php 

	namespace Reusables;

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "description", "celldate", "celltype", "featured_imagepath", "title", "slug" ],
		[],
		$identifier
	);

	$viewdict = Data::convertKeysInTable( $identifier, $viewdict );
	


	extract( Cell::prepareCell( $identifier ) );


	$title = Data::getValue($viewdict, 'title', $table_identifier);
// exit( json_encode( $title ) );
?>

<div class="viewtype_cell basic main <?php echo $identifier ?> index_<?php echo $cellindex ?> index_<?php echo $cellindex ?> clicktoedit" >
	<a href="<?php echo Data::getValue( $viewoptions, 'pre_slug') ?><?php echo Data::getValue( $viewdict, 'slug' ) ?>" class="basic link">
		<p class="basic title"><?php echo $title ?></p>
		<p class="basic description"><?php echo $description ?></p>
	</a>
</div>


<script>

	<?php
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>