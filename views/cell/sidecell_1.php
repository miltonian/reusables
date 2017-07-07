<?php 


?>

<style>
</style>


<div class="sidecell_1 <?php echo $identifier ?>">
	<div class="leftdiv">
		<a href="<?php echo $baseurlminimal.'post/'.$sidecellid ?>/<?php echo preg_replace('/\PL/u', '', $sidecelltitle) ?>"><div class="image" style="background-image: url('<?php echo $sidecellimage ?>');"></div></a>
	</div>
	<div class="rightdiv">
		<a href="<?php echo $baseurlminimal.'post/'.$sidecellid ?>/<?php echo preg_replace('/\PL/u', '', $sidecelltitle) ?>"><label class="title"><?php echo $sidecelltitle ?></label></a>
	</div>
</div>


<script>
	
</script>