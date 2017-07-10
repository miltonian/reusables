<?php
	/*
	$structuredict = [ 
		"maincolumn" => array(["viewtype"=>"","filename"=>"", "data"=>""]),
	]
	*/
	if(!isset($structuredict['hasoverlay'])){ $structuredict['hasoverlay']=false; }
?>

<style>
</style>

<div class="<?php echo $identifier ?> structure_2 main">
	<div style="display: <?php if($structuredict['hasoverlay']){ echo "inline-block;"; }else{ echo "none"; } ?>; position: absolute; margin: 0; padding: 0; left: 0; top: 0; background-color: rgba(30, 30, 33, 0.4); width: 100%; height: 100%;"></div>
	<?php 
		foreach ($structuredict['maincolumn'] as $view) {
			// $ReusableClasses->$view['viewtype']( $view['filename'], $view['data'] );
			echo $view;
		}
	?>
</div>

<script>
</script>