<?php
	if(!isset($sidemenuarray)){ $sidemenuarray=array(); }

	//for testing 
	$sidemenuarray = array(1,2);
?>

<style>
.sidemenu1 {
	display: inline-block;
	position: relative;
	margin: 0;
	width: calc(100% - 60px);
	padding: 30px;
	padding-top: 65px
}
.sidemenu1 .button {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 40px;
	color: #333333;
	font-size: 0.9em;
	font-weight: 600;
	text-align: left;
}
.sidemenu1 .button label { text-transform: uppercase; }
</style>

<div class="sidemenu1">
<?php for($i=0;$i<sizeof($sidemenuarray);$i++){ ?>
	<div class="button">
		<label>Test Button</label>
	</div>
<?php } ?>
</div>

<script>
</script>