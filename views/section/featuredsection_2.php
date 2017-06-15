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

	require_once('../reusables/classes/classes.php');
	include_once '../reusables/classes/shortcuts.php';
	$ReusableClasses = new Reusables\Classes\ReusableClasses();
	$shortcuts = new Reusables\Classes\Shortcuts();

	// $sectiondict['postarray']

	if(!isset($adset3)){
		$adset3="";
	}

?>

<style>
.featuredsection_2 { position: relative; display: inline-block; margin: 0; padding: 0; max-width: 1200px; width: 100%; }
.featuredsection_2 .headercontainer { position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; }
.featuredsection_2 .headercontainer .line { position: absolute; display: inline-block;width: inherit;height: 1px; background-color: #333333;margin: 0;padding: 0; top: 50%; margin-top: -0.5px; left: 0; }
.featuredsection_2 .headercontainer label {z-index: 1;position: relative;display: inline-block;margin: 0;float: left;margin-left: 70px;padding: 10px;text-transform: uppercase;}

.cell2 .container {margin-left: 10px;margin-right: 10px;}

.adset3 {display: inline-block;padding: 0;top: 0;position: relative;}
.adset3 img {position: relative; display: inline-block;margin: 0;padding: 0;background-color: #e0e0e0; }

@media (min-width: 0px) {
	.adset3 { width: 90%; margin: 0; float: none;}
}
@media (min-width: 768px) {
	.adset3 { width: 56%; margin: 10px 19px 10px 6%; float: left; }
}
</style>



<div class="featuredsection_2" >
	<div class="headercontainer">
		<div class="line"></div>
		<label class="backgroundcolor"><?php echo $sectiondict['header'] ?></label>
	</div>
	<?php if($sectiondict['adposition'] == 0){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][0] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][1] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][2] );
			?>
		</div>
	<?php }else if($sectiondict['adposition'] == 1){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][0] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][1] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][2] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<div class="adset3" style="margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;">
				<a href="<?php echo $baseurlminimal ?>reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto" style="margin-left: 1%;"></a>
			</div>
			<?php 
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][3] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php 
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][4] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][5] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][6] );
			?>
		</div>
	<?php }else if($sectiondict['adposition'] == 2){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][0] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][1] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][2] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][3] );
			?>
			<div class="adset3" style="float: right; margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;"> 
				<a href="<?php echo $baseurlminimal ?>reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto"></a>
			</div>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php 
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][4] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][5] );
				$ReusableClasses->cell( "cell_2", $sectiondict['postarray'][6] );
			?>
		</div>
	<?php } ?>

</div>

<script>

</script>