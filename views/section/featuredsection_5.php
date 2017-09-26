<?php

namespace Reusables;

	//3 cells inline (cell3)
?>

<style>
</style>


<div class="<?php echo $identifier ?> featuredsection_5">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<?php 
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo Cell::make( "cell_3", $viewdict['postarray'][0], $identifier . "-leftpost" );
				echo '</div>';
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo Cell::make( "cell_3", $viewdict['postarray'][1], $identifier . "-midpost" );
				echo '</div>';
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position: relative; margin: 0; padding: 0;">';
					echo Cell::make( "cell_3", $viewdict['postarray'][2], $identifier . "-rightpost" );
				echo '</div>';
			?>
			
		</div>
	</div>
</div>

<script>
	
</script>