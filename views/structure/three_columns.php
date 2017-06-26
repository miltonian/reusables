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

<div class="<?php echo $identifier ?>">
	<div class="sidecolumn_left">
		<?php 
			foreach ($structuredict['sidecolumn_left'] as $view) {
				echo $view;
			}
		?>
	</div>
	<div class="maincolumn">
		<?php 
			foreach ($structuredict['maincolumn'] as $view) {
				echo $view;
			}
		?>
	</div>
	<div class="sidecolumn_right">
		<?php 
			foreach ($structuredict['sidecolumn_right'] as $view) {
				echo $view;
			}
		?>
	</div>
</div>

<script>
</script>