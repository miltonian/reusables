<?php

namespace Reusables;
// exit( json_encode( $viewdict ) );


$title = Data::getValue( $viewdict, 'title' );
if( $title == "" ) {
	if( isset($viewdict[0]) ) {
		if( is_string($viewdict[0]) ) {
			$title = $viewdict[0];
		}
	}
}

$help_modal = Data::getValue( $viewoptions, "help_modal" );

$modal_type = "";
if( $help_modal != "" ) {
	$modal_type = "modal";
	$modal_name = $help_modal["modalclass"];
	$modal_parent = $help_modal["parentclass"];
	$info = Info::get($modal_name);
	if( $info["file"] != "smartform" && $info["file"] != "smartform_inmodal" ) {
		$connectedto_smartform = false;
	}
}
?>

<style>
</style>

<div class="viewtype_header <?php echo $identifier ?> basic_label main clicktoedit">
	<label class="basic_label title" id="title"><?php echo $title ?>
		<?php if($help_modal != "") { ?>
			<i class="basic_label help_button fa fa-question-circle" style="cursor: pointer"></i>
		<?php } ?>
	</label>
</div>

<script>

	<?php if( isset($modal_name) ) { ?>

		$('.<?php echo $identifier ?> .basic_label.help_button').click(function(e){
			e.preventDefault()
			$("div.viewtype_structure.<?php echo $modal_name ?>_outer_structure.modal_background.main").css({"display": "inline-block"})
			$("div.viewtype_structure.<?php echo $modal_name ?>_outer_structure.modal_background.main .<?php echo $modal_parent ?>").css({"display": "inline-block"})
		})
	<?php } ?>

	$('.<?php echo $identifier ?>.basic_label.clicktoedit').click(function(e){
		<?php
			Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
		?>
	})


</script>