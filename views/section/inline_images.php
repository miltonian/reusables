<?php
	//3 cells inline (cell3)

	// exit( json_encode(  $sectiondict['postarray'] ) );

	$image1 = Data::formatCellWithDefaultData( $identifier . "_posts", 0 );
	$image2 = Data::formatCellWithDefaultData( $identifier . "_posts", 1 );
	$image3 = Data::formatCellWithDefaultData( $identifier . "_posts", 2 );

	// exit( json_encode( Data::getValue($image1['imagepath']) ) );
?>

<style>
</style>


<div class="<?php echo $identifier ?> inline_images main">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<?php 
				echo '<div class="inline_images post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo "<div class='inline_images image' style='background-image: url(" . Data::getValue($image1['imagepath']) .");' ></div>";
				echo '</div>';
				echo '<div class="inline_images post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo "<div class='inline_images image' style='background-image: url(" . Data::getValue($image2['imagepath']) . ");'></div>";
				echo '</div>';
				echo '<div class="inline_images post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo "<div class='inline_images image' style='background-image: url(" . Data::getValue($image3['imagepath']) . ");'></div>";
				echo '</div>';
			?>
			
		</div>
	</div>
</div>

<script>
	
</script>