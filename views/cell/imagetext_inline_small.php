<?php

namespace Reusables;

	/*
		[
			"id"=>"",
			"title"=>"",
			"imagepath"=>"",
			"html_text"=>"",
			"isfeatured"=>""
		]
	*/
	
	extract( Cell::prepareCell( $identifier ) );



	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "html_text", "celldate", "celltype", "slug", "imagepath", "title" ],
		[],
		$identifier
	);

?>

<style>
</style>


<div class="viewtype_cell imagetext_inline_small main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>">
	<div class="imagetext_inline_small leftdiv">
		<a href="<?php echo $linkpath ?>"><div class="imagetext_inline_small image" style="background-image: url('<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>');"></div></a>
	</div>
	<div class="imagetext_inline_small rightdiv">
		<a href="<?php echo $linkpath ?>"><label class="imagetext_inline_small title"><?php echo Data::getValue( $viewdict, 'title') ?></label></a>
	</div>
</div>


<script>

	<?php
		Editing::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>