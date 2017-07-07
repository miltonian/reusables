<?php 



?>

<style>
	
</style>

<div class="<?php echo $identifier ?> maincolumn_2">
	<div class="container">
		<?php 
			// for($a=0;$a<sizeof($maincolumnarray);$a++){
			// 	$productcell2id=$maincolumnarray[$a]['id']; $productcell2image=$maincolumnarray[$a]['featured_imagepath']; $productcell2title=$maincolumnarray[$a]['title']; $isfeatured=false; $productcell2desc = $maincolumnarray[$a]['html_text']; $productcell2price = $maincolumnarray[$a]['price']; include $docroot.'/reusables/views/productcell_2.php'; 
			// } 
		?>
		<?php
			$i=0;
			foreach ($tabledict['postarray'] as $post) {
				$post['index'] = $i;
				$post['actions'] = [];
				echo Cell::make( "productcell_2", $post, $identifier . "_cell" );
				$i++;
			}
		?>
	</div>
</div>


<script>

</script>