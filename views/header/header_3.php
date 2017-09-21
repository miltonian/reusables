<?php

namespace Reusables;

if( isset($headerdict['editing']) ){ $isediting=1; }else{ $isediting=0; }

$buttons = "";

if( isset($headeroptions['buttons']) ){
	$i=0;
	foreach ($headeroptions['buttons'] as $b) {
		$buttons .= "<button id='".Data::getValue($b, 'view_id')."' class='header_3 index_" . $i . " " . Data::getValue($b,'classname') . "'>" . $b['text'] . "</button>";
		$i++;
	}
}

$headeroptions = ReusableClasses::convertViewActions( $headeroptions );
// exit( json_encode( $headeroptions ) );


?>

<style>
	
</style>

<div class="<?php echo $identifier ?> header_3 main">
	<?php
		if(isset($headeroptions['buttons'])){
			echo Structure::make(
				"structure_1", 
				[
					"maincolumn" => array( 
						"<h1 class='header_3' id='title'>" . Data::getValue( $headerdict, 'title' ) . "</h1>"
					),
					"sidecolumn_right" => array( 
						$buttons
					)
				],
				$identifier . "_header_3"
			);
		}else{ ?>
			<h1 class='header_3' id='title'><?php echo Data::getValue( $headerdict, 'title' ) ?></h1>
		<?php } ?>

	<div class="header_3" id="divider"></div>
</div>

<script>

<?php if( isset( $headeroptions['buttons'] ) ){ ?>

<?php ReusableClasses::getEditingFunctionsJS( $headeroptions ) ?>;

var headerdict = <?php echo json_encode($headerdict) ?>;
var headeroptions = <?php echo json_encode($headeroptions) ?>;
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
			var buttondict = headeroptions['buttons'][theindex];
			Reusable.addAction( buttondict, editingfunctions, theindex )
		}
	});

	<?php } ?>
</script>