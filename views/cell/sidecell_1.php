<?php 


?>

<style>
.sidecell1{
	position: relative;
	display: inline-block;
	margin: 10px 10px 10px 0px;
	padding: 0;
	width: calc(100% - 10px);
	height: 100px;
	background-color: white;
}
.sidecell1 .leftdiv{
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	float: left;
	width: 35%;
	height: 100%;
}
.sidecell1 .rightdiv{
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	float: left;
	width: 65%;
	height: 100%;
}
.sidecell1 .leftdiv .image {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	height: 100%;
	width: 100%;
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
}
.sidecell1 .rightdiv .title {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0px 10px;
	width: calc(100% - 20px);
	font-size: 0.9em;
	font-weight: 500;
	color: #333333;
	text-align: left;
}
.sidecell1 a, .sidecell1 a label {
	text-decoration: none;
	color: #333333;
	cursor: pointer;
}
.sidecell1 a label:hover {text-decoration: underline;}
</style>


<div class="sidecell1">
	<div class="leftdiv">
		<a href="<?php echo $baseurlminimal.'post/'.$sidecellid ?>/<?php echo preg_replace('/\PL/u', '', $sidecelltitle) ?>"><div class="image" style="background-image: url('<?php echo $sidecellimage ?>');"></div></a>
	</div>
	<div class="rightdiv">
		<a href="<?php echo $baseurlminimal.'post/'.$sidecellid ?>/<?php echo preg_replace('/\PL/u', '', $sidecelltitle) ?>"><label class="title"><?php echo $sidecelltitle ?></label></a>
	</div>
</div>


<script>
	
</script>