<?php 

?>

<style>

</style>


<div class="<?php echo $identifier ?> adset_2" style='position: relative; display: inline-block; width: 100%; padding: 10px 0px; text-align: center;'>
	<?php if($adsetlink!=""){ ?><a href="<?php echo $baseurlminimal ?>reusables/functions/adclicked.php?ad_id=<?php echo $adsetid ?>" ><?php } ?>
	<img src=<?php echo $adsetimg ?> style='position: relative; display: inline-block;'>
	<?php if($adsetlink!=""){ echo '</a>'; } ?>
</div>


<script>

</script>