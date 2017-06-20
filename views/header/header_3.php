<?php

?>

<style>
.header3 { position: relative; display: inline-block; padding: 20px 40px; margin: 0; width: calc( 100% - 80px ); }
	.header3 #title { display: inline-block; position: relative; margin: 0px 0px; padding: 0; width: 100%; }
	.header3 #divider { display: inline-block; position: absolute; padding: 0; margin: 0px; bottom: 0; width: calc( 100% - 80px ); height: 2px; background-color: #333333; left: 40px; }
@media (min-width: 0px) {
	.header3 #title { text-align: center; }
}
@media (min-width: 768px) {
	.header3 #title { text-align: left; }
}
</style>

<div class="header3">
	<h1 id="title"><?php echo $headerdict['title'] ?></h1>
	<div id="divider"></div>
</div>

<script>
</script>