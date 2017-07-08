<?php 

	$required = array(
		"postarray"=>array("link", "name|imagepath|emoji"), 
		"cellactions"=>"",  
		"cellname"=>""
	);

	// ReusableClasses::checkRequired( $identifier, $sectiondict, $required );

	$cellname = Data::getValue( $sectiondict['cellname'] );

?>

<style>
</style>

<div class="<?php echo $identifier ?> threecellinline_1" >
	<div style="display: inline-block; position: relative; width: 100%;">
		<?php 
			echo Cell::make( $cellname, Data::formatCellWithDefaultData( "postarray", 0 ), $identifier . "_cell" );
			echo Cell::make( $cellname, Data::formatCellWithDefaultData( "postarray", 1 ), $identifier . "_cell" );
			echo Cell::make( $cellname, Data::formatCellWithDefaultData( "postarray", 0 ), $identifier . "_cell" );
		?>
	</div>
</div>

<script>
</script>