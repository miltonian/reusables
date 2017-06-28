<?php
	//3 cells inline (cell3)
?>

<style>

.<?php echo $identifier ?>{ position: relative;display: inline-block;margin: 0;padding: 0;width: 100%;text-align: center; }
	.<?php echo $identifier ?> .picture {position: relative;margin: 0;background-size: cover;background-position: center;margin: 2px;}
	.<?php echo $identifier ?> .words{ position: relative; display: block; margin: 0; padding: 0; width: auto; height: 100px; background-color: white;}
	.<?php echo $identifier ?> .text-container{ position: relative; display: inline-block; top: 50%; transform: translateY(-50%); width: 100%; }
	.<?php echo $identifier ?> .post .image { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 100%; background-size: contain; background-position: center; background-repeat: no-repeat; }

@media (min-width: 0px) {
	.<?php echo $identifier ?> .picture.one, .<?php echo $identifier ?> .picture.three {display: none;}
	.<?php echo $identifier ?> .picture {width: 100%; padding: 0; padding-bottom: 68%;}
	.<?php echo $identifier ?> .post.one, .<?php echo $identifier ?> .post.three {display: none;}
	.<?php echo $identifier ?> .post.two {display: inline-block; width: 100%;}
}
@media (min-width: 768px) {
	.picture {display: inline-block;}
	.picture.one, .picture.three {display: inline-block;}
	.picture {width: 32%; padding: 0; padding-bottom: 28%;}
	.<?php echo $identifier ?> .post.one, .<?php echo $identifier ?> .post.three {display: inline-block; width: 31%;}
	.<?php echo $identifier ?> .post.two {display: inline-block; width: 34%;}
}
</style>


<div class="<?php echo $identifier ?>">
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