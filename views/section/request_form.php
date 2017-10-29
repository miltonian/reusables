<?php

namespace Reusables;


$inputarray = Data::getValue( $viewdict, "inputs" );

// foreach ( $inputarray as $i ) {
// 	exit( json_encode( $i['type'] ) );
// }

if( $inputarray == "" ) { $inputarray = []; }


	Views::setParams( 
		[ "title", "subtitle", "form_action", "inputs"=>["placeholder", "name", "type", "options"=>["value", "title"]] ], 
		[],
		$identifier
	);

?>

<div class="viewtype_section request_form main <?php echo $identifier ?>" >

	<div class="request_form thecontainer" >
		<div class="request_form inner">
			<h2 class="request_form title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h2>
			<h2 class="request_form subtitle"><?php echo Data::getValue( $viewdict, 'subtitle' ) ?></h2>
			<div class="request_form content_container">
				<form class="request_form theform" method="GET" action="<?php echo Data::getValue( $viewdict, 'form_action' ) ?>" >
					<?php foreach( $inputarray as $i ) { ?>
						<?php if( $i['type'] == "text" ) { ?>
							<input type="text" placeholder="<?php echo $i['placeholder'] ?>" class="request_form input text_input" name="<?php echo $i['name'] ?>" >
						<?php }else if( $i['type'] == "select" ){ ?>
							<select class="request_form input select_input" name="<?php echo $i['name'] ?>" >
								<?php foreach($i['options'] as $o ) { ?>
									<option value="<?php echo $o['value'] ?>"><?php echo $o['title'] ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					<?php } ?>
					<button class="request_form submit_button" >Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>