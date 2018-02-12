<?php

namespace Reusables;

$viewdict = Data::convertKeys( $viewdict );

$togglearray = Data::getValue( $viewdict, 'data_array' );

$underline_index = Data::getValue( $viewoptions, 'underline_index' );
if( $underline_index == "" ) {
	$underline_index = 0;
}

?>

<style>

	.toggle.viewtype_header.main .toggle.wrapper .toggle.link { width: calc(<?php echo (100 / sizeof($togglearray)) ?>% - 2px); }
	.toggle.viewtype_header.main .toggle.wrapper .toggle.underline_container { display: inline-block; position: absolute; margin: 0; padding: 0; width: 50%; height: 2px; left: 0; top: 70%; text-align: center; }
		.toggle.viewtype_header.main .toggle.wrapper .toggle.underline { width: 60%; background-color: #555; display: inline-block; position: relative; margin: 0; padding: 0; height: 100%; }
	
</style>

<div class="toggle viewtype_header main clicktoedit <?php echo $identifier ?>">
	<div class="toggle wrapper">
		<?php $i=0; ?>
		<?php foreach ($togglearray as $dict) { ?>
		<?php $borderright = "";
			if ( $i==sizeof($togglearray)-1 ) {
				$borderright = "style='border-right-width: 0px;'";
			} ?>
			<a href="<?php echo Data::getValue( $dict, 'link' ) ?>" class="toggle link index_<?php echo $i ?>" <?php echo $borderright ?>>
				<label class="toggle label"><?php echo Data::getValue( $dict, 'title' ) ?></label>
			</a>
			<div class="toggle underline_container">
				<div class="toggle underline"></div>
			</div>
			<?php $i++; ?>
		<?php } ?>
	</div>
</div>



<script>

	$(document).ready(function(){
		var underline_index = <?php echo $underline_index ?>;
		changetoggle(underline_index)
	})

	$('.<?php echo $identifier ?> .toggle.link').click(function(e){
		var index = Reusable.getIndexFromClass( 'index_', this )
		let togglearray = <?php echo json_encode( $togglearray) ?>;
		let dict = togglearray[index]
		let link = dict['link']
		if( link == "" ) {
			e.preventDefault()
			changetoggle(index)
		}
	})

	function changetoggle( index ) {

		let togglearray = <?php echo json_encode( $togglearray) ?>;
		for(var i=0; i<togglearray.length;i++) {
			let dict = togglearray[i]
			let viewlink = dict['viewlink']
			if( i == index ) {
				$('.'+viewlink+'').css({'display': 'inline-block'})
				let percentage = (parseFloat(i) / parseFloat(togglearray.length)) * 100
				$('.<?php echo $identifier ?> .toggle.underline_container').animate({'left': percentage+'%'}, 300)
			} else {
				$('.'+viewlink+'').css({'display': 'none'})
			}
			// alert(JSON.stringify(viewlink))
		}
	}


	$('.<?php echo $identifier ?>.toggle.clicktoedit').click(function(e){
		<?php
			ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
		?>
	})


</script>