<?php 

namespace Reusables;

$required = array(
	"steps"=>[]
);

// ReusableClasses::checkRequired( $identifier, $headerdict, $required );

$steps = Data::getValue( $headerdict, 'steps' );
if( $steps == "" ){
	$steps = [];
}


?>

<style>
.steps_1.step { width: <?php echo (100 / sizeof($headerdict['steps'])); ?>%; }
</style>

<div class="<?php echo $identifier ?> steps_1 main" >
	<?php foreach ( $steps as $s) { ?>
		<div class="steps_1 step">
			<label class="steps_1" id="title"><?php echo $s['title'] ?></label>
			<p class="steps_1" id="subtitle"><?php echo $s['subtitle'] ?></p>
		</div>
	<?php } ?>
</div>

<script>
</script>