<?php

namespace Reusables;

$userinteractions = $viewdict['userinteractions'];

$buttons = "";

// if( isset($viewdict['buttons']) ){
// 	$i=0;
// 	foreach ($viewdict['buttons'] as $b) {
// 		$buttons .= "<button class='header_3 index_" . $i . " " . $b['classname'] . "'>" . $b['name'] . "</button>";
// 		$i++;
// 	}
// }


	Views::setParams( 
		[], 
		[],
		$identifier
	);


?>

<div class="buttonsinline_1" style='display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; max-width: 150px; margin-top: 25px;'>

	<div style='display: inline-block; position: relative; margin: 0; padding: 0; float: left; width: 33.33%'>
	<a class="buttonsinline_1 action index_0" style='text-decoration: none; float: right; border: 0; position: relative; margin: 0 5px; font-size: 23px; width: calc(100% - 10px)' href='/'>&#x1F50A</a>
	<label style='display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; text-align: center; font-size: 10px'>
		<?php echo Data::getValue( $userinteractions, 'referral' ) ?>			</label>
</div>
		<div style='display: inline-block; position: relative; margin: 0; padding: 0; float: left; width: 33.33%'>
	<a class="buttonsinline_1 action index_1" style='text-decoration: none; float: right; border: 0; position: relative; margin: 0 5px; font-size: 23px; width: calc(100% - 10px)' href='/'>&#x1F4B0</a>
	<label style='display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; text-align: center; font-size: 10px'>
		<?php echo Data::getValue( $userinteractions, 'money' ) ?>			</label>
</div>
		<div style='display: inline-block; position: relative; margin: 0; padding: 0; float: left; width: 33.33%'>
	<a class="buttonsinline_1 action index_2" style='text-decoration: none; float: right; border: 0; position: relative; margin: 0 5px; font-size: 23px; width: calc(100% - 10px)' href='/'>&#x1F680</a>
	<label class="buttonsinline_1 alabel index_2" style='display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; text-align: center; font-size: 10px'>
		<?php echo Data::getValue( $userinteractions, 'connections' ) ?>			</label>
	</div>

<script>

<?php if( isset( $viewdict['buttons'] ) ){ ?>
var editingfunctions = [];
<?php $i=0; foreach ($viewdict['buttons'] as $hb) { ?>
	<?php if( $hb['type'] == "modal" ){ ?>
		var thismodalclass = new <?php echo $hb['modal']['modalclass'] ?>Classes();
		editingfunctions.push( thismodalclass );
	<?php }else{ ?>
		editingfunctions.push( "nothing" );
	<?php } ?>
	<?php $i++; ?>
<?php } ?>

var viewdict = <?php echo json_encode($viewdict) ?>;

	$('.buttonsinline_1.action').click(function(e){
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
			var buttondict = viewdict['buttons'][theindex];
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

			}else if( type == "add" ){
				var connections = $('.buttonsinline_1.alabel').text();
				connections = parseInt(connections);
				connections++
				$('.buttonsinline_1.alabel').text(connections)
			}
		}
	});

	<?php } ?>
</script>