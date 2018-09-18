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

<div class="viewtype_header <?php echo $identifier ?> title_subtitle main clicktoedit">
	<h1 class="title_subtitle" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h1>
	<div class="title_subtitle subtitle_container">
		<div class="title_subtitle left line"></div>
		<h1 class="title_subtitle" id="subtitle"><?php echo Data::getValue( $viewdict, 'html_text' ) ?></h1>
		<div class="title_subtitle right line"></div>
	</div>
</div>

<script>

		$('.<?php echo $identifier ?>.title_subtitle.clicktoedit').click(function(e){
			<?php
				Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})


</script>