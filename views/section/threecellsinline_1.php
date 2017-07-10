<?php 

	$required = array(
		$identifier . "_posts" =>array("link", "name|imagepath|emoji"), 
		"cellactions"=>"",  
		"cellname"=>""
	);

	// ReusableClasses::checkRequired( $identifier, $sectiondict, $required );

	$cellname = Data::getValue( $sectiondict['cellname'] );
	// exit( json_encode( $sectiondict ) );
	$asdf = Data::formatCellWithDefaultData( $identifier . "_posts", 0 );
	// exit( json_encode( $asdf['featured_imagepath'] ) );
	// exit( json_encode( Data::formatCellWithDefaultData( $identifier . "_posts", 0 ) ) );

?>

<style>
</style>

<div class="<?php echo $identifier ?> threecellinline_1 main" >
	<div style="display: inline-block; position: relative; width: 100%;">
		<?php 
			echo Cell::make( $cellname, Data::formatCellWithDefaultData( $identifier . "_posts", 0 ), $identifier . "_cell" );
			echo Cell::make( $cellname, Data::formatCellWithDefaultData( $identifier . "_posts", 1 ), $identifier . "_cell" );
			echo Cell::make( $cellname, Data::formatCellWithDefaultData( $identifier . "_posts", 0 ), $identifier . "_cell" );
		?>
	</div>
</div>

<script>
</script>