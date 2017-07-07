<?php

?>

<style>
</style>

<div class="mediasection_1 <?php echo $identifier ?>">
		<?php for ($i=0; $i < sizeof($mediaarray); $i++) { ?>
			<div class="post <?php echo $i ?>" style="background-image: url('<?php echo $mediaarray[$i]['imagepath'] ?>')">

			</div>
		<?php } ?>
</div>

<script>
	
</script>