<?php

namespace Reusables;

?>

<div class="textandbutton_1 <?php echo $identifier ?> main">
	<div class="test_section_header header_5 main">
		<h1 class="header_5" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h1>
	</div>
	<a class="textandbutton_1 link" href='<?php echo Data::getValue( $viewdict, 'link' ) ?>'>
		<button class='textandbutton_1 button'><?php echo Data::getValue( $viewdict, 'buttontext' ) ?></button>
	</a>
</div>
