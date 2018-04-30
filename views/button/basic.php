<?php

namespace Reusables;

Views::setParams( 
	["link", "title" ], 
	[],
	$identifier
);

$title = Data::getValue( $viewdict, 'title' );
if( $title == "" ) {
	if( isset($viewdict[0]) ) {
		if( is_string($viewdict[0]) ) {
			$title = $viewdict[0];
		}
	}
}

$viewdict = Data::convertKeys( $viewdict );

$connectedto_smartform = true;

$modal = Data::getValue( $viewoptions, "modal" );

$modal_type = "";
if( $modal != "" ) {
	$modal_type = "modal";
	$modal_name = $modal["modalclass"];
	$modal_parent = $modal["parentclass"];
	$info = Data::retrieveInfoWithID($modal_name);
	if( $info["file"] != "smartform" && $info["file"] != "smartform_inmodal" ) {
		$connectedto_smartform = false;
	}
}
$is_editable = Data::getValue( $viewoptions, "is_editable" );

	if( isset( $viewdict['value'] ) ){ 
		$data_id = $identifier;
		// exit( json_encode( $viewdict ) );
		// $viewdict = Data::formatForDefaultData( $data_id );
	// exit( json_encode( Data::getValue( $viewdict, 'featured_imagepath' ) ) );
		// SHOULD CONTROL DATA WITH ID NOT VAR
	}
	if( isset($viewdict['editing']) ){ $isediting=1; }else{ $isediting=0; }
	

	$linkpath = Data::getValue( $viewoptions, 'pre_slug' ) . Data::getValue( $viewdict, 'slug' );
	if( $linkpath == "" ) {
		$linkpath = "#";
	}
	$optiontype = Data::getValue( $viewoptions, 'type' );
	$fullarray = Data::getFullArray( $viewdict );
if( isset( $viewdict[$identifier]['value'] ) ) {
	$fullviewdict = Data::getFullArray( $viewdict )[$identifier]['value'];
}else{
	$fullviewdict = $viewdict;
}

$classnames = Data::getValue( $viewoptions, "classnames" );


?>
<style>
	div.viewtype_button.basic.main { width: auto; }
</style>

<div class="viewtype_button <?php echo $identifier ?> basic main">
	<a class="basic link" href="<?php echo Data::getValue( $viewdict, 'link' ) ?>">
		<button class="basic button <?php echo $classnames ?>"><i class="<?php echo Data::getValue( $viewoptions, "i_classnames") ?>"></i> <?php echo $title ?></button>
	</a>
</div>




<script>


	$('.<?php echo $identifier ?> .basic.button').click(function(e){
		var connectedto_smartform = <?php echo json_encode($connectedto_smartform) ?>;
		if( connectedto_smartform == false ) {
			e.preventDefault()
			$("div.viewtype_structure.<?php echo $modal_name ?>_outer_structure.modal_background.main").css({"display": "inline-block"})
			$("div.viewtype_structure.<?php echo $modal_name ?>_outer_structure.modal_background.main .<?php echo $modal_parent ?>").css({"display": "inline-block"})
		} else {
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier, true );
			?>
		}
	})

</script>