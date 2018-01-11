<?php

namespace Reusables;


	Views::setParams( 
		[ "html_text" ], 
		[],
		$identifier
	);

?>

<div class="text_box main <?php echo $identifier ?> main clicktoedit">

	<?php echo Data::getValue( $viewdict, 'html_text'); ?>

</div>

<script>

		$('.<?php echo $identifier ?>.text_box.clicktoedit').off().click(function(e){ 
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>		
		});

</script>