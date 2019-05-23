<?php

namespace Reusables;

// check if form is for changing options
if( !isset( $viewoptions['is_option_form'] ) ) { $is_option_form = false; } else { $is_option_form = true; }

// check if form is for insertion
if( !isset( $viewoptions['ifnone_insert'] ) ){ $ifnone_insert = false; }else{ $ifnone_insert = $viewoptions['ifnone_insert']; }

// check if form is for multiple inserts
if( !isset( $viewoptions['multiple_inserts'] ) ){ $multiple_inserts = false; }else{ $multiple_inserts = $viewoptions['multiple_inserts']; }

// check if form is for multiple updates
if( !isset( $viewoptions['multiple_updates'] ) ){ $multiple_updates = false; }else{ $multiple_updates = $viewoptions['multiple_updates']; }

if( !isset( $viewoptions['formaction'] ) ){
	if( $is_option_form ) {
		echo "<style> .modal_background  .".$identifier."_wrapper.main.wrapper_1 { max-width: 700px; max-height: 600px; top: 50%; transform: translateY(-50%); width: 200px !important; height: 400px; position: absolute; left: 20px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5); top: 100px !important; transform: none !important; } </style>";
		echo "<style> .modal_background.".$identifier."_modalbackground.main .modal_background.maincolumn { width: 100%; } </style>";
		echo "<style> .modal_background.".$identifier."_modalbackground.main .modal_background.overlay { background: transparent; } </style>";
		$formaction = '/edit_page_options.php';
	} else {
		$formaction = '/edit_view.php';

	}
}else{
	$formaction = $viewoptions['formaction'];
}

if( isset( $viewdict['formtitle'] ) ) {
	unset( $viewdict['formtitle'] );
}

$original_data_id = $identifier;

$insert_values = [];
if( isset($viewoptions['insert_values']) ) {
	$insert_values = $viewoptions["insert_values"];
}

$added_inputs = Data::getValue( $viewoptions, 'added_inputs' );
if( $added_inputs == "" ) {
	$added_inputs = [];
}

// create vars for data_id, viewdict, default_tablename
extract( CustomView::makeFormVars( $viewdict, "viewdict" ) );

// create html for each input and assign them to vars
extract( Input::convertInputKeys( $identifier ) );

?>


<style>
	<?php if( $steps > 1 ) { ?>

		/* if there is more than one step then hide the SAVE button and show the NEXT button */
		.smartform.main_with_hidden.next { display: inline-block; }
		.smartform.main_with_hidden.save { display: none; }
	<?php }else{ ?>

		/* if there is more than one step then hide the NEXT button and show the SAVE button */
		.smartform.main_with_hidden.next { display: none; }
		.smartform.main_with_hidden.save { display: inline-block; }
	<?php } ?>

	.added_inputs { display: inline-block; position: relative; margin: 10px 0; padding: 10px; width: calc(100% - 0px); font-size: 18px; font-weight: 300; color: #333333; background-color: white; border: 1px solid #e0e0e0; border-radius: 5px; }
</style>


<!-- if we're on the first step of the form then open with the form tag -->
<?php if( $onstep==1 ){ ?>

	<form class='<?php echo $identifier ?>_theform' method='post' action='<?php echo $formaction ?>' enctype='multipart/form-data'>
<?php } ?>

<!-- if this is a form for inserting data then mark it as a hidden input -->
<?php if( $ifnone_insert ){ ?>

	<input type='hidden' name='ifnone_insert' value='1' >
<?php } ?>

<!-- if this is a form for multiple insertions then mark it as a hidden input -->
<?php if( $multiple_inserts ){ ?>

	<input type='hidden' name='multiple_inserts' value='1' >
<?php } ?>

<!-- if this is a form for multiple updates then mark it as a hidden input -->
<?php if( $multiple_updates ){ ?>

	<input type='hidden' name='multiple_updates' value='1' >
<?php } ?>


<div class="viewtype_section <?php echo $identifier ?> smartform main">
	<div class='thecontainer' style='text-align: left; margin-top: 10px; margin-bottom: 0px; text-align: center;'>
		<label class="smartform titlelabel"><?php echo Data::getValue( $viewoptions, 'title' ) ?></label>
		<input type="hidden" name="goto" value="<?php echo Data::getValue( $viewoptions, 'goto' ) ?>">
		<input type="hidden" name="added_file" value="<?php echo Data::getValue( $viewoptions, 'added_file' ) ?>">

		<!-- if you add extra inputs they go here -->
		<?php foreach ($added_inputs as $ai) { ?>
			<input class="added_inputs" type="<?php echo Data::getValue( $ai, 'type' ); ?>" name="<?php echo Data::getValue( $ai, 'name' ); ?>" value="<?php echo Data::getValue( $ai, 'value' ); ?>" >
		<?php } ?>
			<?php

				// add a structure for each step
				echo Structure::make(
					"one_column",
					[
						"maincolumn" => $inputs[ 'c' . $onstep ]

					],
					$identifier . "_onstep_" . $onstep . "_main_structure smartform"
				);

			?>

			<?php if( $steps > 1 ){ ?>
				<!-- if there is more than one step in this form then add a next button -->

				<button class="smartform main_with_hidden next custombutton">Next</button>
				<button class="smartform main_with_hidden save custombutton">Save</button>
			<?php }else { ?>
				<!-- if there is only one step then only add a save buton -->

				<button class="smartform main_with_hidden save custombutton">Save</button>
			<?php } ?>
	</div>
</div>

<!-- if we're on the final step of the form then write the closing tag for the form -->
<?php if( $onstep == $steps ) { ?>
	</form>
<?php } ?>

<script>

	<?php if( $steps == $onstep ) { ?>

		var viewdict = <?php echo json_encode($viewdict) ?>;
		var input_keys = <?php echo json_encode($input_onlykeys) ?>;
		var typearray = <?php echo json_encode( Form::getTypeArray( $input_onlykeys ) ) ?>;

		var dataarray = <?php echo json_encode( Data::getFullArray( $viewdict ) ) ?>;
		var formatteddata = <?php echo json_encode( Data::get( $original_data_id ) ) ?>;
		var identifier = "<?php echo $identifier ?>";

		// add javascript classes and functions to form inputs so they connect with the correct view when it is selected
		<?php echo Form::addJSClassToForm( $identifier, $viewdict, $input_onlykeys, $identifier );?>;

		// identifiers are also the vars that contain the view
		// make sure the identifier var is defined
		if( typeof <?php echo $identifier ?> == 'undefined'  ) {

			// each view has a class that is named like [identifier]Classes -- with [identifier] being replaced by the actual identifier
			var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();

			// each view connects to the populateview() function
			// if there is multiple views in one row then an index will also be passed in this function indicating which view in the row was selected
			<?php echo $identifier ?>.populateview();

		}

	<?php } ?>

</script>
