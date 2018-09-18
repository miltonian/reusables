<?php

namespace Reusables;

	Views::setParams( 
		[ "imagepath" ], 
		[],
		$identifier
	);

?>



<div class="viewtype_section ios_screenshot_1 main <?php echo $identifier ?> clicktoedit">
	
	<div class="ios_screenshot_1 iphone">
		<div class="ios_screenshot_1 picture" style="background-image: url(<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>);">
			
		</div>
	</div>

</div>

<script>

		$('.ios_screenshot_1.clicktoedit').click(function(e){
			<?php
				Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})

</script>