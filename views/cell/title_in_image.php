<?php

	namespace Reusables;

	extract( Cell::prepareCell( $identifier ) );

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

	var thismodalclass = "";
	var celltype = <?php echo json_encode( $celltype) ?>;
	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $viewoptions['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php }?>

	var viewdict = <?php echo json_encode($viewdict) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	<?php 
		ReusableClasses::getEditingFunctionsJS( $viewoptions ) 
	?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		e.preventDefault();
		// alert( JSON.stringify( celltype ) )
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
	});
	
</script>