<?php 
	if(!isset($adposition)){
		$adposition = 0;
	}

	if(!isset($adset3)){
		$adset3="";
	}

	if(!isset($featuredrows)){ $featuredrows = 2; }

	// exit( json_encode( $adset3 ) );

	// exit(json_encode(sizeof($featuredsection2array)));
	// src="<?php echo $baseurlminimal reusables/uploads/icons/adgoeshere1300x710.png"
?>

<style>
.featuredsection_2 {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	max-width: 1200px;
	width: 100%;
}
.featuredsection_2 .headercontainer {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
}
.featuredsection_2 .headercontainer .line {
	position: absolute;
	display: inline-block;
	width: inherit;
	height: 1px;
	background-color: #333333;
	margin: 0;
	padding: 0;
	top: 50%;
	margin-top: -0.5px;
	left: 0;
}
.featuredsection_2 .headercontainer label {
	z-index: 1;
	position: relative;
	display: inline-block;
	margin: 0;
	float: left;
	margin-left: 70px;
	padding: 10px;
	text-transform: uppercase;
}

.cell2 .container {
	margin-left: 10px;
	margin-right: 10px;
}

.adset3 {
	display: inline-block;
	padding: 0;
	top: 0;
	position: relative;
	/*float: left;*/
}
.adset3 img {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	/*width: 100%;*/
	/*padding-bottom: 53%;*/
	background-color: #e0e0e0;
}

@media (min-width: 0px) {
	.adset3 { width: 90%; margin: 0; float: none;}
}
@media (min-width: 768px) {
	.adset3 { width: 56%; margin: 10px 19px 10px 6%; float: left;}
}
</style>

<div class="featuredsection_2" >
	<div class="headercontainer">
		<div class="line"></div>
		<label class="backgroundcolor"><?php echo $featuredsection2title ?></label>
	</div>
	<?php if($adposition == 0){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php $cell2id=$featuredsection2array[0]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[0]['featured_imagepath']); $cell2title=$featuredsection2array[0]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[0]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[1]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[1]['featured_imagepath']); $cell2title=$featuredsection2array[1]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[1]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[2]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[2]['featured_imagepath']); $cell2title=$featuredsection2array[2]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[2]['html_text'])), 0, 10));include $docroot.'/reusables/views/cell_2.php'; ?>
		</div>
	<?php }else if($adposition == 1){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php $cell2id=$featuredsection2array[0]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[0]['featured_imagepath']); $cell2title=$featuredsection2array[0]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[0]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[1]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[1]['featured_imagepath']); $cell2title=$featuredsection2array[1]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[1]['html_text'])), 0, 10));include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[2]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[2]['featured_imagepath']); $cell2title=$featuredsection2array[2]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[2]['html_text'])), 0, 10));include $docroot.'/reusables/views/cell_2.php'; ?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<div class="adset3" style="margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;">
				<a href="<?php echo $baseurlminimal ?>reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto" style="margin-left: 1%;"></a>
			</div>
			<?php $cell2id=$featuredsection2array[3]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[3]['featured_imagepath']); $cell2title=$featuredsection2array[3]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[3]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php $cell2id=$featuredsection2array[4]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[4]['featured_imagepath']); $cell2title=$featuredsection2array[4]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[4]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[5]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[5]['featured_imagepath']); $cell2title=$featuredsection2array[5]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[5]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[6]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[6]['featured_imagepath']); $cell2title=$featuredsection2array[6]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[6]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
		</div>
	<?php }else if($adposition == 2){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php $cell2id=$featuredsection2array[0]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[0]['featured_imagepath']); $cell2title=$featuredsection2array[0]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[0]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[1]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[1]['featured_imagepath']); $cell2title=$featuredsection2array[1]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[1]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[2]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[2]['featured_imagepath']); $cell2title=$featuredsection2array[2]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[2]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php $cell2id=$featuredsection2array[3]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[3]['featured_imagepath']); $cell2title=$featuredsection2array[3]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[3]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<div class="adset3" style="float: right; margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;"> 
				<a href="<?php echo $baseurlminimal ?>reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto"></a>
			</div>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php $cell2id=$featuredsection2array[4]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[4]['featured_imagepath']); $cell2title=$featuredsection2array[4]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[4]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[5]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[5]['featured_imagepath']); $cell2title=$featuredsection2array[5]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[5]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
			<?php $cell2id=$featuredsection2array[6]['post_id']; $cell2image=$shortcuts->changeURLForTesting($featuredsection2array[6]['featured_imagepath']); $cell2title=$featuredsection2array[6]['title']; $cell2desc= implode(' ', array_slice(explode(' ', strip_tags($featuredsection2array[6]['html_text'])), 0, 10)); include $docroot.'/reusables/views/cell_2.php'; ?>
		</div>
	<?php } ?>

</div>

<script>

</script>