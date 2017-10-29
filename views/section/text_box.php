<?php

namespace Reusables;


	Views::setParams( 
		[ "html_text" ], 
		[],
		$identifier
	);

?>

<div class="text_box main <?php echo $identifier ?>">

	<?php echo Data::getValue( $viewdict, 'html_text'); ?>

</div>