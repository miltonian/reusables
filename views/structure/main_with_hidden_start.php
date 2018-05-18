<?php

namespace Reusables;


$mainheaderdict = [ "title"=>Data::getValue( $structuredict, "title") ];

	$step1dict = ["steps" => Data::getValue( $structuredict, 'steps' ) ];

$main_header_text = Data::getValue( $viewoptions, "title" );
if( $main_header_text != "" ) {

	Data::addData( ["title" => $main_header_text], $identifier . "_main_header");
}
?>

<style>
</style>

<div class="viewtype_structure <?php echo $identifier ?> main_with_hidden main">
	<div class="main_with_hidden header">
		<button class="main_with_hidden close" id="close">&#10006;</button>
		<?php echo Header::make( "basic", $identifier . "_main_header" ); ?>
		<?php 
			if( $step1dict['steps'] != "" ) {
				echo Header::make( "steps", $identifier . "_steps" ); 
			}
		?>
	</div>
	<div class="main_with_hidden body">