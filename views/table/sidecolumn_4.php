<?php 

if(!isset($hasads)){$hasads=false;}
// exit(json_encode($hasads));

if(!isset($sideadarray)){ $sideadarray=array(); $hasads=false; }

?>

<style>
</style>

<div class="sidecolumn_4 <?php echo $identifier ?>">
	<div class="container">
	<!-- adgoeshere300600.png -->
	<!-- <script>console.log(<?php echo sizeof($sidecolumnarray) ?>)</script> -->
		<?php for($a=0;$a<sizeof($sidecolumnarray);$a++){ ?>

			<?php if($hasads && $a==2 && isset($sideadarray[0])){ ?>
				<div style="display: inline-block; margin-right: 20px; width: calc(100% - 20px);">
					<?php $adsetimg=$sideadarray[0]['imagepath']; $adsetlink=$sideadarray[0]['link_path']; $adsetid=$sideadarray[0]['id']; include $docroot.'/reusables/views/adset_2.php'; ?>
				</div>
			<?php }else if ($hasads && $a==5 && isset($sideadarray[1]) ){ ?>
				<div style="display: inline-block; margin-right: 20px; width: calc(100% - 20px);">
					<?php $adsetimg=$sideadarray[1]['imagepath']; $adsetlink=$sideadarray[1]['link_path']; $adsetid=$sideadarray[1]['id']; include $docroot.'/reusables/views/adset_2.php'; ?>
				</div>
			<?php }else { ?>
				<?php $sidecellid=$sidecolumnarray[$a]['id']; $sidecellimage=$sidecolumnarray[$a]['featured_imagepath']; $sidecelltitle=$sidecolumnarray[$a]['title']; $isfeatured=false; $sidecelldesc = $sidecolumnarray[$a]['html_text']; $sidecellprice = $sidecolumnarray[$a]['price']; include $docroot.'/reusables/views/sidecell_1.php'; ?>
			<?php } ?>

		<?php } ?>
	</div>
</div>


<script>

</script>