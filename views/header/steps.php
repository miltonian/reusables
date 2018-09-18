<?php

namespace Reusables;


$steps = Data::getValue( $viewdict, 'steps' );
if( $steps == "" ){
	$steps = [];
}


	Views::setParams(
		[ "steps"=>["title", "subtitle"] ],
		[],
		$identifier
	);


?>

<style>
	.steps.step { width: <?php echo (100 / sizeof($viewdict['steps'])); ?>%; }
</style>

<div class="viewtype_header <?php echo $identifier ?> steps main" >
	<?php $i=0; ?>
	<?php foreach ( $steps as $s) { ?>
		<div class="steps step">
			<label class="steps title index_<?php echo $i ?>" ><?php echo $s['title'] ?></label>
			<p class="steps subtitle index_<?php echo $i ?>"><?php echo $s['subtitle'] ?></p>
		</div>
		<?php $i++ ?>
	<?php } ?>
	<div class="steps underline" style="width: <?php echo floatval(100 / sizeof( $steps ) ) ?>%"></div>
</div>

<script>
	$('.<?php echo $identifier ?> .steps.step').click(function(){
		var theindexstring = Reusable.getIndexFromClass( "index_", $(this).find( 'label' ) )
		var theindex = parseFloat( theindexstring )
		var leftmargin = (<?php echo floatval(100 / sizeof( $steps ) ) ?> * theindex);
		$('.<?php echo $identifier ?> .steps.underline').animate({ 'left': leftmargin+'%' }, 200)

		gotostep( theindex+1 )
	})
</script>
