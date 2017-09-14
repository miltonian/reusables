<?php

namespace Reusables;

if( isset($headerdict['editing']) ){ $isediting=1; }else{ $isediting=0; }

$buttons = "";

if( isset($headerdict['buttons']) ){
	$i=0;
	foreach ($headerdict['buttons'] as $b) {
		$buttons .= "<button id='".Data::getValue($b, 'view_id')."' class='header_3 index_" . $i . " " . Data::getValue($b,'classname') . "'>" . $b['name'] . "</button>";
		$i++;
	}
}

// exit( json_encode( $headerdict ) );

?>

<style>
	
</style>

<div class="<?php echo $identifier ?> header_3 main">
	<?php
		if(isset($headerdict['buttons'])){
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

<?php if( isset( $headerdict['buttons'] ) ){ ?>
var editingfunctions = [];
<?php foreach ($headerdict['buttons'] as $hb) { ?>
	<?php $hb_type = Data::getValue( $hb, 'type' ); ?>
	<?php if( $hb_type == "modal" ){ ?>
		var thismodalclass = new <?php echo $hb['modal']['modalclass'] ?>Classes();
		editingfunctions.push( thismodalclass );
	<?php }else{ ?>
		editingfunctions.push( "nothing" );
	<?php } ?>
	<?php $i++; ?>
<?php } ?>

var headerdict = <?php echo json_encode($headerdict) ?>;
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
			var buttondict = headerdict['buttons'][theindex];
			Reusable.addAction( buttondict, editingfunctions, theindex )
		}
	});

	<?php } ?>
</script>