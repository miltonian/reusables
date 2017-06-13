<?php 


?>


<style>

#podcastdiv {
	width: 40%;
}

#podcastframe {
	width: 100%; 
	height: 138px;
}

</style>


<div class="toppart" style="position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; 
		<?php if($device == 'mobile'){ ?>
			margin-top: 200px;
		<?php }else{ ?>
			margin-top: 60px;
		<?php } ?>
		padding: 10px 0 10px 0; background-color: #333333; text-align: center;">
			<div id="podcastdiv" style="position: relative; display: inline-block;
			<?php if($device=='mobile') 
			{ ?>
				width: 100%;
			<?php } 
			else{ ?>
				width: 40%;
			<?php } ?>
			margin: 0; padding: 0; margin-top: 5px; margin-bottom: 5px;">
				<div id='postimg'  style="position: relative; display: none; width: 100%; padding-bottom: 56%;  background-size: cover;  background-position: center; background-image: url($postimg);">
				</div>
				<iframe id='podcastframe' style='display: none;' width='100%' src=$postsrc scrolling="no" frameborder="0"></iframe>
				<iframe id='youtubeframe' width='100%' height='300' style='display: none;' src=''></iframe>
			</div>
		</div>
		
		<?php $adsetimg = $topad; $adsetlink = $adsetdict['topad']['link_path']; include $docroot.'/views/adset_1.php'; ?>
</div>
	


<script>
class MediaViewClass {
		
		populatecontent(postimg,postsrc,topad,type){
			if( type=='youtube' ){
				$('#youtubeframe').css({'display': 'inline-block'});
				$('#postimg').css({'display': 'none'});
				$('#podcastframe').css({'display': 'none'});
				
				var youtubehref = postimg;
				var n = youtubehref.lastIndexOf('?v=');
				var startpoint = youtubehref.indexOf('?v=') + 3;
				var endpoint = youtubehref.indexOf('&', startpoint);
				var result;
				
				if(endpoint == '-1'){
					startpoint=youtubehref.indexOf('.be/')+4;
					endpoint=youtubehref.indexOf('?list=',startpoint);
				}
				
				if(endpoint != '-1'){
					result = youtubehref.substring(startpoint, endpoint);
				}else{
					result = youtubehref.substring(n + 3);
				}
				youtubehref = "https://www.youtube.com/embed/"+result+"?controls=0";
				
				$('#youtubeframe').attr({'src': youtubehref});
			}else{
				$('#youtubeframe').css({'display': 'none'});
				$('#postimg').css({'display': 'inline-block'});
				$('#podcastframe').css({'display': 'inline-block'});
				
				$('#postimg').css({'background-image': 'url('+postimg+')'});
				$('#podcastframe').attr({'src': postsrc});
			}
			$('#topad').attr({'src': topad});
		}
		
	}
	

</script>