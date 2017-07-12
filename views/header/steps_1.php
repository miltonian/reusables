<?php 

$required = array(
	"steps"=>[]
);

// ReusableClasses::checkRequired( $identifier, $headerdict, $required );

?>

<style>
.steps_1.step { width: <?php echo (100 / sizeof($headerdict['steps'])); ?>%; }
</style>

<div class="<?php echo $identifier ?> steps_1 main" >
	<?php foreach (Data::getValue( $headerdict, 'steps' ) as $s) { ?>
		<div class="steps_1 step">
			<label class="steps_1" id="title"><?php echo $s['title'] ?></label>
			<p class="steps_1" id="subtitle"><?php echo $s['subtitle'] ?></p>
		</div>
	<?php } ?>
</div>

<script>
</script>