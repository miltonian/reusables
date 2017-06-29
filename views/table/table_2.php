<?php

	/*
		$tabledict = [
			"postarray"=>array()
		]
	*/

	$ReusableClasses = new ReusableClasses();
	$shortcuts = new Shortcuts();

?>

<style>
	.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.<?php echo $identifier ?> .header { position: relative; display: inline-block; padding: 20px 40px; margin: 0; width: calc( 100% - 80px ); }
			.<?php echo $identifier ?> .header #title { display: inline-block; position: relative; margin: 0px 0px; padding: 0; width: 100%; }
			.<?php echo $identifier ?> .header #divider { display: inline-block; position: absolute; padding: 0; margin: 0px; bottom: 0; width: calc( 100% - 80px ); height: 2px; background-color: #333333; left: 40px; }
		.<?php echo $identifier ?> .table { position: relative; display: inline-block; padding: 0px 30px; margin: 0; width: calc( 100% - 60px ); text-align: center; }
			.<?php echo $identifier ?> .cells-wrapper { position: relative; display: table; margin: 0; padding: 0; }
@media (min-width: 0px) {
	.<?php echo $identifier ?> .header #title { text-align: center; }
}
@media (min-width: 768px) {
	.<?php echo $identifier ?> .header #title { text-align: left; }
}
</style>

<div class="<?php echo $identifier ?>">
	<div class="table">
		<?php 
			$i=0;
			foreach ($tabledict['postarray'] as $post) { 
				if(isset($tabledict['cellactions'])){ $post['actions'] = $tabledict['cellactions']; }else{ $post['actions'] = array(); }
				$post['index'] = $i;
				echo Cell::make( $tabledict['cellname'], $post, $identifier . "-cell" );
				$i++;
			}
			
		?>
	</div>
</div>

<script>
</script>