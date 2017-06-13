<?php 
	if(!isset($adposition)){
		$adposition = 0;
	}
	// exit(json_encode(sizeof($featuredsection3array)));
?>

<style>
.featuredsection_3 {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	max-width: 1200px;
	width: 100%;
}
.featuredsection_3 .headercontainer {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	/*width: 1200px;*/
	margin-bottom: 30px;
	width: 100%;
}
.featuredsection_3 .headercontainer .line {
	position: absolute;
	display: inline-block;
	width: 100%;
	height: 1px;
	background-color: #333333;
	margin: 0;
	padding: 0;
	top: 50%;
	margin-top: -0.5px;
	left: 0;
}
.featuredsection_3 .headercontainer label {
	z-index: 1;
	position: relative;
	display: inline-block;
	margin: 0;
	float: left;
	margin-left: 70px;
	padding: 10px;
	text-transform: uppercase;
}
.featuredsection_3 .posts {
	display: inline-block; 
	position: relative; 
	width: 100%; 
	max-width: 1200px;
	text-align: center;
}
.featuredsection_3 .left {
	display: inline-block; 
	position: relative; 
	margin: 0; 
	padding: 0; 

	/*float: left; */
	/*width: 50%;*/
}
.featuredsection_3 .right.top {
	display: inline-block; 
	position: relative; 
	margin: 0; 
	padding: 0; 

	width: calc(50% - 14px);
	padding-right: 14px;
	float: left;
	margin-bottom: 10px;
	/*float: left; */
	/*width: 50%;*/
}
.featuredsection_3 .right.bottom {
	display: inline-block; 
	position: relative; 
	margin: 0; 
	padding: 0; 
	/*float: left; */
	/*width: 50%; */
	margin-top: 23px;
	float: left;
	
}
.cell2 .container {
	margin-left: 10px;
	margin-right: 10px;
}
.featuredsection_3 .thirdrow {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	text-align: center;
}

@media (min-width: 0px) {
	.featuredsection_3 .left {width: 100%;}
	.featuredsection_3 .right.bottom, .featuredsection_3 .right.top {width: auto; float: none;}
	.featuredsection_3 .adposition2.thirdrow {margin-top: 20px; width: 70%;}
	.featuredsection_3 .adposition2.right.bottom {display: none;}
}
@media (min-width: 768px) {
	.featuredsection_3 .right.bottom, .featuredsection_3 .right.top, .featuredsection_3 .left {width: calc(50% - 14px); padding-right: 14px; float: left; margin-bottom: 10px;}
	.featuredsection_3 .adposition2.right.bottom {display: inline-block; margin: 22px 0px 0px; width: calc(25% - 10px);}
	.featuredsection_3 .adposition2.thirdrow {margin-top: 6px; width: calc(77% - 24px);}
}
</style>

<div class="featuredsection_3" >
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