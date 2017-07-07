<?php

	/*
		$children = array(["viewtype"=>"","filename"=>"", "data"=>""])
		$wrapperdict = [ "children"=>$children ]
	*/

?>

<style>
</style>

<div class="<?php echo $identifier ?> wrapper_1">
	<?php

		foreach ($children as $child) {
			echo $child;
		}
	?>
</div>

<script>
</script>