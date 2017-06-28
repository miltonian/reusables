<?php

	if(!isset($sectiondict['imagepickerarray'])){ $sectiondict['imagepickerarray']=array(); }
	$imagepickerarray = $sectiondict['imagepickerarray'];
// exit(json_encode($imagepickerarray));
?>

<style>
.imagepicker1 {
	position: fixed;
	margin: 0;
	padding: 0;
	left: 0;
	top: 0;
	width: 100%; 
	height: 100%;
	background-color: rgba(0,0,0,0.7);
	text-align: center;
	z-index: 99;
}
	.imagepicker1.show {display: inline-block;}
	.imagepicker1.hide {display: none;}
.imagepicker1 .title {
	display: inline-block;
	position: relative;
	text-align: center;
	width: 100%;
	margin: 0;
	padding: 0;
	margin-top: 25px;
	color: #333333;
	font-size: 1.3em;
	font-weight: 400;
}
.imagepicker1 .mainview {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	top: 50%;
	transform: translateY(-50%);
	background-color: white;
	border-radius: 10px;
	width: 500px;
	height: 400px;
}
.imagepicker1 .addimage {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 80px;
	height: 30px;
	margin-top: 10px;
	background-color: blue;
	border: 0;
	border-radius: 5px;
	color: white;
	cursor: pointer;
}
.imagepicker1 .table-container {
	display: inline-block; position: relative; margin: 0; padding: 0; width: 90%; height: 250px; margin-top: 50px; overflow: hidden;
}
.imagepicker1 .table {
	display: inline-block;
	position: absolute;
	margin: 0;
	padding: 0;
	width: 100%;
	max-height: 100%;
	overflow-x: hidden;
	overflow-y: scroll;
	top: 0px;
	left: 0; 
}
.imagepicker1 .cell {
	border-bottom: 1px solid #efefef;
	display: inline-block;
	position: relative;
	width: 100%;
	cursor: pointer;
}
.imagepicker1 .cell .image {
	display: inline-block;
	position: relative;
	margin: 10px;
	padding: 0;
	height: auto;
	width: auto;
	max-width: 100px;
	max-height: 100px;
	float: left;
	pointer-events: none;
}
</style>

<div class="imagepicker1 hide">
	<div class="mainview">
		<button class="closebutton"></button>
		<label class="title">Image Picker</label>
		<button class="addimage">Add Image</button>
		<div class="table-container">
			<div class='table main'>
			<?php for($i=0;$i<sizeof($imagepickerarray);$i++){ ?>
				<div class="cell" id="<?php echo $imagepickerarray[$i]['id'] ?>">
					<img class="image" src="<?php if(substr($imagepickerarray[$i]['imagepath'], 0,1) != '/'){ echo $imagepickerarray[$i]['imagepath']; }else{ echo substr_replace($imagepickerarray[$i]['imagepath'], '/', 0, 1); } ?>" >
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php 
	// include $docroot.'/reusables/views/getimageview_1.php'; 
	echo Modal::make( "getimageview_1", [], $identifier . "-getimageview" );
?>


<script>

var imagepickerarray = <?php echo json_encode($imagepickerarray) ?>;
var attachedobj;
var attachedgallery = null;

$('.imagepicker1 .closebutton').click(function(e){
	e.preventDefault();
	$('.imagepicker1').toggleClass('show hide');
});
$('.imagepicker1 .addimage').click(function(e){
	e.preventDefault();
	$('.getimageview1').toggleClass('show hide');
})

class ImagePicker1 {

	setup(){
		let getimageview1 = new GetImageView1Class()
		getimageview1.attachToFunction( this.addtotable );
		//addimagetopost1.php
	}

	attachToObj(obj){
		attachedobj = obj;
	}

	addtotable(imageid){
		var fd = new FormData();
		fd.append('image_id', imageid);
		jQuery.ajax({
		    url: 'reusables/functions/getimagefromid.php',
		    data: fd,
		    cache: false,
		    contentType: false,
		    processData: false,
		    type: 'POST',
		    success: function(data){
		        // alert(data);
		        var parsed_data = JSON.parse(data);
				// alert(JSON.stringify(parsed_data))
		        var table = $('.imagepicker1 .table')[0];
		        var imagedict = parsed_data;
		        imagepickerarray.push( imagedict );
				var cell = document.createElement('div');
				cell.className = 'cell';
				cell.id = imagedict['id'];
				// alert(cell.id);

				table.appendChild(cell);

				var image = document.createElement('img');
				image.className = 'image';
				// var imagepath = imagepickerarray[0]['imagepath'];
				var imagepath = imagedict['imagepath'];
				if(imagepath.substring(0,1) == "/"){
					imagepath = '' + imagepath.replace('/', '');
				}
				// alert(imagepath);
				$(image).attr('src', imagepath);
				cell.appendChild(image);

				if( $(attachedobj).val() == "" ){
					$(attachedobj).val(cell.id);
				}else{
					$(attachedobj).val( $(attachedobj).val()+","+cell.id );
				}

				if(attachedgallery){
					let backgroundimage = imagepickerarray[0]['imagepath']
					if(backgroundimage.charAt[0]=="/"){
						backgroundimage = '' + backgroundimage.replace('/', '');
					}
					$(attachedgallery).find('.backgroundimage').css('background-image', 'url('+backgroundimage+')');
					$(attachedgallery).find('.image').css('background-image', 'url('+backgroundimage+')');
				}
				$('.getimageview1 .closebutton').click();
		        // return imagedict;
		    }
		});
		// this.getimagefromid(imageid);

	}

	getimagefromid(imageid){
		// alert(imageid)
		
	}

	attachgallery(gallery){
		attachedgallery = gallery
	}
}

let ImagePicker1Class = new ImagePicker1();
ImagePicker1Class.setup();
</script>