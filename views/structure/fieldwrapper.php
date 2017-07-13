<?php

namespace Reusables;
	
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

</style>

<div class="<?php echo $identifier ?> fieldwrapper main" style="width: calc(<?php echo $size ?> - 40px);">
	<?php foreach($structuredict['maincolumn'] as $view){
		echo $view;
	} ?>
</div>

<script>
</script>