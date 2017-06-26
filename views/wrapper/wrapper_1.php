<?php

	/*
		$children = array(["viewtype"=>"","filename"=>"", "data"=>""])
		$wrapperdict = [ "children"=>$children ]
	*/

?>

<style>
	.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 20px 0px; padding: 20px; background-color: white; border: 1px solid #e0e0e0; border-radius: 10px; width: calc( 100% - 40px ); }
</style>

<div class="<?php echo $identifier ?>">
	<?php

		foreach ($children as $child) {
			echo $child;
		}
	?>
</div>

<script>
</script>