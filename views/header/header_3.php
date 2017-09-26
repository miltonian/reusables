<?php

namespace Reusables;

if( isset($viewdict['editing']) ){ $isediting=1; }else{ $isediting=0; }

$buttons = "";

if( isset($viewoptions['buttons']) ){
	$i=0;
	foreach ($viewoptions['buttons'] as $b) {
		$buttons .= "<button id='".Data::getValue($b, 'view_id')."' class='header_3 index_" . $i . " " . Data::getValue($b,'classname') . "'>" . $b['text'] . "</button>";
		$i++;
	}
}

$viewoptions = ReusableClasses::convertViewActions( $viewoptions );
// exit( json_encode( $viewoptions ) );


?>

<style>
	
</style>

<div class="<?php echo $identifier ?> header_3 main">
	<?php
		if(isset($viewoptions['buttons'])){
			echo Structure::make(
				"structure_1", 
				[
					"maincolumn" => array( 
						"<h1 class='header_3' id='title'>" . Data::getValue( $viewdict, 'title' ) . "</h1>"
					),
					"sidecolumn_right" => array( 
						$buttons
					)
				],
				$identifier . "_header_3"
			);
		}else{ ?>
			<h1 class='header_3' id='title'><?php echo Data::getValue( $viewdict, 'title' ) ?></h1>
		<?php } ?>

	<div class="header_3" id="divider"></div>
</div>

<script>

<?php if( isset( $viewoptions['buttons'] ) ){ ?>

<?php ReusableClasses::getEditingFunctionsJS( $viewoptions ) ?>;

var viewdict = <?php echo json_encode($viewdict) ?>;
var viewoptions = <?php echo json_encode($viewoptions) ?>;
var isediting = <?php echo $isediting ?>;
	$('.header_3 .structure_1 .sidecolumn_right button').click(function(e){
		e.preventDefault();

		var classes = $(this).attr('class');
		var classarray = classes.split(' ');
		var theindex = -1;
		for (var i = 0; i < classarray.length; i++) {
			if(classarray[i].match("^index_")){
				theindex = parseInt( classarray[i].split('_')[1] );
			}
		}
		
		if(theindex != -1){
			var buttondict = viewoptions['buttons'][theindex];
			Reusable.addAction( buttondict, editingfunctions, theindex )
		}
	});

	<?php } ?>
</script>