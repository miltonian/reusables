<?php

namespace Reusables;

// exit( json_encode( $viewoptions ) );
	if( !isset($viewoptions['sortable'])){
		$sortable = false;
	}else {
		$sortable = $viewoptions['sortable'];
	}
// exit( json_encode( $sortable ) );

	if( isset($viewdict['value']) ){
		$tablearray = $viewdict['value'];
	}else{
		$tablearray = $viewdict;
	}

	$temp_tablearray = $tablearray;
	// exit( json_encode( $temp_tablearray ) );
	unset( $temp_tablearray['data_id'] );

	$columns = Data::getValue( $viewoptions, 'columns' );
	if( $columns == "" ) {
		$columns = [];
	}

	$options_cellname = Data::getValue( $viewoptions, 'cellname' );

	$num_of_columns = Data::getValue( $viewoptions, "num_of_columns" );
	if( $num_of_columns != "" ) {
		$num_of_columns = floatval($num_of_columns);
	}

?>

<style>
<?php if( $sortable ){ ?>
	#sortable {width: 100%; display: inline-block; padding: 0;}
	li { list-style-type: none; }
		li.ui-state-default.ui-sortable-handle { width: 100%; left: 0; }
		li.ui-state-default.ui-sortable-helper { left: 30px; }
		.ui-state-default { display: inline-block; }
<?php } ?>
<?php if( $num_of_columns != "" ) { ?>

	.viewtype_cell.main { width: <?php echo (100.0 / $num_of_columns) ?>%  !important; }
<?php } ?>
</style>

<div class="viewtype_table <?php echo $identifier ?> table_2">
	<?php if( $options_cellname == "columns" ) { ?>
		<table class="table" style="background-color: transparent; display: table;">
	<?php } else { ?>
		<div class="table" style="background-color: transparent;">
	<?php } ?>
		<?php if( sizeof( $columns) > 0 ) { ?>
			<thead>
				<?php foreach ( $columns as $c ) { ?>
					<th><?php echo Data::getValue( $c, 'title' ) ?></th>
				<?php } ?>
			</thead>
		<?php } ?>
<?php if($sortable){ ?>
	<ul id="sortable" style="background-color: transparent;">
<?php } ?>
		<?php
			for ($i=0; $i < sizeof( $temp_tablearray ); $i++) {
				if($sortable){
					?>

					<li id="<?php echo $i ?>" class="ui-state-default" style="background-color: transparent; border: 0;">
					<?php
				}

				if( isset($viewdict['value']) ){
					$post = RFormat::formatCellWithDefaultData( $identifier , $i );
				}else{
					$post = Data::getValue( $tablearray, $i );
				}


				$post = Convert::keysInTable( $identifier, $post );
				$post['index'] = $i;
				$postoptions['pre_slug'] = Data::getValue( $viewoptions, 'pre_slug' );
				$postoptions['type'] = Data::getValue( $viewoptions, 'type' );
				$postoptions['fulldesc'] = Data::getValue( $viewoptions, 'fulldesc' );
				$postoptions['modal_type'] = Data::getValue( $viewoptions, 'modal_type' );
				$postoptions['columns'] = $columns;
				if( Data::getValue( $viewoptions, 'modal' ) != "" ) {
					$postoptions['modal'] = Data::getValue( $viewoptions, 'modal' );
				}
				if( Data::getValue( $viewoptions, 'attached' ) != "" ) {
					$postoptions['attached'] = Data::getValue( $viewoptions, 'attached' );
				}

				// exit( json_encode( Data::getValue( $viewdict ) ) );
				if( isset( $viewoptions['celldict'] ) ) {
					$post = array_merge( $post, $viewoptions['celldict'] );
				}

				if( isset( $viewoptions['slug'] ) ) { $postoptions['slug'] = Data::getValue( $viewoptions, 'slug' ); }
				if( isset( $viewoptions['actions'] ) ){ $postoptions['actions'] = $viewoptions['actions']; }else{ /* $postoptions['actions'] = array(); */ }
// exit(json_encode( $postoptions ) );
				Data::add( $post, $identifier . "_cell_" . $i );
				Data::addOptions( $postoptions, $identifier . "_cell_" . $i );
				$post_cellname = Data::getValue( $post, 'cellname', $identifier );
				if( $post_cellname != "" ) {
					$cellname = Data::getValue( $post, 'cellname', $identifier );
				}else {
					$cellname = Data::getValue( $viewoptions, 'cellname' );
					if( $cellname == "" ){
						// default cell
						$cellname = "imagetext_full";
					}
				}
				Info::add( "Cell", 'viewtype', $identifier . "_cell_" . $i );
				Info::add( $cellname, 'file', $identifier . "_cell_" . $i );
				Info::add( $identifier . "_cell_" . $i, 'identifier', $identifier . "_cell_" . $i );

				if( Shortcuts::hasPrefix( $cellname, "custom/" ) ) {
					$filename = substr( $cellname, strlen( "custom/" ), strlen( $cellname ) );
					// exit( json_encode( $filename ) );
				    echo CustomView::make( $filename, $identifier . "_cell_" . $i );
				}else {
					echo Cell::make( $cellname, $identifier . "_cell_" . $i );
				}
				if($sortable){ ?>
					</li>
				<?php }
			}
		?>
		<?php if($sortable){ ?>
			</ul>
		<?php } ?>
	<?php if( $options_cellname == "columns" ) { ?>
		</table>
	<?php } else { ?>
		</div>
	<?php } ?>
</div>



<script>


	<?php if( $sortable ){ ?>
		$( function() {
		    $( "#sortable" ).sortable({
			    axis: 'y',
				containment: "body",
			    disabled: true,
			    helper: 'clone',
			  update: function( event, ui ) {

				},
				start: function( event, ui ) {

				},
				stop: function( event, ui ) {

				}
		    });
		    $( "#sortable" ).disableSelection();
		  } );
		$( function() {
		    $( "#sortable" ).sortable({
			    disabled: true,
			    start: function(){
					$(this).data("startingScrollTop",$(this).parent().scrollTop());
				},
				drag: function(event,ui){
					var st = parseInt($(this).data("startingScrollTop"));
					ui.position.top -= $(this).parent().scrollTop() - st;
				}
			});

	    });

	    $('.<?php echo $identifier ?>_button#sortablebutton').click(function(){
			if(editingorder){
				$( function() {
				    $( "#sortable" ).sortable({
					    disabled: true,
					});
			    });
				editingorder=false;
			}else{
				editingorder=true;
				$( function() {
				    $( "#sortable" ).sortable({
					    disabled: false,
					});
			    });
			}
		});
<?php } ?>

	class <?php echo $identifier ?>Classes {
		populateview( index=null ){

		}
	}
</script>
