<?php

namespace Reusables;



if( !isset( $viewoptions['formaction'] ) ){
	$formaction = '/edit_view.php';
}else{
	$formaction = $viewoptions['formaction'];
}

if( isset( $viewdict['formtitle'] ) ) {
	unset( $viewdict['formtitle'] );
}

$original_data_id = $identifier;

extract( CustomView::makeFormVars( $viewdict, "viewdict" ) );
extract( Input::convertInputKeys( $identifier ) );

// exit( json_encode( Data::getValue( $viewdict, 'db_info' ) ) );
$tablename = Data::getDefaultTableNameWithID( $identifier );
// exit( json_encode( $tablename ) );
$col_to_change = Data::getValue( $viewoptions, 'col_to_change' );
$conditions = Data::getValue( $viewdict['db_info'], 'conditions' );

if( $tablename == "" ){
	exit( "Section/picker_form needs 'tablename' in db_info" );
}
if( $col_to_change == "" ){
	exit( "Section/picker_form needs 'col_to_change' option" );
}
if( $conditions == "" ) {
	exit( "Section/picker_form needs 'conditions' in db_info" );
}
$tablearray = Data::getValue( $viewoptions, 'tablearray' );
if( $tablearray == "" ) {
	exit( "Section/picker_form needs 'tablearray' option" );
}
$tablearray = $tablearray['value'];
// exit( json_encode( $tablearray ) );
$cellname = Data::getValue( $viewoptions, 'cellname' );
if( $cellname == "" ) {
	$cellname = "imagetext_full";
}

?>



<form class='<?php echo $identifier ?>_theform' method='post' action='<?php echo $formaction ?>' enctype='multipart/form-data'>


	<div class="viewtype_section <?php echo $identifier ?> picker_form main">
		<div class='thecontainer' style='text-align: left; margin-top: 10px; margin-bottom: 0px; text-align: center;'>
			<input type="hidden" name="goto" value="<?php echo Data::getValue( $viewoptions, 'goto' ) ?>">

			<input type="hidden" class="tablename" value="<?php echo $tablename ?>" name="fieldarray[0][tablename]">
			<input type="hidden" class="col_name" value="<?php echo $col_to_change ?>" name="fieldarray[0][col_name]">

			<?php $i=0; ?>
			<?php foreach ($conditions as $c) { ?>
				<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[0][field_conditions][<?php echo $i ?>][key]">
				<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[0][field_conditions][<?php echo $i ?>][value]">
				<?php $i++; ?>
			<?php } ?>


			<?php $i=0; ?>
			<?php foreach ($tablearray as $v) { ?>
				<?php Data::add( $v, $identifier . "_cell_" . $i ); ?>
				<?php echo Cell::make( $cellname, $identifier . "_cell_" . $i ); ?>

				<?php $i++; ?>
			<?php } ?>
			<input type="hidden" class="picker_form field_value" value="" name="fieldarray[0][field_value]">

			<!-- <button class="smartform main_with_hidden save custombutton">Save</button> -->
		</div>
	</div>

</form>


<script>

		var viewdict = <?php echo json_encode($viewdict) ?>;
		var input_keys = <?php echo json_encode($input_onlykeys) ?>;
		var typearray = <?php echo json_encode( Form::getTypeArray( $input_onlykeys ) ) ?>;
		var dataarray = <?php echo json_encode( Data::getFullArray( $viewdict ) ) ?>;
		var formatteddata = <?php echo json_encode( Data::get( $original_data_id ) ) ?>;
		var identifier = "<?php echo $identifier ?>";
		var index_clickedfirst = -1
		var tablearray = <?php echo json_encode( $tablearray ) ?>;

		class <?php echo $identifier ?>Classes {
			populateview( index=null ){
				index_clickedfirst = index
			}
		}

		if( typeof <?php echo $identifier ?> == 'undefined'  ) {
			var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
			<?php echo $identifier ?>.populateview();
		}

		$('.viewtype_cell.<?php echo $cellname ?>.main').off().click(function(e){
			e.preventDefault()
			var theindex = Reusable.getIndexFromClass( 'featured_section_form_cell_', this )
			$('.<?php echo $identifier ?>_theform .field_value').val( tablearray[theindex]['id'] )
			identifier = "<?php echo $identifier ?>";
// alert(JSON.stringify( $('.<?php echo $identifier ?>_theform .field_value.index_'+theindex).val() ))

			for (var i = 0; i < formatteddata['db_info']['conditions'].length; i++) {

					var conditions = formatteddata['db_info']['conditions'];
					if(conditions[i]['key'] == "maininfo_key" || conditions[i]['key'] == "custom_key"){
						conditions[i]['value'] = key; 
					}else{

						conditions[i]['value'] = formatteddata['value'][index_clickedfirst][conditions[i]['key']]; 

					}


					$( '.' + identifier + '_theform' + ' input.conditionkey_' + i ).val( conditions[i]['key'] );
					$( '.' + identifier + '_theform' + ' input.conditionvalue_' + i ).val( conditions[i]['value'] );
				}
			


			$('.<?php echo $identifier ?>_theform').submit()

		})

		




</script>
	
