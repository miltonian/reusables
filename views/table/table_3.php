<?php

namespace Reusables;

	/*
		$viewdict = [
			"postarray"=>array()
		]
	*/

	if( !isset($viewdict['sortable'])){ 
		$sortable = false; 
	}else { 
		$sortable = $viewdict['sortable']; 
	}

	if( !isset($viewdict['ads'])){ 
		$adarray = false; 
	}else { 
		$adarray = $viewdict['ads']; 
	}

	// exit( json_encode( $convertkeys ) );

$required = array(
	 $identifier . '_posts' =>array("link", "name|imagepath|emoji"), 
	"cellactions"=>"",  
	"cellname"=>""
);

$viewdict[$identifier . '_posts' ] = Data::retrieveDataWithID( $identifier . '_posts' );
// exit( json_encode( $viewdict[$identifier . '_posts' ] ) );
if( isset($viewdict[ $identifier . '_posts' ]['value']) ){
	$tablearray = $viewdict[ $identifier . '_posts' ]['value'];
}else{
	$tablearray = $viewdict[ $identifier . '_posts' ];
}

$temp_tablearray = $tablearray; 
unset( $temp_tablearray['data_id'] );

// ReusableClasses::checkRequired( $identifier, $viewdict, $required );
// exit( json_encode( $viewdict[$identifier . '_posts'][0] ) );
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

<div class="viewtype_table <?php echo $identifier ?> table_3">
	<div class="table">
<?php if($sortable){ ?>
	<ul id="sortable">
<?php } ?>
		<?php 
			for ($i=0; $i < sizeof( $temp_tablearray ); $i++) { 
				if($sortable){
					?>

					<li id="<?php echo $i ?>" class="ui-state-default">
					<?php 
				}
				
				if( $adarray && $i==2 ){
					$adindex = 0;
					// exit( json_encode( $identifier ) );
					$adarray = Data::retrieveDataWithID( $identifier . '_ads' );
					if( isset($adarray) ){
								$post = Data::formatCellWithDefaultData( $identifier . '_ads' , $adindex );
							}else{
								$post = Data::getValue( $adarray, $adindex );
							}

							$post = Data::convertKeysInTable( $viewdict, $post );

								// exit( json_encode( $post ) );
							// exit( json_encode( Data::getValue( $post, 'title' ) ) );
							$post['pre_slug'] = Data::getValue( $adarray, 'pre_slug' );
							if( isset( $viewdict['celldict'] ) ) {
								$post = array_merge( $post, $adarray['celldict'] );
							}
							if( isset( $adarray['slug'] ) ) { $post['slug'] = Data::getValue( $adarray, 'slug' ); }
							if(isset($adarray['cellactions'])){ $post['actions'] = $adarray['cellactions']; }else{ $post['actions'] = array(); }

							Data::addData( $post, $identifier . "_ad_" . $adindex );
							echo Ad::make( "basic", $identifier . "_ad_" . $adindex );
							if($sortable){ ?>
								</li>
							<?php } 


				}
				if( isset($viewdict[ $identifier . '_posts' ]['value']) ){
					$post = Data::formatCellWithDefaultData( $identifier . '_posts' , $i );
				}else{
					$post = Data::getValue( $tablearray, $i );
				}
				$postkeys = array_keys($post);
				foreach ( $postkeys as $k ) {
					if( isset( $convertkeys[$k] ) ){ 
						if( is_array( $convertkeys[$k] ) ){
							foreach ($convertkeys[$k] as $ck) {
								echo "<script>console.log('" . $ck . "')</script>";
								$post[$ck] = $post[$k];
							}
						}else{
							echo "<script>console.log('" . $convertkeys[$k] . "')</script>";
							$post[$convertkeys[$k]] = $post[$k]; 
						}
						// $post[$convertkeys[$k] ]['key'] = $convertkeys[$k];
					}
				}
					// exit( json_encode( $post ) );
				// exit( json_encode( Data::getValue( $post, 'title' ) ) );
				$post['pre_slug'] = Data::getValue( $viewdict, 'pre_slug' );
				if( isset( $viewdict['celldict'] ) ) {
					$post = array_merge( $post, $viewdict['celldict'] );
				}
				if( isset( $viewdict['slug'] ) ) { $post['slug'] = Data::getValue( $viewdict, 'slug' ); }
				if(isset($viewdict['cellactions'])){ $post['actions'] = $viewdict['cellactions']; }else{ $post['actions'] = array(); }

				Data::addData( $post, $identifier . "_cell_" . $i );
				echo Cell::make( $viewdict['cellname'], $identifier . "_cell_" . $i );
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

// $('.admin-projects').each(function(e) {
// 	alert();
// 			var apid = $(this).attr('id');
// 			Sortable.create( document.getElementById( apid ), {
// 				onUpdate: function (evt/**Event*/){
// 					var sort = '';
// 					$('#'+apid + ' .admin-project').each(function(e) {
// 						sort+= $(this).attr('id').replace('pid-','')+',';
// 					});
// 					console.log(sort);
// 					$('#sort_order').val(sort);
// 				}
// 			} );
// 		});
<?php if( $sortable ){ ?>
		$( function() {
		    $( "#sortable" ).sortable({
			    axis: 'y',
				containment: "body",
			    disabled: true,
			    helper: 'clone',
			  update: function( event, ui ) {
				  // var sortedIDs = $( "#sortable" ).sortable( "toArray" );
				  
				  // sortedarray = [];
				  // $('#project-sort-order').val("");
				  // for(var i=0;i<sortedIDs.length;i++){
					 //  if(sortedIDs[i]!=""){
						//   var index = parseInt(sortedIDs[i]);
						//   sortedarray.push(i, [projectsarray[index]['info']['id']]);
						//   $('#project-sort-order').val( $('#project-sort-order').val() + projectsarray[index]['info']['id'] + ',' );
					 //  }
				  // }
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
			    disabled: false,
			    start: function(){
					$(this).data("startingScrollTop",$(this).parent().scrollTop());
				},
				drag: function(event,ui){
					var st = parseInt($(this).data("startingScrollTop"));
					ui.position.top -= $(this).parent().scrollTop() - st;
				}
			});

	    });
<?php } ?>
</script>