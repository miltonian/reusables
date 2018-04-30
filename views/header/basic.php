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

<div class="viewtype_header <?php echo $identifier ?> basic main clicktoedit">
	<h1 class="basic title" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h1>
</div>

<script>

		$('.<?php echo $identifier ?>.basic.clicktoedit').click(function(e){
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})


</script>