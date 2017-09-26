<?php 

namespace Reusables;

$required = array(
	"steps"=>[]
);

// ReusableClasses::checkRequired( $identifier, $viewdict, $required );

$steps = Data::getValue( $viewdict, 'steps' );
if( $steps == "" ){
	$steps = [];
}


?>

<style>
	.steps_1.step { width: <?php echo (100 / sizeof($viewdict['steps'])); ?>%; }
</style>

<div class="<?php echo $identifier ?> steps_1 main" >
	<?php $i=0; ?>
	<?php foreach ( $steps as $s) { ?>
		<div class="steps_1 step">
			<label class="steps_1 title index_<?php echo $i ?>" ><?php echo $s['title'] ?></label>
			<p class="steps_1 subtitle index_<?php echo $i ?>"><?php echo $s['subtitle'] ?></p>
		</div>
		<?php $i++ ?>
	<?php } ?>
	<div class="steps_1 underline" style="width: <?php echo floatval(100 / sizeof( $steps ) ) ?>%"></div>
</div>

<script>
	$('.<?php echo $identifier ?> .steps_1.step').click(function(){
		var theindexstring = Reusable.getIndexFromClass( "index_", $(this).find( 'label' ) )
		var theindex = parseFloat( theindexstring )
		var leftmargin = (<?php echo floatval(100 / sizeof( $steps ) ) ?> * theindex);
		$('.<?php echo $identifier ?> .steps_1.underline').animate({ 'left': leftmargin+'%' }, 200)

		gotostep( theindex+1 )
	})
</script>