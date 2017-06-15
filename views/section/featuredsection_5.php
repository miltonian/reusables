<?php
	//3 cells inline (cell3)
	require_once('../reusables/classes/classes.php');
	include_once '../reusables/classes/shortcuts.php';
	$ReusableClasses = new Reusables\Classes\ReusableClasses();
	$shortcuts = new Reusables\Classes\Shortcuts();
?>

<style>

.featuredsection5{ position: relative;display: inline-block;margin: 0;padding: 0;width: 100%;text-align: center; }
	.featuredsection5 .picture {position: relative;margin: 0;background-size: cover;background-position: center;margin: 2px;}
	.featuredsection5 #greybox{position: relative;display: inline-block;margin: 0;padding: 0;width: 250px;height: 40px;background-color: grey;color: white;bottom: 0; }
	.featuredsection5 .words{ position: relative; display: block; margin: 0; padding: 0; width: auto; height: 100px; background-color: white;}
	.featuredsection5 .text-container{ position: relative; display: inline-block; top: 50%; transform: translateY(-50%); width: 100%; }

	.featuredsection5 .grey-label{ font-style: italic; color: grey; font-size: 2em; }
@media (min-width: 0px) {
	.featuredsection5 .picture.one, .featuredsection5 .picture.three {display: none;}
	.featuredsection5 .picture {width: 100%; padding: 0; padding-bottom: 68%;}
	.featuredsection5 .graylabel {margin-top: calc(68% - 38px);}
	.featuredsection5 .post.one, .featuredsection5 .post.three {display: none;}
	.featuredsection5 .post.two {display: inline-block; width: 100%;}
}
@media (min-width: 768px) {
	.picture {display: inline-block;}
	.picture.one, .picture.three {display: inline-block;}
	.picture {width: 32%; padding: 0; padding-bottom: 28%;}
	.graylabel {margin-top: calc(28% - 38px);}
	.featuredsection5 .post.one, .featuredsection5 .post.three {display: inline-block; width: 31%;}
	.featuredsection5 .post.two {display: inline-block; width: 34%;}
}
</style>


<div class="featuredsection5">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<?php 
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position; relative; margin: 0; padding: 0;">';
					$ReusableClasses->cell( "cell_3", $sectiondict['postarray'][0] );
				echo '</div>';
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position; relative; margin: 0; padding: 0;">';
					$ReusableClasses->cell( "cell_3", $sectiondict['postarray'][1] );
				echo '</div>';
				echo '<div class="post one sortorder_1 featuredsectionid_1" style="position; relative; margin: 0; padding: 0;">';
					$ReusableClasses->cell( "cell_3", $sectiondict['postarray'][2] );
				echo '</div>';
			?>
			
		</div>
	</div>
</div>

<script>
	
</script>