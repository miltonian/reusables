<?php

namespace Reusables;


Data::addData( ["title"=>Data::getValue( $sectiondict, 'title' )], $identifier . "_header" );

?>

<div class="textandbutton_1 <?php echo $identifier ?> main">
	<?php echo Header::make( "header_5", $identifier . "_header" ); ?>
	<a class="textandbutton_1 link" href='<?php echo Data::getValue( $sectiondict, 'link' ) ?>'>
		<button class='textandbutton_1 button'><?php echo Data::getValue( $sectiondict, 'buttontext' ) ?></button>
	</a>
</div>
