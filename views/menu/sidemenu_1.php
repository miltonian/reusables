<?php
	if(!isset($sidemenuarray)){ $sidemenuarray=array(); }

	//for testing 
	$sidemenuarray = array(1,2);
?>

<style>
</style>

<div class="<?php echo $identifier ?> sidemenu_1">
<?php for($i=0;$i<sizeof($sidemenuarray);$i++){ ?>
	<div class="button">
		<label>Test Button</label>
	</div>
<?php } ?>
</div>

<script>
</script>