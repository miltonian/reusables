<?php

namespace Reusables;

	if(!isset($isediting)){ $isediting=false; }
	if(!isset($authorname)){ $authorname=""; }
	if(!isset($postcategory)){ $postcategory=""; }
	if(!isset($postcategories)){ $postcategories=[]; }
	if(!isset($formatteddate)){ $formatteddate=""; }

	// exit(json_encode());
?>

<style>
button:focus {outline:0;}
.postcontent {
	width: 100%;
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	text-align: left;
	float: left;
	margin-left: 30px;
	background-color: white;
	width: calc(100% - 40px);
	padding: 20px;
	margin: 0;
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
	font-family: asdf;
}

.authordiv {
	
	position: relative; 
	display: inline-block; 
	/*width: 100%; */
	float: left;
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
	width: 100%;
	
}
.featuredpostimglabel.editing p{
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	color: #333333;
	text-align: center;
	top: 50%;
	transform: translateY(-50%);
	height: 20px;
}
.postcontent .htmltextdiv img {display: none;}
.postcontent img {max-width: 90%; height: auto;}
@media (min-width: 0px) {
	.postcontent {/*width: calc(100% - 60px); margin-right: 30px; padding: 0;*/width: calc(100% - 40px); padding: 20px; margin: 0;} 
}
@media (min-width: 768px) {
	.postcontent {width: calc(100% - 60px - 40px); margin-left: 30px;margin-right: 30px; padding: 20px;}
}
</style>


<?php if(!$isediting){ ?>
<div class='postcontent'>
				
	<div style=''>
		<p id="posttitlep" ><?php echo $posttitle ?></p>
	</div>

	<div class='authordiv'>
		<!--<img src=$authorimg style='position: relative; display: inline-block; height: 56px;  width: auto; border: 0; border-radius: 50%; top: 50%; margin-top: -28px; float: left;'>-->
		
		<p style='position: relative; display: inline-block; margin: 0; padding: 0;  margin-left: 10px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 0.8em; font-weight: 300; color: #333333;'><span style='color: #b4b4be;'>By: </span><?php echo $authorname ?></p>
		
		<p style='position: relative; display: inline-block; margin: 0; padding: 0;  margin-left: 10px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 0.8em; font-weight: 300; color: #333333; text-transform: capitalize;'><span style='color: #b4b4be;'>
			<?php 
				if(sizeof($postcategories)==1){
					echo "Tag: </span><a href='".$baseurlminimal."category/c/".$postcategories[0]['id']."/".preg_replace('/\PL/u', '', $postcategories[0]['name'])."' style=''>".$postcategories[0]['name']."</a></p>";
				}else{
					echo " Tags: </span>";
						$maxcount = 3;
						if(sizeof($postcategories) < $maxcount){
							$maxcount = sizeof($postcategories);
						}
						for($i=0;$i<$maxcount;$i++){
							echo "<a href='".$baseurlminimal."category/c/".$postcategories[$i]['id']."/".preg_replace('/\PL/u', '', $postcategories[0]['name'])."' style=''>".$postcategories[$i]['name']."</a>";
							if($i<$maxcount-1){
								echo ", ";
							}else{
								echo "</p>";
							}
						}
				}
				
			?>
		
		<p style='position: relative; display: inline-block; margin: 0; padding: 0;  margin-left: 10px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 0.8em; font-weight: 300; color: #b4b4be;'><?php /*echo $formatteddate*/ ?></p>
		
	</div>

	<?php include $docroot.'/reusables/views/sharingbtns_2.php'; ?>
	<!-- <div style="width: 100%; display: inline-block; margin-bottom: 50px; margin: 0; padding: 0; height: 5px; position: relative;"></div> -->
	<?php if($featuredpostimg != ""){ ?>
		<div class="featuredpostimgcontainer" style="display: none;">
			<img src="<?php echo $featuredpostimg ?>" id=featuredpostimg  width='100%' height='auto' style='position: relative; display: inline-block; margin: 0;  padding: 0; margin-top: 20px;' />
		</div>
	<?php } ?>
	<?php if(sizeof($galleryarray)>0){ ?>
		<div style="display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 400px; text-align: center;">
			<div style="display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; max-width: 700px; height: 100%; float: left;">
				<?php include $docroot.'/reusables/views/gallery_1.php'; ?>
			</div>
		</div>
	<?php } ?>

	<div class='htmltextdiv' style='font-weight: 300;' >
		<?php echo $htmltext ?>
	</div>
</div>

<?php }else{ ?>

<div class='postcontent editing'>
	
	<form id="postform" method="post" action="<?php echo $formaction ?>" enctype='multipart/form-data'>

<?php include $docroot.'/reusables/views/schedulepostview1.php'; ?>

	<div>
		<input type="text" name="title" id="posttitlep" placeholder="Enter the title" value="<?php echo $posttitle ?>" >
	</div>

	<input type="hidden" name="postid" value="<?php echo $postid ?>">
	<input type="hidden" name="authorid" value='<?php echo $authorid ?>' id='authorid'>
	<input type="hidden" name="date_made" value='<?php echo $epochmade ?>' id='date_made'>
					
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

			<p style="position: relative; display: inline-block; margin: 0; padding: 0; margin-left: 10px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #b4b4be;">Tag: </p>
			<!-- <input type="text" name="category" id="categorytf" placeholder="category" class="categories editing" style="position: relative;  display: inline-block; margin: 0; padding: 0; margin-left: 0px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #333333; width: 150px;" value="<?php echo $postcategory ?>"> -->
			<?php 

				echo "<div style='display: inline-block; position: relative; margin: 0; padding: 0; display: inline-block; position: relative; margin: 0; padding: 0; margin-left: 0px; height: 1.2em; top: 40%; margin-top: -0.6em; font-size: 1.2em; font-weight: 300; color: #333333; width: 250px; /* padding-left: 50px */' >";
				echo "<a href='#' class='author-lookup editing' style='font-size: 0.4em; position: absolute; display: inline-block; width: 50px; text-align: center; z-index: 1; top: 50%; transform: translateY(-50%)'>Look Up</a>";
				if(sizeof($postcategories)==0){
					echo "<input type='text' name='categories' id='categorytf' class='categories editing' style='position: relative; display: inline-block; margin: 0; padding: 0; padding-left: 50px; width: 100%; height: 100%;' value='' >";
				}else if(sizeof($postcategories)==1){
					echo "<input type='text' name='categories' id='categorytf' class='categories editing' style='position: relative;  display: inline-block; margin: 0; padding: 0; padding-left: 50px; width: 100%; height: 100%;' value='".$postcategories[0]['name']."'>";
				}else{
					echo "<input type='text' name='categories' id='categorytf' class='categories editing' style='position: relative;  display: inline-block; margin: 0; padding: 0; padding-left: 50px; width: 100%; height: 100%;' value='";
						// $maxcount = 3;
						// if(sizeof($postcategories) < $maxcount){
						// 	$maxcount = sizeof($postcategories);
						// }
						for($i=0;$i<sizeof($postcategories);$i++){
							echo $postcategories[$i]['name'];
							if($i<sizeof($postcategories)-1){
								echo ",";
							}else{
								echo "'>";
							}
						}
				}
				echo "</div>";
			?>

		<input type="hidden" id="galleryimageids" name="galleryimageids" value="<?php if(sizeof($galleryarray)>0){ for($i=0;$i<sizeof($galleryarray);$i++){ if($i>0){echo ','.$galleryarray[$i]['id']; }else{ echo $galleryarray[$i]['id']; } } } ?>" >

		<label id='schedulepostbutton' class="editing schedule" style='position: relative; display: inline-block; margin: 0; padding: 0; margin-left: 10px; height: 25px; width: 100px; font-size: 0.7em; font-weight: 500; top: 50%; transform: translateY(-50%); color: white; border: 0; border-radius: 5px; background-color: blue; color: white; cursor: pointer;'><p style='position: relative; display: inline-block; margin: 0; padding: 0; top: 50%; height: 1em; transform: translateY(-50%); width: 100%; text-align: center;'>Schedule Post</p></label>
		
	</div>

	<!-- <div class="featuredpostimgcontainer" >
		<img src="<?php echo $featuredpostimg ?>" id="featuredpostimg"  width="100%" height="auto" style="position: relative; display: inline-block; margin: 0;  padding: 0; margin-top: 20px;" />
	</div> -->

	<!-- <label for="featuredpostimg" id="featuredpostimgbutton" class="featuredpostimglabel editing" style="cursor: pointer; position: relative; display: inline-block; margin: 0; padding: 0; margin: 40px 0px; width: 100%; height: auto; background-position: center; background-size: cover; height: 400px;<?php if($featuredpostimg!=""){ ?>background-image: url('<?php echo $featuredpostimg ?>');<?php }else{?>background-color: rgba(240,240,245,1.0);<?php } ?>"><p>Add Image</p></label> -->
	<div style="display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 400px; text-align: center;">
		<div style="display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; max-width: 700px; height: 100%; float: left;">

			<?php include $docroot.'/reusables/views/gallery_1.php'; ?>

		</div>
	</div>
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
		$('.featuredpostimglabel.editing p').css('display', 'none');
		ReusableGlobalFunctionsClass.readthisURL(this, $('.featuredpostimglabel.editing'), null, null);
		// alert($('#featuredpostimg').val());
	});
	$('.authors.editing').click( function() {
		closethings();
		$('.authorsbackground').css('display', 'inline-block');
		$('.authorpopview').css('display', 'inline-block');
		
	});
	$('.author-lookup.editing').click( function() {
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
			
			// closeallaction();
			closethings();
	});

	<?php if($isediting){ ?>
		attachcategoriestotf(true);
	<?php } ?>

	// let gallery1 = new Gallery1Class();
	var obj = document.getElementById('galleryimageids');
	// alert($(obj).val())
	gallery1.attachobjtopicker(obj);
</script>