<?php 

	namespace Reusables;

	$viewdict = Convert::keysInTable( $identifier, $viewdict );
	
	extract( Cell::prepareCell( $identifier ) );

	$result = '';

	$columns = Data::getValue( $viewoptions, 'columns' );
	if( $columns == "" ) {
		$columns = [];
	}


$tablename = Data::getDefaultTableNameWithID($table_identifier);
foreach ($columns as $key => $value) {
	$val_arr = explode(".", $value['key']);
	if( sizeof($val_arr) == 1 ) {
		$value['key'] = $tablename . "." . $value['key'];
		$columns[$key] = $value;
	}
}

?>

<style>
	tbody.viewtype_cell.columns.main tr td { text-align: left; }

</style>


<tbody class="viewtype_cell columns main <?php echo $identifier ?> index_<?php echo $cellindex ?> index_<?php echo $cellindex ?> clicktoedit" >
        <tr>
			<?php foreach ($columns as $c) { ?>
				<td><?php echo Data::getValue( $viewdict, $c['key'] ) ?></td>
			<?php } ?>
        </tr>
	        
</tbody>

<script>

	<?php
		Editing::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>