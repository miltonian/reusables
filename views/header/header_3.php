<?php

if( isset($headerdict['editing']) ){ $isediting=1; }else{ $isediting=0; }

$buttons = "";

if( isset($headerdict['buttons']) ){
	$i=0;
	foreach ($headerdict['buttons'] as $b) {
		$buttons .= "<button class='index_" . $i . "'>" . $b['name'] . "</button>";
		$i++;
	}
}

// exit( json_encode( $headerdict ) );

?>

<style>
	.header_3 .structure_1 .sidecolumn_right button { display: inline-block; position: relative; margin: 0; padding: 10px 15px; font-size: 15px; float: right; top: 50%; transform: translateY(-50%); -webkit-appearance: none; border: 1px solid rgba(0,0,0,0.3); border-bottom-width: 3px; border-radius: 5px; background-color: blue; color: white; cursor: pointer; }
	@media (min-width: 0px) {
		.header_3 .structure_1 .maincolumn { width: calc(100% - 20px); }
		.header_3 .structure_1 .sidecolumn_right { width: calc(100% - 20px); text-align: center; }
	}
	@media (min-width: 768px) {
		.header_3 .structure_1 .maincolumn { width: calc(50% - 20px); }
		.header_3 .structure_1 .sidecolumn_right { width: calc(50% - 20px); text-align: right; height: 37px; }
	}
</style>

<div class="<?php echo $identifier ?> header_3">
	<?php
		if(isset($headerdict['buttons'])){
			echo Structure::make(
				"structure_1", 
				[
					"maincolumn" => array( 
						"<h1 id='title'>" . Data::getValue( $headerdict['title'] ) . "</h1>"
					),
					"sidecolumn_right" => array( 
						$buttons
					)
				],
				$identifier . "_header_3"
			);
		}else{ ?>
			<h1 id='title'><?php echo Data::getValue( $headerdict['title'] ) ?></h1>
		<?php } ?>

	<div id="divider"></div>
</div>

<script>

<?php if( isset( $headerdict['buttons'] ) ){ ?>
var editingfunctions = [];
<?php foreach ($headerdict['buttons'] as $hb) { ?>
	<?php if( $hb['type'] == "modal" ){ ?>
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
			var type = buttondict['type'];
			if( type == "link" ){
				window.open(buttondict[type]);
			}else if( type == "modal" ){
				// let modalclass = new buttondict[type]['modalclass']+Classes();
				// modalclass.populateview( $(this).id );
				editingfunctions[theindex].populateview(this.id);
				$('.modal_background').css({'display': 'inline-block'});
				$('.' + buttondict[type]['parentclass']).css({'display': 'inline-block'});
			}else if( type == "popview" ){

			}
		}
	});

	<?php } ?>
</script>