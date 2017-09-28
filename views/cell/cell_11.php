<?php 

	namespace Reusables;

	extract( Cell::prepareCell( $identifier ) );

	$category = Data::getValue( $viewdict, 'category' );
	if( $category == "" ) {
		$category = "Category";
	}

?>

<style>
</style>



<div class="cell_11 main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="cell_11 category"><?php echo $category ?></div>
	<h3 class="cell_11 title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h3>
	<label class="cell_11 thedate"><?php echo Data::getValue( $viewdict, 'celldate' ) ?></label>
	<p class="cell_11 desc"><?php echo Data::getValue( $viewdict, 'html_text' ) ?></p>
</div>

<script>

	var thismodalclass = "";
	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $viewoptions['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php }?>



	var viewdict = <?php echo json_encode($viewdict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		// alert( JSON.stringify(thismodalclass ) );
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this );
	});
	
</script>