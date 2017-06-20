<?php

	/*
		$tabledict = [
			"postarray"=>array()
		]
	*/

	require_once('../reusables/classes/classes.php');
	include_once '../reusables/classes/shortcuts.php';
	$ReusableClasses = new Reusables\Classes\ReusableClasses();
	$shortcuts = new Reusables\Classes\Shortcuts();
?>

<style>
	.table_1 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.table_1 .header { position: relative; display: inline-block; padding: 20px 40px; margin: 0; width: calc( 100% - 80px ); }
			.table_1 .header #title { display: inline-block; position: relative; margin: 0px 0px; padding: 0; width: 100%; }
			.table_1 .header #divider { display: inline-block; position: absolute; padding: 0; margin: 0px; bottom: 0; width: calc( 100% - 80px ); height: 2px; background-color: #333333; left: 40px; }
		.table_1 .table { position: relative; display: inline-block; padding: 0px 30px; margin: 0; width: calc( 100% - 60px ); text-align: center; }
			.table_1 .cells-wrapper { position: relative; display: table; margin: 0; padding: 0; }
@media (min-width: 0px) {
	.table_1 .header #title { text-align: center; }
}
@media (min-width: 768px) {
	.table_1 .header #title { text-align: left; }
}
</style>

<div class="table_1">
	<div class="table">
		<?php 
			$i=0;
			foreach ($tabledict['postarray'] as $post) { 
				$ReusableClasses->cell( "cell_9", $post );
			}
			$i++;
		?>
	</div>
</div>

<script>
</script>