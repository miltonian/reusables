<?php 



?>

<style>
</style>

<div class="maincolumn1 <?php echo $identifier ?>">
	<div class="container">
		<?php for($a=0;$a<sizeof($maincolumnarray);$a++){ ?>
			<?php $productcell2id=$maincolumnarray[$a]['id']; $productcell2image=$maincolumnarray[$a]['featured_imagepath']; $productcell2title=$maincolumnarray[$a]['title']; $isfeatured=false; $productcell2desc = $maincolumnarray[$a]['html_text']; $productcell2price = $maincolumnarray[$a]['price']; include $docroot.'/reusables/views/productcell_2.php'; ?>
		<?php } ?>
	</div>
</div>


<script>

</script>