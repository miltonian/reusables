<?php
namespace Reusables;

$viewdict = Data::convertKeys( $viewdict );

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

?>

<button class="viewtype_button <?php echo $identifier ?> basic"><?php echo Data::getValue( $viewdict, 'title' ) ?></button>

<script>

	
var viewdict = <?php echo json_encode($viewdict) ?>;
var isediting = <?php echo $isediting ?>;

var viewdict = <?php echo json_encode( $viewdict ) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	var thismodalclass = "";
	<?php $celltype = "" ?>
	var type = <?php echo json_encode( $optiontype ) ?>;

	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $viewoptions['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php } ?>

	var viewdict = <?php echo json_encode($viewdict) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	var viewdict = <?php echo json_encode($viewdict) ?>;

	$('.<?php echo $identifier ?>').click(function(e){

		var optiontype = <?php echo json_encode($optiontype) ?>;
		if( optiontype == "modal" || optiontype == "dropdown" ) { 
			e.preventDefault();
			if( typeof dataarray === "undefined" ) { 
				dataarray = []
			}
			Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
		}

		<?php 
			ReusableClasses::getEditingFunctionsJS( $viewoptions ) ;
		?>

		if( typeof dataarray === "undefined" ) {
			dataarray = []
		}
		var viewdict = <?php echo json_encode($viewdict) ?>;
		var viewoptions = <?php echo  json_encode( $viewoptions ) ?>;
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );


	});

</script>