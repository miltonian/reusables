<?php

namespace Reusables;




$is_currency = Data::getValue( $viewdict, "is_currency" );
$is_hidden = Data::getValue( $viewdict, "is_hidden" );
$size = Data::getValue( $viewdict, "size" );
$labeltext = Data::getValue( $viewdict, "labeltext" );
$placeholder = Data::getValue( $viewdict, "placeholder" );
$field_value = Data::getValue( $viewdict, "field_value" );
$is_smart = Data::getValue( $viewoptions, "is_smart" );
if( $is_smart == "" ) {
	$is_smart = true;
} else {
	$is_smart = false;
}

if( $is_currency == "" && $is_hidden == "" && $size == "" && $labeltext == "" && $placeholder=="" && $field_value == "" ) {

	$is_currency = Data::getValue( $viewoptions, "is_currency" );
	$is_hidden = Data::getValue( $viewoptions, "is_hidden" );
	$size = Data::getValue( $viewoptions, "size" );
	$labeltext = Data::getValue( $viewoptions, "labeltext" );
	$placeholder = Data::getValue( $viewoptions, "placeholder" );
	$field_value = Data::getValue( $viewoptions, "field_value" );
}

if( $placeholder == "" ) {
	$placeholder = ucfirst(str_replace("_", " ", $identifier));
}
if( $labeltext == "" ) {
	$labeltext = ucfirst(str_replace("_", " ", $identifier));
}



if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}else if( sizeof($viewdict['field_conditions']) == 1 ) {
	if( sizeof($viewdict['field_conditions'][0]) == 0 ) {
		$viewdict['field_conditions'] = [];
	}
}



if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;



$field_name = "fieldarray[" . Data::getValue( $viewdict, 'field_index') . "][field_value]";
if( !$is_smart ) {
	$field_name = Data::getValue( $viewdict, 'field_name' );
	if( $field_name == "" ) {
		$field_name = Data::getValue( $viewoptions, 'field_name' );
		if( $field_name == "" ) {
			$field_name = $identifier;
		}
	}
}

$keys = array_keys( $viewoptions );
$attributes = "";
foreach ($viewoptions as $key => $value) {
	$key = $keys[$i];
	if( $key != "is_smart" && $key != "is_currency" && $key != "is_hidden" && $key != "size" && $key != "labeltext" && $key != "placeholder" && $key != "field_value" ) {
		if( $key == "" && is_numeric($value) ) {
			continue;
		}
		$attributes .= " ";
		if( $key == "" ) {
			$attributes .= $value . " = " . $value ;
		} else {
			$attributes .= $key . " = " . $value;
		}
		$attributes .= " ";
	}
}

?>

<style>
	.<?php echo $identifier ?> .input_groupaddon { font-size: 14px; font-weight: 400; line-height: 1; color: #555; text-align: center; background-color: #eee; border: 1px solid #ccc; border-radius: 4px; width: 1%; width: 30px; white-space: nowrap; vertical-align: middle; display: table-cell; float: left; border-top-right-radius: 0; padding: 15.5px 0; border-bottom-right-radius: 0; }
	.<?php echo $identifier ?> .field_value.input_withaddon { border-top-left-radius: 0; border-bottom-left-radius: 0; width: calc( 100% - 32px); }
</style>


<div class="viewtype_input <?php echo $identifier ?> timepicker <?php echo $sizeclass ?>">
	<?php if( !$is_hidden ){ ?>
		<label style="margin-bottom: -5px; /* font-weight: 700; font-size: 11px; */"><?php echo $labeltext ?></label>
	<?php } ?>
	<?php if( $is_currency != "" ){ ?>
		<span class="input_groupaddon">$</span>
		<input type="text" class="field_value input_withaddon" placeholder="<?php echo $placeholder ?>" value="<?php echo $field_value ?>" name="<?php echo $field_name ?>"  <?php echo $attributes ?> >
	<?php }else if( $is_hidden ){ ?>
		<input type="hidden" class="field_value" placeholder="<?php echo $placeholder ?>" value="<?php echo $field_value ?>" name="<?php echo $field_name ?>"  <?php echo $attributes ?> >
	<?php }else{ ?>
		<input type="text" class="field_value" id="<?php echo $identifier ?>_timepicker" placeholder="<?php echo $placeholder ?>" value="<?php echo $field_value ?>" name="<?php echo $field_name ?>"  <?php echo $attributes ?> >
	<?php } ?>

	<?php if( $is_smart ) { ?>
		<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
		<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict, 'field_table') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][tablename]">
		<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict, 'field_colname') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][col_name]">
		<?php $i=0; ?>
		<?php if( sizeof( $viewdict['field_conditions'] ) > 0 ){
			foreach ($viewdict['field_conditions'] as $c) { ?>
				<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
				<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
				<?php $i++; ?>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>


<script>

var identifier = "<?php echo $identifier ?>";
		identifier = identifier.replace('.', '\\.')
$('.'+identifier+'.timepicker #'+identifier+'_timepicker').timepicker({ 'scrollDefault': 'now' });


	$('.'+identifier+'.timepicker #'+identifier+'_timepicker').on('click', function (){
		var identifier = "<?php echo $identifier ?>";
		identifier = identifier.replace('.', '\\.')
	    $('.'+identifier+'.timepicker #'+identifier+'_timepicker').timepicker({ 'scrollDefault': 'now' });
	});





</script>