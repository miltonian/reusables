<?php

namespace Reusables;


	Views::setParams( 
		[ "title", "link", "buttontext" ], 
		[],
		$identifier
	);

?>

<div class="viewtype_section text_and_button <?php echo $identifier ?> main clicktoedit">
	<div class="test_section_header header_5 main">
		<h1 class="header_5" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h1>
	</div>
	<a class="text_and_button link" href='<?php echo Data::getValue( $viewdict, 'link' ) ?>'>
		<button class='text_and_button button'><?php echo Data::getValue( $viewdict, 'buttontext' ) ?></button>
	</a>
</div>

<script>

		$('.text_and_button.clicktoedit').off().click(function(e){ 
			<?php
				Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>		
		});

</script>