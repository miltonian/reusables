<?php

namespace Reusables;

	//3 cells inline (cell3)

	// exit( json_encode(  $viewdict['postarray'] ) );

	// $image1 = Data::formatCellWithDefaultData( $identifier, 0 );
	// $image2 = Data::formatCellWithDefaultData( $identifier, 1 );
	// $image3 = Data::formatCellWithDefaultData( $identifier, 2 );

$image1 = Data::getValue( $viewdict, 0);
$image2 = Data::getValue( $viewdict, 1);
$image3 = Data::getValue( $viewdict, 2);

	$image1_options['pre_slug'] = Data::getValue( $viewoptions, 'pre_slug' );
	if( isset( $image2 ) ){
		$image2_options['pre_slug'] = Data::getValue( $viewoptions, 'pre_slug' );
	}
	if( isset( $image3 ) ){
		$image3_options['pre_slug'] = Data::getValue( $viewoptions, 'pre_slug' );
	}

	if( isset( $viewdict['convert_keys'] ) ){
		$image1_options['convert_keys'] = $viewoptions['convert_keys'];
		$image1_options = Data::convertKeys( $image1 );
		
		if( isset( $image2 ) ){
			$image2_options['convert_keys'] = $viewoptions['convert_keys'];
			$image2_options = Data::convertKeys( $image2 );
		}

		if( isset( $image3 ) ){
			$image3_options['convert_keys'] = $viewoptions['convert_keys'];
			$image3_options = Data::convertKeys( $image3 );
		}
	}

	$image1_link = Data::getValue( $image1, 'link' );
	$image2_link = Data::getValue( $image2, 'link' );
	$image3_link = Data::getValue( $image3, 'link' );
// exit( json_encode( $image1 ) );

?>

<style>
</style>


<div class="viewtype_section <?php echo $identifier ?> inline_images main">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<?php 
				if( $image1_link != "" ){
					echo "<a href=" . Data::getValue( $image1, 'pre_slug' ) . $image1_link . ">";
				}
					echo '<div class="inline_images post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0;">';
						echo "<div class='inline_images image' style='background-image: url(" . Data::getValue($image1, 'imagepath') .");' >
							<label class='inline_images title'>" . Data::getValue( $image1, 'title' ) . "</label>
						</div>";
					echo '</div>';
				if( $image1_link != "" ){
					echo "</a>";
				}
				if(isset($image2)){
					if( $image2_link != "" ){
						echo "<a href=" . Data::getValue( $image2, 'pre_slug' ) . $image2_link . ">";
					}
					echo '<div class="inline_images post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0;">';
						echo "<div class='inline_images image' style='background-image: url(" . Data::getValue($image2, 'imagepath') . ");'>
							<label class='inline_images title'>" . Data::getValue( $image2, 'title' ) . "</label>
						</div>";
					echo '</div>';
					if( $image2_link != "" ){
						echo "</a>";
					}
				}
				
				if(isset($image3)){
					if( $image3_link != "" ){
						echo "<a href=" . Data::getValue( $image3, 'pre_slug' ) . $image3_link . ">";
					}
					echo '<div class="inline_images post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0;">';
						echo "<div class='inline_images image' style='background-image: url(" . Data::getValue($image3, 'imagepath') . ");'>
							<label class='inline_images title'>" . Data::getValue( $image3, 'title' ) . "</label>
						</div>";
					echo '</div>';
					if( $image3_link != "" ){
						echo "</a>";
					}
				}
			?>
			
		</div>
	</div>
</div>

<script>
	
</script>