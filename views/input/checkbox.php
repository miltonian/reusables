<?php

namespace Reusables;
	


$options = Data::getValue( $viewdict, 'options' );
if( $options == "" ) {
	$options = [];
}

$is_smart = Data::getValue( $viewoptions, "is_smart" );

if( $is_smart == "" ) {
	$is_smart = true;
} else if( $is_smart == "0" ) {
	$is_smart = false;
}

$size = Data::getValue( $viewdict, "size" );

if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;

$hide_element = Data::getValue( $viewoptions, "hides_element" );

$field_name = "fieldarray[" . Data::getValue( $viewdict, 'field_index') . "][field_value]";
$field_value = "{[]}";
if( !$is_smart ) {
	// $field_value = Data::getValue( $viewdict, 'field_value' );
	$field_name = Data::getValue( $viewdict, 'field_name' );
	if( $field_name == "" ) {
		$field_name = Data::getValue( $viewoptions, 'field_name' );
		if( $field_name == "" ) {
			$field_name = $identifier;
		}
	}
}

if( sizeof($viewdict) == 0 ) {
	$viewdict = [$identifier];
}
if( sizeof($options) == 0 ) {

	$options = [];
	foreach ($viewdict as $key => $value) {
	    if( !is_numeric($key) ) { break; }
	    if( !is_array($value) ) {
	        $title = $value;
	        // $value = ltrim($value, ' ');
	        // $value = rtrim($value, ' ');
	        $value = strtolower(str_replace(' ', '-', $value));
	        $value = ["title"=>ucfirst(str_replace("_", " ", $title)), "value"=>$value];
	        array_push($options, $value);
	    } else {
	        array_push($options, $value);
	    }
	}
}

if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}

?>

<style>
	.<?php echo $identifier ?> .input_groupaddon { font-size: 14px; font-weight: 400; line-height: 1; color: #555; text-align: center; background-color: #eee; border: 1px solid #ccc; border-radius: 4px; width: 1%; width: 30px; white-space: nowrap; vertical-align: middle; display: table-cell; float: left; border-top-right-radius: 0; padding: 15.5px 0; border-bottom-right-radius: 0; }
	.<?php echo $identifier ?> .field_value.input_withaddon { border-top-left-radius: 0; border-bottom-left-radius: 0; width: calc( 100% - 30px); }
</style>

<div class="viewtype_input <?php echo $identifier ?> checkbox <?php echo $sizeclass ?>">
	<label style="margin-bottom: -5px; /* font-weight: 700; font-size: 11px; */"><?php echo Data::getValue( $viewdict, "labeltext") ?></label>

		<input type="hidden" class="field_value" value="<?php echo $field_value ?>" name="<?php echo $field_name ?>">

		<div class="checkboxes_container" >
			<?php $i=0; ?>
			<?php foreach($options as $o ) { ?>
				<input type="checkbox" class="checkbox_inner index_<?php echo $i ?>" value="<?php echo $o['value'] ?>"><span class="checkbox_title"><?php echo $o['title'] ?></span>
				<?php if( isset($viewoptions['breaks']) ) { ?>
					<br>
				<?php } ?>
				<?php $i++; ?>
			<?php } ?>
		</div>

	<?php if( $is_smart ) { ?>
		<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
		<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict, 'field_table') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][tablename]">
		<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict, 'field_colname') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][col_name]">
		<?php $i=0; ?>
		<?php foreach ($viewdict['field_conditions'] as $c) { ?>
			<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
			<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
			<?php $i++; ?>
		<?php } ?>

	<?php } ?>
</div>

<script>
	var identifier = "<?php echo $identifier ?>";
		identifier = identifier.replace('.', '\\.')
	$('.'+identifier+'.checkbox .checkboxes_container input').change(function(){
		var c = this.checked
		var identifier = "<?php echo $identifier ?>";
		identifier = identifier.replace('.', '\\.')
		var thevalue = $('.'+identifier+'.checkbox .field_value').val();
		if( c ) {
			// add
			if( thevalue == '{[]}' ) {
				thevalue = '{[' + $(this).val() + ']}'
			} else {
				thevalue = thevalue.replace('{[', '')
				thevalue = thevalue.replace(']}', '')
				thevalue = '{[' + thevalue + ',' + $(this).val() + ']}'
			}
		} else {
			// remove
			thevalue = thevalue.replace($(this).val(), "")
			thevalue = thevalue.replace('{[', '')
			thevalue = thevalue.replace(']}', '')
			if( thevalue.startsWith(",") ) {
				thevalue = thevalue.replace(',', '')
			}
			if( thevalue.endsWith(",") ) {
				thevalue = thevalue.slice(0, -1);
			}
			thevalue = thevalue.replace(',,', ',')
			thevalue = '{[' + thevalue + ']}'
		}
		$('.'+identifier+'.checkbox .field_value').val(thevalue);
	})

	$("." + identifier + " div input").change(function () {
        if($(this).prop('checked') == true) {
            $("<?php echo $hide_element; ?>").hide();
        } else {
            $("<?php echo $hide_element; ?>").show();
        }
    });
</script>