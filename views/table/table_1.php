<?php

namespace Reusables;

	/*
		$viewdict = [
			"postarray"=>array()
		]
	*/

	// $ReusableClasses = new ReusableClasses();
	// $shortcuts = new Shortcuts();
		// exit( json_encode( sizeof($viewdict[ $identifier . '_posts' ]) ) );

	if( !isset($viewdict['convert_keys'])){ 
		$convertkeys = false; 
	}else { 
		$convertkeys = $viewdict['convert_keys']; 
	}
// exit( json_encode( $viewdict[$identifier.'_posts'][1] ) );
	$viewdict[$identifier . '_posts' ] = Data::retrieveDataWithID( $identifier . '_posts' );
	if( isset($viewdict[ $identifier . '_posts' ]['value']) ){
		$tablearray = $viewdict[ $identifier . '_posts' ]['value'];
	}else{
		$tablearray = $viewdict[ $identifier . '_posts' ];
	}

	$featured_cellname = "cell_8";
	$normal_cellname = "cell_2";
	if( isset( $viewdict['featured_cellname'] ) ){
		$featured_cellname = $viewdict['featured_cellname'];
	}
	if( isset( $viewdict['cellname'] ) ){
		$normal_cellname = $viewdict['cellname'];
	}

	$temp_tablearray = $tablearray; 
	unset( $temp_tablearray['data_id'] );

	// exit( json_encode( sizeof($viewdict[ $identifier . '_posts' ]) ) );

?>

<style>
</style>

<div class="viewtype_table <?php echo $identifier ?>">
	<div class="table">
		<?php 
			for ( $i=0; $i < sizeof($temp_tablearray ); $i++) { 
				$postdict = $tablearray[$i];
				$postkeys = array_keys( $postdict );
				$post = [];
				foreach ($postkeys as $pk) {
					$post[$pk] = [ "data_id"=> $identifier . '_posts' , "key"=>$pk, "index"=>$i ];
				}
				foreach ( $postkeys as $k ) {
					// if( isset( $convertkeys[$k] ) ){ $post[$convertkeys[$k]] = $postdict[$k]; }
					if( isset( $convertkeys[$k] ) ){ 
						if( is_array( $convertkeys[$k] ) ){
							foreach ($convertkeys[$k] as $ck) {
								$post[$ck] = $post[$k];
							}
						}else{
							$post[$convertkeys[$k]] = $post[$k]; 
						}
						// $post[$convertkeys[$k] ]['key'] = $convertkeys[$k];
					}
				}
				// exit( json_encode( $post ) );
				$post['network_slug'] = ["data_id"=>"network_info", "key"=>"slug"];
				$post['index'] = $i;
				$post['pre_slug'] = Data::getValue( $viewdict, 'pre_slug' );
				if( isset( $viewdict['slug'] ) ) { $post['slug'] = Data::getValue( $viewdict, 'slug' ); }
				
				if( isset( $viewdict['cellactions'] ) ){ $post['actions'] = $viewdict['cellactions']; }else{ $post['actions'] = array(); }
				Data::addData( $post, $identifier . "_cell_" . $i );
				if($i==0 || sizeof($tablearray) < 4 ){
					echo Cell::make( $featured_cellname, $identifier . "_cell_" . $i );
				}else{
					echo Cell::make( $normal_cellname, $identifier . "_cell_" . $i );
				}
			}

			/*$i=0;
			foreach ($viewdict['postarray'] as $post) { 
				if($i==0 || sizeof($viewdict['postarray']) < 4 ){
					echo Cell::make( "cell_8", $post, $identifier . "_cell" );
				}else{
					echo Cell::make( "cell_2", $post, $identifier . "_cell" );
				}
				$i++;
			}*/ ?>

	</div>
</div>

<script>
</script>