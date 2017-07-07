<?php 
	if(!isset($adposition)){
		$adposition = 0;
	}
?>

<style>
</style>

<div class="featuredsection_3 <?php echo $identifier ?>" >
	<div class="headercontainer">
		<div class="line"></div>
		<label class="backgroundcolor"><?php echo $featuredsection3title ?></label>
	</div>
	<div class="posts" style="">
		<div class="left">
			<?php $cell3id=$featuredsection3array[0]['post_id']; $cell3image=$shortcuts->changeURLForTesting($featuredsection3array[0]['featured_imagepath']); $cell3title=$featuredsection3array[0]['title']; include $docroot.'/reusables/views/cell_3.php'; ?>
		</div>
		<div class="right top" style="">
			<div style="float: left; display: inline-block; position: relative; margin: 0px 10px; padding: 0; width: calc(50% - 20px);"><?php $cell4id=$featuredsection3array[1]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[1]['featured_imagepath']); $cell4title=$featuredsection3array[1]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
			<div style="float: left; display: inline-block; position: relative; margin: 0px 10px; padding: 0; width: calc(50% - 20px);"><?php $cell4id=$featuredsection3array[2]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[2]['featured_imagepath']); $cell4title=$featuredsection3array[2]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
		</div>
		<?php if($adposition=="1"){ ?>
			<div class="right bottom" style="">
				<div style="float: left; display: inline-block; position: relative; margin: 0px 10px; padding: 0; width: calc(50% - 20px);"><?php $cell4id=$featuredsection3array[3]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[3]['featured_imagepath']); $cell4title=$featuredsection3array[3]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
				<div class="adset3" style="float: right; margin: 10px 6% 10px 19px;">
					<a href="<?php echo $baseurlminimal ?>reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto"></a>
				</div>
			</div>
			<div class="thirdrow">
				<div style="float: left; display: inline-block; position: relative; margin: 0px 10px; padding: 0; width: calc(25% - 20px);"><?php $cell4id=$featuredsection3array[4]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[4]['featured_imagepath']); $cell4title=$featuredsection3array[4]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
				<div style="float: left; display: inline-block; position: relative; margin: 0px 10px; padding: 0; width: calc(25% - 20px);"><?php $cell4id=$featuredsection3array[5]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[5]['featured_imagepath']); $cell4title=$featuredsection3array[5]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
				<div style="float: left; display: inline-block; position: relative; margin: 0px 10px; padding: 0; width: calc(25% - 20px);"><?php $cell4id=$featuredsection3array[6]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[6]['featured_imagepath']); $cell4title=$featuredsection3array[6]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
			</div>
		<?php }else if($adposition=="2"){ ?>
			<div class="adposition2 right bottom" style="margin-top: 22px;">
				<div style=" float: left; display: inline-block; position: relative; margin: 0px 10px 0px 10px; padding: 0;"><?php $cell4id=$featuredsection3array[3]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[3]['featured_imagepath']); $cell4title=$featuredsection3array[3]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
			</div>
			<div class="adposition2 adset3" style=" float: right; display: inline-block; position: relative; margin-left: 0px; margin-top: 22px; padding: 0; width: calc(25% - 24px);">
				<a href="<?php echo $baseurlminimal ?>reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto"></a>
			</div>
			<div class="adposition2 thirdrow" style=" float: left; margin-top: 36px;">
				<div style=" float: left; display: inline-block; position: relative; margin: 0px 0px 0px 24px; padding: 0; width: calc(33% - 26px);"><?php $cell4id=$featuredsection3array[4]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[4]['featured_imagepath']); $cell4title=$featuredsection3array[4]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
				<div style=" float: left; display: inline-block; position: relative; margin: 0px 0px 0px 24px; padding: 0; width: calc(33% - 26px);"><?php $cell4id=$featuredsection3array[5]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[5]['featured_imagepath']); $cell4title=$featuredsection3array[5]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
				<div style=" float: left; display: inline-block; position: relative; margin: 0px 0px 0px 24px; padding: 0; width: calc(33% - 26px);"><?php $cell4id=$featuredsection3array[6]['post_id']; $cell4image=$shortcuts->changeURLForTesting($featuredsection3array[6]['featured_imagepath']); $cell4title=$featuredsection3array[6]['title']; include $docroot.'/reusables/views/cell_4.php'; ?></div>
			</div>
		<?php } ?>
	</div>
</div>

<script>
</script>