<?php

	if (!isset($headerdict['logolink'])) { $headerdict['logolink'] = ""; }

?>

<style>
</style>

<div class="<?php echo $identifier ?> header_2 main" style="background-image: url('<?php echo Data::getValue( $headerdict, 'featured_imagepath' ) ?>');">
	<div class="header_2 overlay"></div>
	<a href="/<?php echo $headerdict['logolink'] ?>">
		<img src="<?php echo Data::getValue( $headerdict, 'logo_imagepath' ) ?>" class="header_2" id="logo">
	</a>
</div>

<script>
</script>