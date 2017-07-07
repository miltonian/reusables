<?php 

	/*
		$sectiondict
		
		[
			"adposition"=>0,
			"header"=>"",
			"featured_imagepath"=>"",
			"logo_imagepath"=>"",
			"title"=>"",
			"desc"=>"",
			"postsarray"=>[]
		]
	*/

	// $sectiondict['postarray']

	if(!isset($adset3)){
		$adset3="";
	}

	if(!isset($sectiondict['adposition'])){ $sectiondict['adposition']=0; }
	if(!isset($sectiondict['title'])){ $sectiondict['title']=""; }
	if(!isset($sectiondict['postarray'])){ $sectiondict['postarray']=array([],[],[]); }

?>

<style>
</style>



<div class="<?php echo $identifier ?> featuredsection_2" >
	<?php if($sectiondict['title'] != ""){ ?>
		<div class="headercontainer">
			<div class="line"></div>
			<label class="backgroundcolor"><?php echo $sectiondict['title'] ?></label>
		</div>
	<?php } ?>
	<?php if($sectiondict['adposition'] == 0){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][0] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][1] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][2] );
			?>
		</div>
	<?php }else if($sectiondict['adposition'] == 1){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][0] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][1] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][2] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<div class="adset3" style="margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;">
				<a href="/reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto" style="margin-left: 1%;"></a>
			</div>
			<?php 
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][3] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php 
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][4] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][5] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][6] );
			?>
		</div>
	<?php }else if($sectiondict['adposition'] == 2){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][0] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][1] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][2] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][3] );
			?>
			<div class="adset3" style="float: right; margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;"> 
				<a href="/reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto"></a>
			</div>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php 
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][4] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][5] );
				ReusableClasses::cell( "cell_2", $sectiondict['postarray'][6] );
			?>
		</div>
	<?php } ?>

</div>

<script>

</script>