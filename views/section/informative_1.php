<?php

?>

<style>
.informative_1.main { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
	.informative_1.header { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 120px; background-size: contain; background-position: center; background-repeat: no-repeat; margin-bottom: 50px; }
	.informative_1.description { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; max-width: 800px; text-align: left; font-size: 18px; }
</style>

<div class="informative_1 main <?php echo $identifier ?>">
	<div class="informative_1 header" style="background-image: url('<?php echo $sectiondict['header_image'] ?>');">

	</div>
	<div class="informative_1 description"><?php echo $sectiondict['html_text'] ?></div>
</div>

<script>
</script>