<?php 

namespace Reusables;

	/*
		$viewdict
		
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

	// $viewdict['postarray']

	if(!isset($adset3)){
		$adset3="";
	}

	if(!isset($viewdict['adposition'])){ $viewdict['adposition']=0; }
	if(!isset($viewdict['title'])){ $viewdict['title']=""; }
	if(!isset($viewdict['postarray'])){ $viewdict['postarray']=array([],[],[]); }

?>

<style>
</style>



<div class="<?php echo $identifier ?> featuredsection_2" >
	<?php if($viewdict['title'] != ""){ ?>
		<div class="headercontainer">
			<div class="line"></div>
			<label class="backgroundcolor"><?php echo $viewdict['title'] ?></label>
		</div>
	<?php } ?>
	<?php if($viewdict['adposition'] == 0){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][0] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][1] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][2] );
			?>
		</div>
	<?php }else if($viewdict['adposition'] == 1){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][0] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][1] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][2] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<div class="adset3" style="margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;">
				<a href="/reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto" style="margin-left: 1%;"></a>
			</div>
			<?php 
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][3] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php 
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][4] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][5] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][6] );
			?>
		</div>
	<?php }else if($viewdict['adposition'] == 2){ ?>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][0] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][1] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][2] );
			?>
		</div>
		<div style="display: inline-block; position: relative; width: 100%;">
			<?php 
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][3] );
			?>
			<div class="adset3" style="float: right; margin: 10px 10px 10px 0px; width: calc(66% - 15px); display: inline-block; position: relative;"> 
				<a href="/reusables/functions/adclicked.php?ad_id=<?php echo $adset3['id'] ?>"><img src="<?php echo $adset3['imagepath'] ?>" width="100%" height="auto"></a>
			</div>
		</div>
		<div style="display: inline-block; position: relative; width: 100%; margin-top: 10px">
			<?php 
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][4] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][5] );
				ReusableClasses::cell( "cell_2", $viewdict['postarray'][6] );
			?>
		</div>
	<?php } ?>

</div>

<script>

</script>