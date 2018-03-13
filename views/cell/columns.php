<?php 

	namespace Reusables;

	$viewdict = Data::convertKeysInTable( $identifier, $viewdict );
	
	extract( Cell::prepareCell( $identifier ) );

	// $title = Data::getValue($viewdict, 'title', $table_identifier);
	$result = '';

	$columns = Data::getValue( $viewoptions, 'columns' );
	if( $columns == "" ) {
		$columns = [];
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
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>