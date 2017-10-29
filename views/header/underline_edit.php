<?php

namespace Reusables;

// $viewoptions = ReusableClasses::convertViewActions( $viewoptions );

if( isset($viewdict['editing']) ){ $isediting=1; }else{ $isediting=0; }

$buttons = "";

if( isset($viewoptions['buttons']) ){
	$i=0;
	foreach ($viewoptions['buttons'] as $b) {
		$buttons .= "<button id='".Data::getValue($b, 'view_id')."' class='underline_edit index_" . $i . " " . Data::getValue($b,'classname') . "'>" . $b['text'] . "</button>";
		$i++;
	}
}




	Views::setParams( 
		[ "buttons"=>["view_id", "classname", "text"], "title" ], 
		[],
		$identifier
	);

?>

<style>
	
</style>

<div class="viewtype_header <?php echo $identifier ?> underline_edit main">
	<?php
		if(isset($viewoptions['buttons'])){
			echo Structure::make(
				"main_withside", 
				[
					"maincolumn" => array( 
						"<h1 class='underline_edit' id='title'>" . Data::getValue( $viewdict, 'title' ) . "</h1>"
					),
					"sidecolumn_right" => array( 
						$buttons
					)
				],
				$identifier . "_underline_edit"
			);
		}else{ ?>
			<h1 class='underline_edit' id='title'><?php echo Data::getValue( $viewdict, 'title' ) ?></h1>
		<?php } ?>

	<div class="underline_edit" id="divider"></div>
</div>

<script>

<?php if( isset( $viewoptions['buttons'] ) ){ ?>

<?php ReusableClasses::getEditingFunctionsJS( $viewoptions ) ?>;

var viewdict = <?php echo json_encode($viewdict) ?>;
var viewoptions = <?php echo json_encode($viewoptions) ?>;
var isediting = <?php echo $isediting ?>;
	$('.underline_edit .main_withside .sidecolumn_right button').click(function(e){
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