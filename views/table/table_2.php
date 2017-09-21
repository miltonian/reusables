<?php

namespace Reusables;

	if( !isset($tableoptions['sortable'])){ 
		$sortable = false; 
	}else { 
		$sortable = $tableoptions['sortable']; 
	}
// exit( json_encode( $sortable ) );


	if( isset($tabledict['value']) ){
		$tablearray = $tabledict['value'];
	}else{
		$tablearray = $tabledict;
	}

	$temp_tablearray = $tablearray; 
	// exit( json_encode( $temp_tablearray ) );
	unset( $temp_tablearray['data_id'] );

?>

<style>
<?php if( $sortable ){ ?>
	#sortable {width: 100%; display: inline-block; padding: 0;}
	li { list-style-type: none; }
		li.ui-state-default.ui-sortable-handle { width: 100%; left: 0; }
		li.ui-state-default.ui-sortable-helper { left: 30px; }
		.ui-state-default { display: inline-block; }
<?php } ?>
</style>

<div class="<?php echo $identifier ?> table_2">
	<div class="table" style="background-color: transparent;">
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

				if( isset($tabledict['value']) ){
					$post = Data::formatCellWithDefaultData( $identifier , $i );
				}else{
					$post = Data::getValue( $tablearray, $i );
				}


				$post = Data::convertKeysInTable( $identifier, $post );

				$post['index'] = $i;
				$postoptions['pre_slug'] = Data::getValue( $tableoptions, 'pre_slug' );

				if( isset( $tableoptions['celldict'] ) ) {
					$post = array_merge( $post, $tableoptions['celldict'] );
				}

				if( isset( $tableoptions['slug'] ) ) { $postoptions['slug'] = Data::getValue( $tableoptions, 'slug' ); }
				if( isset( $tableoptions['actions'] ) ){ $postoptions['actions'] = $tableoptions['actions']; }else{ $postoptions['actions'] = array(); }

				Data::addData( $post, $identifier . "_cell_" . $i );
				Data::addOptions( $postoptions, $identifier . "_cell_" . $i );
				echo Cell::make( $tableoptions['cellname'], $identifier . "_cell_" . $i );
				if($sortable){ ?>
					</li>
				<?php } 
			}
		?>
		<?php if($sortable){ ?>
			</ul>
		<?php } ?>
	</div>
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
</script>