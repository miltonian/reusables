<?php

	if (!isset($headerdict['logolink'])) { $headerdict['logolink'] = ""; }

?>

<style>
</style>

<div class="<?php echo $identifier ?> header_2" style="background-image: url('<?php echo Data::getValue( $headerdict['featured_imagepath'] ) ?>');">
	<div class="overlay"></div>
	<a href="/<?php echo $headerdict['logolink'] ?>">
		<img src="<?php echo Data::getValue( $headerdict['logo_imagepath'] ) ?>" id="logo">
	</a>
</div>

<script>
</script>