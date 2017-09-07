<?php

namespace Reusables;

	/*
		$sectiondict = [
			"featured_imagepath"=>"",
			"logo_imagepath"=>"",
			"title"=>"",
			"adposition"=>0,
			"desc"=>""
		]
	*/

	$sectiondict = Data::convertKeys( $sectiondict );

	if( isset( $sectiondict['value'] ) ){ 
		$data_id = Data::getDefaultDataID( $sectiondict );
		// exit( json_encode( $sectiondict ) );
		$sectiondict = Data::formatForDefaultData( $data_id );
		// SHOULD CONTROL DATA WITH ID NOT VAR
	}
	if( isset($sectiondict['editing']) ){ $isediting=1; }else{ $isediting=0; }
	
	// exit( json_encode( Data::getValue( $sectiondict, 'logo_imagepath' ) ) ) ;

?>

<style>
<?php if($isediting){ ?>
	.featuredsection_6 { cursor: pointer; }
		.featuredsection_6:hover { opacity: 0.8; }
<?php } ?>
</style>

<div class="featuredsection_6 <?php echo $identifier ?>">
	<div class="backgroundimage" style="background-image: url('<?php echo Data::getValue( $sectiondict, 'featured_imagepath' ) ?>');">
		<div class="gradient"></div>
	</div>
	<div class="header">
		<img id="logo" src="<?php echo Data::getValue( $sectiondict, 'logo_imagepath' ) ?>">
		<h3 id="title"><?php echo Data::getValue( $sectiondict, 'title' ) ?></h3>
	</div>
</div>

<script>

var sectiondict = <?php echo json_encode($sectiondict) ?>;
var isediting = <?php echo $isediting ?>;

$('.featuredsection_6').click(function(e){
	if(isediting){
		e.preventDefault();
		var editingdict = sectiondict['editing'];
		var type = editingdict['type'];

		if( type == "link" ){
			window.open(editingdict[type]);
		}else if( type == "modal" ){
			// var theclasses = $.extend( { editingdict[type]['modalclass']+Classes; } );
			<?php if( isset( $sectiondict['editing'] ) ) { ?>

				let modalclasses = new <?php echo $sectiondict['editing']['modal']['modalclass'] ?>Classes();
				// modalclass.populateview( $(this).id );
				modalclasses.populateview();
				$('.modal_background').css({'display': 'inline-block'});
				$('.' + editingdict[type]['parentclass']).css({'display': 'inline-block'});
				
			<?php } ?>
		}else if( type == "popview" ){

		}
	}
});

</script>