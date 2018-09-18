<?php

namespace Reusables;

$viewdict = Convert::keys( $viewdict );

$togglearray = [];
foreach ($viewdict as $key => $value) {

	if( $key == "data_id" && !is_numeric($key) ) {
		continue;
	} 
	$togglearray[$key] = $value;
}

// $togglearray = Data::getValue( $viewdict, 'data_array' );
$underline_index = Data::getValue( $viewoptions, 'underline_index' );
if( $underline_index == "" ) {
	$underline_index = 0;
}

?>

<style>

	.toggle.viewtype_header.main .toggle.wrapper .toggle.link { width: calc(<?php echo (100 / sizeof($togglearray)) ?>% - 2px); }

	.toggle.viewtype_header.main .toggle.wrapper .toggle.underline_container { display: inline-block; position: absolute; margin: 0; padding: 0; width: calc(<?php echo (100 / sizeof($togglearray)) ?>% - 2px); height: 2px; left: 0; top: 70%; text-align: center; }

		.toggle.viewtype_header.main .toggle.wrapper .toggle.underline { width: 60%; background-color: #555; display: inline-block; position: relative; margin: 0; padding: 0; height: 100%; }
	
</style>

<div class="toggle viewtype_header main clicktoedit <?php echo $identifier ?>">
	<div class="toggle wrapper">
		<?php $i=0; ?>
		<?php foreach ($togglearray as $key => $value) { ?>
			<?php $dict = $togglearray[$key]; ?>
		<?php $borderright = "";
			if ( $i==sizeof($togglearray)-1 ) {
				$borderright = "style='border-right-width: 0px;'";
			} ?>
			<a href="<?php echo Data::getValue( $dict, 'link' ) ?>" class="toggle link index_<?php echo $i ?>" <?php echo $borderright ?>>
				<?php if( is_numeric($key) ) { ?>
					<label class="toggle label"><?php echo $value ?></label>
				<?php } else { ?>
					<label class="toggle label"><?php echo $key ?></label>
				<?php } ?>
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
		var array_keys = []
		$.each(togglearray, function(key, value) {
		      array_keys.push(key)
		})

		let dict = togglearray[array_keys[index]]
		
		// let link = dict['link']
		
		// if( link == "" || typeof link === "undefined" ) {
			e.preventDefault()
			changetoggle(index)
		// }
	})

	function changetoggle( index ) {

		let togglearray = <?php echo json_encode( $togglearray) ?>;
		let togglearraysize = <?php echo json_encode( sizeof($togglearray ) ); ?>;

		for(var i=0; i<togglearraysize;i++) {
			var array_keys = []
			$.each(togglearray, function(key, value) {
			      array_keys.push(key)
			})

			let dict = togglearray[array_keys[i]]
			// let viewlink = dict['viewlink']
			let viewlink = dict
			if( i == index ) {
				$('.'+viewlink+'').css({'display': 'inline-block'})
				let percentage = (parseFloat(i) / parseFloat(togglearraysize)) * 100
				$('.<?php echo $identifier ?> .toggle.underline_container').animate({'left': percentage+'%'}, 300)
			} else {
				$('.'+viewlink+'').css({'display': 'none'})
			}
			// alert(JSON.stringify(viewlink))
		}
	}


	$('.<?php echo $identifier ?>.toggle.clicktoedit').click(function(e){
		<?php
			Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
		?>
	})


</script>