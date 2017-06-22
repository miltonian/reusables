<?php 



?>

<style>
.maincolumn2 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
}
.maincolumn2 .container {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
}

</style>

<div class="maincolumn2">
	<div class="container">
	<!-- <script>console.log(<?php echo sizeof($maincolumnarray) ?>)</script> -->
		<?php for($a=0;$a<sizeof($maincolumnarray);$a++){ ?>
			<?php $productcell2id=$maincolumnarray[$a]['id']; $productcell2image=$maincolumnarray[$a]['featured_imagepath']; $productcell2title=$maincolumnarray[$a]['title']; $isfeatured=false; $productcell2desc = $maincolumnarray[$a]['html_text']; $productcell2price = $maincolumnarray[$a]['price']; include $docroot.'/reusables/views/productcell_2.php'; ?>
		<?php } ?>
	</div>
</div>


<script>

</script>