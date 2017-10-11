<?php

namespace Reusables;

// DEFAULTS
$placeholder = "Username";
$input_name = "username";
$action = "/functions/login";

$received_placeholder = Data::getValue(  $viewoptions, "placeholder" );
$received_input_name = Data::getValue(  $viewoptions, "input_name" );
$received_action = Data::getValue(  $viewoptions, "action" );

if( $received_placeholder != "" ){ $placeholder = $received_placeholder; }
if( $received_input_name != "" ){ $input_name = $received_input_name; }
if( $received_action != "" ){ $action = $received_action; }

?>


<div class="viewtype_section <?php echo $identifier ?> login main">
	<div class="login thecontainer">
		<form class="login form" method="POST" enctype="multipart/form-data" action="<?php echo $action ?>">
			<input class="login username" type="text" placeholder="<?php echo $placeholder ?>" name="<?php echo $input_name ?>" >
			<input class="login password" type="password" placeholder="Password" name="password" >
			<?php if( isset( $viewoptions['tablename'] ) ) { ?>
				<input class="login tablename" type="hidden" name="tablename" value="<?php echo Data::getValue( $viewoptions, 'tablename' ) ?>">
			<?php } ?>
			<?php if( isset( $viewoptions['username_col'] ) ) { ?>
				<input class="login username_col" type="hidden" name="username_col" value="<?php echo Data::getValue( $viewoptions, 'username_col' ) ?>">
			<?php } ?>
			<input class="login submit" type="submit" value="Submit">
		</form>
	</div>

</div>