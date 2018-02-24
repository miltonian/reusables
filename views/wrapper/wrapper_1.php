<?php

namespace Reusables;

	/*
		$children = array(["viewtype"=>"","filename"=>"", "data"=>""])
		$wrapperdict = [ "children"=>$children ]
	*/

?>

<style>
</style>

<div class="viewtype_wrapper <?php echo $identifier ?> wrapper_1 main">
	<?php

		foreach ($children as $child) {
			echo $child;
		}
	?>
</div>

<script>
</script>