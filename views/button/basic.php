<?php
namespace Reusables;

?>

<button class="viewtype_button <?php echo $identifier ?> basic"><?php echo Data::getValue( $viewdict, 'title' ) ?></button>

<script>

	var thismodalclass = "";
	<?php if( $viewdict['type'] == "modal" ){ ?>
		thismodalclass = new <?php echo $viewdict['modal']['modalclass'] ?>Classes();
	<?php }?>



	var viewdict = <?php echo json_encode($viewdict) ?>;
	$('.<?php echo $identifier ?>').click(function(e){
		e.preventDefault();


		Reusable.addAction( viewdict, [thismodalclass], 0 );

	});

</script>