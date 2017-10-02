<?php

namespace Reusables;

if( !isset( $viewoptions['ifnone_insert'] ) ){
	$ifnone_insert = false;
}else{
	$ifnone_insert = $viewoptions['ifnone_insert'];
}

if( !isset( $viewoptions['formaction'] ) ){
	$formaction = '/edit_view.php';
}else{
	$formaction = $viewoptions['formaction'];
}

if( isset( $viewdict['formtitle'] ) ) {
	unset( $viewdict['formtitle'] );
}

// if( isset( $viewdict[array_keys($viewdict)[0]][ 'data_id' ] ) ){
// 	$original_data_id = $viewdict[ array_keys( $viewdict )[ 0 ] ][ 'data_id' ];
// }else{
// 	$original_data_id = $viewdict[ 'data_id' ];
// }

$original_data_id = $identifier;

extract( CustomView::makeFormVars( $viewdict, "viewdict" ) );
extract( Input::convertInputKeys( $identifier ) );

?>


<style>
	<?php if( $steps > 1 ) { ?>
		.smartform.main_with_hidden.next { display: inline-block; }
		.smartform.main_with_hidden.save { display: none; }
	<?php }else{ ?>
		.smartform.main_with_hidden.next { display: none; }
		.smartform.main_with_hidden.save { display: inline-block; }
	<?php } ?>
</style>


<?php if( $onstep==1 ){ ?>
	<form class='theform' method='post' action='<?php echo $formaction ?>' enctype='multipart/form-data'>
<?php } ?>

<?php if( $ifnone_insert ){ ?>
	<input type='hidden' name='ifnone_insert' value='1' >
<?php } ?>
<div class="viewtype_section <?php echo $identifier ?> smartform main">
	<div class='thecontainer' style='text-align: left; margin-top: 10px; margin-bottom: 0px; text-align: center;'>
		<input type="hidden" name="goto" value="<?php echo Data::getValue( $viewoptions, 'goto' ) ?>">
			<?php 

				echo Structure::make( 
					"one_column",
					[
						"maincolumn" => $inputs[ 'c' . $onstep ]
						
					],
					"main_structure smartform"
				);
			
			?>
		<!-- <button class="smartform modalinner_1 save custombutton">Save</button> -->
		<?php if( $steps > 1 ){ ?>
			<button class="smartform main_with_hidden next custombutton">Next</button>
			<button class="smartform main_with_hidden save custombutton">Save</button>
		<?php }else { ?>
			<button class="smartform main_with_hidden save custombutton">Save</button>
		<?php } ?>
	</div>
</div>
<?php if( $onstep == $steps ) { ?>
	</form>
<?php } ?>

<script>

	<?php if( $steps == $onstep ) { ?>

		var viewdict = <?php echo json_encode($viewdict) ?>;
		var input_keys = <?php echo json_encode($input_onlykeys) ?>;
		var typearray = <?php echo json_encode( ReusableClasses::getTypeArray( $input_onlykeys ) ) ?>;
		var dataarray = <?php echo json_encode( Data::getFullArray( $viewdict ) ) ?>;
		var formatteddata = <?php echo json_encode( Data::retrieveDataWithID( $original_data_id ) ) ?>;
		var identifier = "<?php echo $identifier ?>";

		class <?php echo $identifier ?>Classes {
			populateview( index=null ){
				Reusable.setinputvalues( viewdict, input_keys, identifier, typearray, dataarray, formatteddata, index )

				<?php if( $steps > 1 ) { ?>
					$('.main_with_hidden.next').css({'display': 'inline-block'});
					$('.main_with_hidden.save').css({'display': 'none'});
				<?php } else { ?>
					$('.main_with_hidden.save').css({'display': 'inline-block'});
					$('.main_with_hidden.next').css({'display': 'none'});
				<?php } ?>
			}
		}

		if( typeof <?php echo $identifier ?> == 'undefined'  ) {
			var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
			<?php echo $identifier ?>.populateview();
		}

	<?php } ?>


</script>
	
