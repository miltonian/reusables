<?php
namespace Reusables;

?>

<button class="<?php echo $identifier ?> normal_1"><?php echo Data::getValue( $buttondict, 'title' ) ?></button>

<script>

	var thismodalclass = "";
	<?php if( $buttondict['type'] == "modal" ){ ?>
		thismodalclass = new <?php echo $buttondict['modal']['modalclass'] ?>Classes();
	<?php }?>



	var buttondict = <?php echo json_encode($buttondict) ?>;
	$('.<?php echo $identifier ?>').click(function(e){
		e.preventDefault();


		Reusable.addAction( buttondict, [thismodalclass], 0 );

	});

</script>