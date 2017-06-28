<?php
	
	$required = array(
		"maincolumn"=>"",
		"size"=>""
	);

	ReusableClasses::checkRequired( "fieldwrapper", $structuredict, $required );

	if( $structuredict['size'] == "small" ){
		$size = "33.33%";
	}else if( $structuredict['size'] == "medium" ){
		$size = "66.66%";
	}else if( $structuredict['size'] == "large" ){
		$size = "100%";
	}else {
		$size = $structuredict['size'];
	}

?>

<style>
	.fieldwrapper { display: inline-block; position: relative; margin: 20px; padding: 0; width: calc(<?php echo $size ?> - 40px); float: left; text-align: left; margin-bottom: 5px; }
</style>

<div class="fieldwrapper">
	<?php foreach($structuredict['maincolumn'] as $view){
		echo $view;
	} ?>
</div>

<script>
</script>