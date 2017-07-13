<?php 

namespace Reusables;

if(!isset($allimages)){ $allimages = array(); }

?>

<style>
.getimageview1 {
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
	.getimageview1.show {display: inline-block;}
	.getimageview1.hide {display: none;}
.getimageview1 .title {
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
.getimageview1 .image {
	display: inline-block;
	position: relative;
	max-width: calc(33% - 20px);
	max-height: 70px;
	width: auto;
	height: auto;
	margin: 10px;
	padding: 0;
	cursor: pointer;
}
.getimageview1 .mainview {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	top: 50%;
	transform: translateY(-50%);
	background-color: white;
	border-radius: 10px;
	width: 600px;
	height: 350px;
}
.getimageview1 .table-container {
	display: inline-block; position: relative; margin: 0; padding: 0; width: 90%; height: 250px; margin-top: 10px; overflow: hidden;
}
.getimageview1 .table {
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
.getimageview1 #uploadimage {
	display: inline-block;
	position: absolute;
	margin: 0;
	padding: 0;
	left: 50%;
	bottom: 10px;
	transform: translateX(-50%);
}
</style>


<div class="getimageview1 hide">
	<div class="mainview">
		<button class="closebutton"></button>
		<label class="title">Image Picker</label>
		<div class="table-container">
			<div class='table main'>
			<?php for($i=0;$i<sizeof($allimages);$i++){ ?>
				<img class="image" id="<?php echo $allimages[$i]['id'] ?>" src="<?php echo $allimages[$i]['imagepath'] ?>" >
			<?php } ?>
			</div>
		</div>
		<input type="file" id="uploadimage" >
	</div>
</div>


<script>

var attachedfunction;

class GetImageView1Class {
	attachToFunction(func){
		attachedfunction = func;
	}

	doSomeAJAX(type,imageid,imagefile){
	
		//var newinputarray = inputarray;
		//alert(productobjectsid);
		var fd = new FormData();
		fd.append('type', type);
		fd.append('image_id', imageid);
		fd.append('image', imagefile);
		jQuery.ajax({
		    url: 'reusables/functions/addimagetopost1.php',
		    data: fd,
		    cache: false,
		    contentType: false,
		    processData: false,
		    type: 'POST',
		    success: function(data){
		        // alert(data);
		        var imageid = data;
		        attachedfunction(imageid);
		    }
		});
		//    $.post( '/reusables/functions/addimagetopost1.php', {'data': fd}, function(data){
		    
		//   }).fail(function(xhr, ajaxOptions, thrownError) { 
		//       alert(thrownError); 
		//       return null;
		//   }).done(function( data ) {
		//   	//alert(data);
		// var your_data = JSON.parse(data);
		//       alert(JSON.stringify(your_data));
		//       if( your_data.length == 0 ){
		//       	return null;
		//       }


		//       return null;
		// 	});
    
	}
}

let getimageview1 = new GetImageView1Class();

$('.getimageview1 .closebutton').click(function(e){
	e.preventDefault();
	$('.getimageview1').toggleClass('show hide');
});
$('.getimageview1 #uploadimage').change(function(){
	//do ajax for type image
	getimageview1.doSomeAJAX("image","",$(this)[0].files[0]);
});
$('.getimageview1 .image').click(function(){
	//do ajax for type id
	// alert(this.id);
	attachedfunction(this.id);
});

</script>