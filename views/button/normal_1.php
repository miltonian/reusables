<?php
namespace Reusables;

?>

<button class="<?php echo $identifier ?> normal_1"><?php echo Data::getValue( $viewdict, 'title' ) ?></button>

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