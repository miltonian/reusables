<?php

?>

<style>

</style>



<div class="headerwithcat_1 main <?php echo $identifier ?>" >
	<h4 class="headerwithcat_1 title"><?php echo $headerdict['title'] ?></h4>
	<div class="headerwithcat_1 categories_wrapper">
		<div class="headerwithcat_1 categoriesinner_wrapper">
			<?php $i=0; ?>
			<?php foreach ($headerdict['categories'] as $c) { ?>
				<?php if( $i > 0 ){ ?>
					<p class="headerwithcat_1" id="separator"> | </p>
				<?php } ?>
				<a class="headerwithcat_1 link" id="" href="<?php echo $c['link'] ?>" ><?php echo $c['name'] ?></a>
				<?php $i++; ?>
			<?php } ?>
		</div>
	</div>
</div>




<script>
	
</script>