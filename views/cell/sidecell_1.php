<?php 


?>

<style>
</style>


<div class="sidecell_1 main <?php echo $identifier ?>">
	<div class="sidecell_1 leftdiv">
		<a href="<?php echo $baseurlminimal.'post/'.$sidecellid ?>/<?php echo preg_replace('/\PL/u', '', $sidecelltitle) ?>"><div class="sidecell_1 image" style="background-image: url('<?php echo $sidecellimage ?>');"></div></a>
	</div>
	<div class="sidecell_1 rightdiv">
		<a href="<?php echo $baseurlminimal.'post/'.$sidecellid ?>/<?php echo preg_replace('/\PL/u', '', $sidecelltitle) ?>"><label class="sidecell_1 title"><?php echo $sidecelltitle ?></label></a>
	</div>
</div>


<script>
	
</script>