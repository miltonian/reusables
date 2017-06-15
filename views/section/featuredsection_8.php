<?php

	require_once('../reusables/classes/classes.php');
	include_once '../reusables/classes/shortcuts.php';
	$ReusableClasses = new Reusables\Classes\ReusableClasses();
	$shortcuts = new Reusables\Classes\Shortcuts();

?>

<style>
	.section_8 { display: inline-block; position: relative; margin: 20px; padding: 20px; background-color: white; border: 1px solid #e0e0e0; border-radius: 10px; width: calc( 100% - 80px ); }
</style>

<div class="section_8">
	<?php
		$ReusableClasses->table( $sectiondict['child'], $sectiondict );
	?>
</div>

<script>
</script>