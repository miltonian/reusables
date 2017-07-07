<?php
	//3 cells inline (cell3)
?>

<style>
</style>


<div class="<?php echo $identifier ?> inline_images">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<?php 
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo "<div class='image' style='background-image: url(" . $sectiondict['postarray'][0]['imagepath'] .");' ></div>";
				echo '</div>';
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo "<div class='image' style='background-image: url(" . $sectiondict['postarray'][1]['imagepath'] . ");'></div>";
				echo '</div>';
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo "<div class='image' style='background-image: url(" . $sectiondict['postarray'][2]['imagepath'] . ");'></div>";
				echo '</div>';
			?>
			
		</div>
	</div>
</div>

<script>
	
</script>