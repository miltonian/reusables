<?php

namespace Reusables;
	
if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}

$options = Data::getValue( $viewdict, 'options' );
if( $options == "" ) {
	$options = [];
}

?>

<style>
	.<?php echo $identifier ?> .input_groupaddon { font-size: 14px; font-weight: 400; line-height: 1; color: #555; text-align: center; background-color: #eee; border: 1px solid #ccc; border-radius: 4px; width: 1%; width: 30px; white-space: nowrap; vertical-align: middle; display: table-cell; float: left; border-top-right-radius: 0; padding: 15.5px 0; border-bottom-right-radius: 0; }
	.<?php echo $identifier ?> .field_value.input_withaddon { border-top-left-radius: 0; border-bottom-left-radius: 0; width: calc( 100% - 30px); }
</style>

<div class="viewtype_input <?php echo $identifier ?> checkbox">
	<label style="margin-bottom: -5px; font-weight: 700; font-size: 11px"><?php echo Data::getValue( $viewdict, "labeltext") ?></label>

		<input type="text" class="field_value" value="{[]}" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_value]">

		<div class="checkboxes_container" >
			<?php $i=0; ?>
			<?php foreach($options as $o ) { ?>
				<input type="checkbox" class="index_<?php echo $i ?>" value="<?php echo $o['value'] ?>"><?php echo $o['title'] ?>
				<?php $i++; ?>
			<?php } ?>
		</div>

	<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict, 'field_table') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict, 'field_colname') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][col_name]">
	<?php $i=0; ?>
	<?php foreach ($viewdict['field_conditions'] as $c) { ?>
		<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
		<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
		<?php $i++; ?>
	<?php } ?>
</div>

<script>
	$('.<?php echo $identifier ?>.checkbox .checkboxes_container input').change(function(){
		var c = this.checked

		var thevalue = $('.<?php echo $identifier ?>.checkbox .field_value').val();
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
		$('.<?php echo $identifier ?>.checkbox .field_value').val(thevalue);
	})
</script>