<?php
	if(!isset($isediting)){ $isediting=false; }
	if(!isset($authorname)){ $authorname=""; }
	if(!isset($postcategory)){ $postcategory=""; }
	if(!isset($formatteddate)){ $formatteddate=""; }
?>

<style>
.postcontent {
	width: 100%;
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	text-align: left;
	float: left;
	margin-left: 30px;
}

#posttitlep {
	
	position: relative; 
	display: inline-block; 
	text-align: left; 
	color: #333333; 
	font-size: 3em; 
	font-weight: 500; 
	margin: 0; 
	padding: 0; 
	margin-top: 30px; 
	margin-bottom: 30px;
	
}

.authordiv {
	
	position: relative; 
	display: inline-block; 
	width: 100%; 
	height: 60px; 
	margin: 0; 
	padding: 0;
	
}

.htmltextdiv {
	
	display: inline-block; 
	position: relative; 
	margin: 0;
	padding: 0; 
	margin-top: 30px;
	
}

@media (min-width: 0px) {
	.postcontent {width: calc(100% - 60px); margin-right: 30px;}
}
@media (min-width: 768px) {
	.postcontent {width: calc(100% - 60px); margin-right: 30px;}
}
</style>


<?php if(!$isediting){ ?>
<div class='postcontent'>
				
	<div style=''>
		<p id="posttitlep" ><?php echo $posttitle ?></p>
	</div>

	<div class='authordiv' >
		<!--<img src=$authorimg style='position: relative; display: inline-block; height: 56px;  width: auto; border: 0; border-radius: 50%; top: 50%; margin-top: -28px; float: left;'>-->
		
		<p style='position: relative; display: inline-block; margin: 0; padding: 0;  margin-left: 10px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #333333;'><span style='color: #b4b4be;'>By: </span><?php echo $authorname ?></p>
		
		<p style='position: relative; display: inline-block; margin: 0; padding: 0;  margin-left: 50px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #333333; text-transform: capitalize;'><span style='color: #b4b4be;'>Tag: </span><a href='/articles?c=<?php echo $postcategory ?>'><?php echo $postcategory ?></a></p>
		
		<p style='position: relative; display: inline-block; margin: 0; padding: 0;  margin-left: 50px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #b4b4be;'><?php echo $formatteddate ?></p>
		
	</div>

	<?php include $docroot.'/reusables/views/sharingbtns_1.php'; ?>

	<div class=featuredpostimgcontainer >
		<img src="<?php echo $featuredpostimg ?>" id=featuredpostimg  width='100%' height='auto' style='position: relative;   display: inline-block; margin: 0;  padding: 0; margin-top: 20px;' />
	</div>

	<div class='htmltextdiv' style='font-weight: 300;' >
		<?php echo $htmltext ?>
	</div>
</div>

<?php }else{ ?>

<?php include $docroot.'/reusables/views/schedulepostview1.php'; ?>
<div class='postcontent editing'>
	
	<form id="" method="post" action="<?php echo $formaction ?>" enctype='multipart/form-data'>

	<div>
		<input type="text" id="posttitlep" placeholder="Enter the title" value="<?php echo $posttitle ?>" >
	</div>

	<input type=hidden name=postid value=$postid>
	<input type=hidden name='authorid' value='<?php echo $authorid ?>' id='authorid'>
					
	<div class='authordiv' style='position: relative; display: inline-block; width: 100%; height: 60px; margin: 0; padding: 0; '>
		<?php if($authorname!=""){ ?>
			<img src="<?php echo $authorimg ?>" class="authorimg-label authors editing" style="position: relative; display: inline-block; height: 56px;  width: auto; border: 0; border-radius: 50%; top: 50%; margin-top: -28px; float: left;" >
			<p class="authorname" style="position: relative; display: inline-block; margin: 0; padding: 0; margin-left: 10px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #333333;"><span style="color: #b4b4be;">By: </span><?php echo $authorname ?></p>
		<?php }else{ ?>

			<label id='authorbutton' class="authors editing" style='position: relative; display: inline-block; height: 56px; width: 200px;  border: 0; border-radius: 8px; top: 50%; margin-top: -28px; float: left; background-color: blue; color: white; font-size: 1.3em; font-weight: 500; padding: 0; cursor: pointer;'><p style='position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; text-align: center; height: 1.0em;  top: 50%; margin-top: -0.6em;'>Select Author</p>
			</label>
			
			<img class='authorimg-label authors editing' style='position: relative; display: none; height: 56px; width: auto; border: 0;  border-radius: 50%; top: 50%; margin-top: -28px; float: left;'>
			
			<p class='authorname authors editing' style='position: relative; display: none; margin: 0; padding: 0; margin-left: 10px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #333333;'><span style='color: #b4b4be;'>By: </span><?php echo $authorname ?></p>

		<?php } ?>
		
			<p style="position: relative; display: inline-block; margin: 0; padding: 0; margin-left: 50px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #b4b4be;">Tag: </p>
			<input type="text" name="category" id="categorytf" placeholder="category" class="categories editing" style="position: relative;  display: inline-block; margin: 0; padding: 0; margin-left: 0px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #333333; width: 150px;" value="<?php echo $postcategory ?>">
		
		<label id='schedulepostbutton' class="editing schedule" style='position: relative; display: inline-block; margin: 0; padding: 0; margin-left: 50px; height: 30px; width: 150px; font-size: 0.9em; font-weight: 500; top: 5px; color: white; border: 0; border-radius: 5px; background-color: blue; color: white; cursor: pointer;'><p style='position: relative; display: inline-block; margin: 0; padding: 0; top: 50%; height: 1em; margin-top: -0.5em; width: 100%; text-align: center;'>Schedule Post</p></label>
		
	</div>

	<!-- <div class="featuredpostimgcontainer" >
		<img src="<?php echo $featuredpostimg ?>" id="featuredpostimg"  width="100%" height="auto" style="position: relative; display: inline-block; margin: 0;  padding: 0; margin-top: 20px;" />
	</div> -->

	<label for="featuredpostimg" id="featuredpostimgbutton" class="featuredpostimglabel editing" style="position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; height: auto; background-position: center; background-size: cover; height: 400px;<?php if($featuredpostimg!=""){ ?>background-image: url('<?php echo $featuredpostimg ?>');<?php }else{?>background-color: rgba(240,240,245,1.0);<?php } ?>"></label>
	<input type="file" name="featuredpostimg" id="featuredpostimg" value="" style="opacity: 0;  position: absolute; z-index: -1;">
<input type="hidden" id='old_imagepath' name='old_imagepath' value="<?php echo $featuredpostimg ?>">

	<textarea name='editor1' id='editor1' rows='10' cols='80'>
		<?php echo $htmltext ?>
	</textarea>
	
	<script>
		// Replace the <textarea id='editor1'> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace( 'editor1' );
		CKEDITOR.config.height = '500' ;
	</script>

	<div style='position: relative; display: inline-block; margin: 0; padding: 0;  margin-left: 0px;  margin-top: 10px; float: left; width: 100%;'>
		<input type=submit style='position: relative; display: inline-block;  width: 200px; height: 60px; -webkit-appearance: none; border: 0; background-color: green; border-radius: 8px; color: white; font-size: 1.2em; font-weight: 500; float: left; cursor: pointer;' name=submitbutton>
		<input type=submit id=previewbutton style='position: relative; display: inline-block;  width: 170px;  height: 40px; -webkit-appearance: none; border: 0; margin: 0; background-color: gray; border-radius: 8px; color: #ffffff; font-size: 0.9em;  font-weight: 500; float: left; margin-left: 20px; cursor: pointer; margin-top: 10px;' value='Preview' name='previewbutton'>
		

			
	</div>
</div>

<?php } ?>


<script>
	$('#featuredpostimg').change(function(){
		$('#featuredpostp').css('display', 'none');
		ReusableGlobalFunctionsClass.readthisURL(this, $('.featuredpostimglabel.editing'), null, null);
		// alert($('#featuredpostimg').val());
	});
	$('.authors.editing').click( function() {
		closethings();
		$('.authorsbackground').css('display', 'inline-block');
		$('.authorpopview').css('display', 'inline-block');
		
	});
	$('.categories.editing').click( function() {
		closethings();
		$('.categoriesbackground').css('display', 'inline-block');
		$('.categoriespopview').css('display', 'inline-block');
	});
	$('.schedule.editing').click( function() {
			$('.schedulebackground').css('display', 'inline-block');
			$('.pickdate').css('display', 'inline-block');
	});
	$('.authorcellbutton').click( function() {
		var authorsarray = <?php echo json_encode($authorsarray) ?>;
		var inputdict = authorsarray[this.id];
			//alert();
			var name = inputdict['name'];
			var imagepath = inputdict['imagepath'];
			var authorid = inputdict['id'];
							
			$('.authorname').text(inputdict['name']);
			
			$('#authorbutton').css('display', 'none');
			$('.authorimg-label').css('display', 'inline-block');
			$('.authorname').css('display', 'inline-block');
			
			$('.authorimg-label').attr('src', imagepath);
			//var asdf = [$('#authorimg'), imagepath, authorid, $('#authorid-label')]
			//alert(asdf);
			$('#authorid').val(authorid);
			//alert(authorid)
			//alert($('#authorid').val());
			
			closeallaction();
	});
</script>