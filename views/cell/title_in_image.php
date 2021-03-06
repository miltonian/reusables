<?php

	namespace Reusables;

	extract( Cell::prepareCell( $identifier ) );


	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "html_text", "celldate", "celltype", "slug", "title" ], 
		[],
		$identifier
	);

?>


<style>
</style>

<a href="<?php echo $linkpath ?>">
<div class="viewtype_cell title_in_image main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" style="background-image: url(<?php echo $viewdict['featured_imagepath'] ?>)">
		<div class="title_in_image gradient"></div>
		<label class="title_in_image title mobile"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
		<label class="title_in_image title desktop"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
		<?php if($celldate!=""){ ?>
			<label class="title_in_image date"><?php echo $celldate ?></label>
		<?php } ?>
	</div>
</a>

<script>

	<?php
		Editing::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>