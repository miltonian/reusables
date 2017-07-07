<?php 

$required = array(
	"steps"=>[]
);

// ReusableClasses::checkRequired( $identifier, $headerdict, $required );

?>

<style>
.steps_1 .step { width: <?php echo (100 / sizeof($headerdict['steps'])); ?>%; }
</style>

<div class="<?php echo $identifier ?> steps_1" >
	<?php foreach (Data::getValue( $headerdict['steps'] ) as $s) { ?>
		<div class="step">
			<label id="title"><?php echo $s['title'] ?></label>
			<p id="subtitle"><?php echo $s['subtitle'] ?></p>
		</div>
	<?php } ?>
</div>

<script>
</script>