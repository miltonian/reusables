<?php

namespace Reusables;
// exit( json_encode( $viewdict ) );


	Views::setParams( 
		[ "title" ],
		[],
		$identifier
	);
?>

<style>
</style>

<div class="viewtype_header <?php echo $identifier ?> basic main">
	<h1 class="basic" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h1>
</div>

<script>
</script>