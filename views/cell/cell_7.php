<?php

	namespace Reusables;

	extract( Cell::prepareCell( $identifier ) );

?>


<style>
</style>

<a href="<?php echo $linkpath ?>">
<div class="cell_7 main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" style="background-image: url(<?php echo $celldict['featured_imagepath'] ?>)">
		<div class="cell_7 gradient"></div>
		<label class="cell_7 title mobile"><?php echo Data::getValue( $celldict, 'title' ) ?></label>
		<label class="cell_7 title desktop"><?php echo Data::getValue( $celldict, 'title' ) ?></label>
		<?php if($celldate!=""){ ?>
			<label class="cell_7 date"><?php echo $celldate ?></label>
		<?php } ?>
	</div>
</a>

<script>

	var thismodalclass = "";
	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $celldict['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullcelldict ) ?>;
	<?php }?>



	var celldict = <?php echo json_encode($celldict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		// alert( JSON.stringify(thismodalclass ) );
		Reusable.addAction( celldict, [thismodalclass], 0, dataarray, this );
	});
	
</script>