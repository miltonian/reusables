<?php

namespace Reusables;


Data::addData( ["title"=>Data::getValue( $viewdict, 'title' )], $identifier . "_header" );

?>

<div class="textandbutton_1 <?php echo $identifier ?> main">
	<?php echo Header::make( "header_5", $identifier . "_header" ); ?>
	<a class="textandbutton_1 link" href='<?php echo Data::getValue( $viewdict, 'link' ) ?>'>
		<button class='textandbutton_1 button'><?php echo Data::getValue( $viewdict, 'buttontext' ) ?></button>
	</a>
</div>
