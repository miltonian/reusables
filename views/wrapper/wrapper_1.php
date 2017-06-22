<?php

	/*
		$children = array(["viewtype"=>"","filename"=>"", "data"=>""])
		$wrapperdict = [ "children"=>$children ]
	*/

?>

<style>
	.wrapper1 { display: inline-block; position: relative; margin: 20px 0px; padding: 20px; background-color: white; border: 1px solid #e0e0e0; border-radius: 10px; width: calc( 100% - 40px ); }
</style>

<div class="wrapper1">
	<?php
		foreach ($children as $child) {
			$filename = $child['filename'];
			$viewtype = $child['viewtype'];
			$data = $child['data'];
			ReusableClasses::$viewtype( $filename, $data );
		}
	?>
</div>

<script>
</script>