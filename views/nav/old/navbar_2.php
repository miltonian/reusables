<?php

if(!isset($navtype)){ $navtype=1; }
// exit(json_encode($navtype));

if(!isset($isadmin)){ $isadmin=false; }

if(!isset($navbar2categoryfeatured)){ $navbar2categoryfeatured=false; }

if(isset($isadmin)){ if($isadmin){ $navbar2categoryfeatured = true; } }

if(!isset($tagline)){$tagline="";}

?>

<style>
body {
	/*background-color: rgba(240,240,245,1.0);*/
}
.navbar2 .container {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	
}
.navbar2 .main-content {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 90px;
	background-color: white;
	border-bottom: 1px solid #cecece;
}

.navbar2 .logo-div {
	position: absolute;
	display: block;
	margin: 0;
	padding: 0;
	width: 275px;
	/* height: 70px; */
	top: 50%;
	transform: translateY(-50%);
	/*left: 50%;*/
	/*margin-left: -100px;*/
}
/*.navbar2 .logo-div img {max-width: 90%; max-height: 90%;}*/
.navbar2 .subnav {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 40px;
	background-color: white;
	border-bottom: 1px solid #cecece;
	text-align: center;
}
.navbar2 .categories-wrapper {
	position: relative;
	margin: 0;
	padding: 0;
	top: 50%;
	transform: translateY(-50%);
	text-transform: uppercase;
}
.navbar2 .category-btn {
	position: relative; 
	display: inline-block;
	margin: 0px 30px;
	padding: 5px;
	background: transparent;
	float: left;
	text-decoration: none;
	color: #555555;
	font-size: 0.9em;
	font-weight: 500;
}
.navbar2 .subscribe-btn {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 5px;
	color: #333333;
	font-weight: 600;
	font-size: 0.9em;
	-webkit-appearance: none;
	background: transparent;
	border: 0;
	cursor: pointer;
}
.navbar2 .tagline {
	position: absolute;
	margin: 0;
	padding: 0;
	left: 50%;
	color: #555555;
	text-decoration: none;
	bottom: 13px;
	font-weight: 400;
	font-size: 0.6em;
	transform: translateX(-50%);
}

.navbar2 .socialbtns-container { display: inline-block; position: relative; margin: 0; padding: 0; top: 50%; transform: translateY(-50%); float: left; margin-left: 20px; }

@media (min-width: 0px) {
	.navbar2 .categories-wrapper {display: none;}
	.navbar2 .logo-div {left: auto; transform: translate(0, -50%); right: 0; text-align: right; padding-right: 20px;}
	.navbar2 .logo-div img {max-width: 70%; max-height: 70%;}
	.navbar2 .search-container {display: none;}
	.navbar2 .tagline {display: none;}
}
@media (min-width: 768px) {
	.navbar2 .categories-wrapper {display: inline-block;}
	.navbar2 .logo-div {left: 50%; transform: translate(-50%, -50%); right: auto; text-align: center; padding-right: 0;}
	.navbar2 .logo-div img {max-width: 90%; max-height: 90%;}
	.navbar2 .search-container {display: inline-block;}
	.navbar2 .tagline {display: inline-block;}
}
</style>
<div class="navbar2" style="<?php if($isadmin){ echo "margin-top: 60px"; } ?>">
	<div class="container">
		<div class="main-content">
			<div class="socialbtns-container">
				<?php include $docroot.'/reusables/views/socialpagesbtns_1.php'; ?>
			</div>
			<a href="<?php echo $baseurlminimal ?>">
				<div class="logo-div">
					<img src=<?php echo $logoimgthumb ?> width="auto" height="auto">
				</div>
				<h6 class="tagline"><?php echo $tagline ?></h6>
			</a>
			<div class="search-container" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%);">
				<?php include $docroot.'/reusables/views/searchbar_1.php'; ?>
			</div>
		</div>
		<div class="subnav">
			<div style="display: inline-block; position: absolute; float: left; margin-left: 8px; left: 8px;">
				<?php include $docroot.'/reusables/views/menubtn_1.php'; ?>
			</div>
			<?php if(isset($navbar2categories[0]['name'])){ ?>
				<?php if($navtype==1){ ?>
					<div class="categories-wrapper">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/c/'.$navbar2categories[0]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[0]['name']); } ?>" id="<?php echo $navbar2categories[0]['id'] ?>" class="category category-btn 1 sortorder_1 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[0]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/c/'.$navbar2categories[1]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[1]['name']); } ?>" id="<?php echo $navbar2categories[1]['id'] ?>" class="category category-btn 2 sortorder_2 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[1]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/c/'.$navbar2categories[2]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[2]['name']); } ?>" id="<?php echo $navbar2categories[2]['id'] ?>" class="category category-btn 3 sortorder_3 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[2]['name'] ?></a>
						<?php if(isset($navbar2categories[3]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/c/'.$navbar2categories[3]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[3]['name']); } ?>" id="<?php echo $navbar2categories[3]['id'] ?>" class="category category-btn 4 sortorder_4 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[3]['name'] ?></a><?php } ?>
						<?php if(isset($navbar2categories[4]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/c/'.$navbar2categories[4]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[4]['name']); } ?>" id="<?php echo $navbar2categories[4]['id'] ?>" class="category category-btn 5 sortorder_5 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[4]['name'] ?></a><?php } ?>
					</div>
				<?php }else if($navtype==2){ ?>
					<!-- this is for main categories -->
					<div class="categories-wrapper">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/mc/'.$navbar2categories[0]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[0]['name']); } ?>" id="<?php echo $navbar2categories[0]['id'] ?>" class="category category-btn 1 sortorder_1 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[0]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/mc/'.$navbar2categories[1]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[1]['name']); } ?>" id="<?php echo $navbar2categories[1]['id'] ?>" class="category category-btn 2 sortorder_2 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[1]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/mc/'.$navbar2categories[2]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[2]['name']); } ?>" id="<?php echo $navbar2categories[2]['id'] ?>" class="category category-btn 3 sortorder_3 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[2]['name'] ?></a>
						<?php if(isset($navbar2categories[3]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/mc/'.$navbar2categories[3]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[3]['name']); } ?>" id="<?php echo $navbar2categories[3]['id'] ?>" class="category category-btn 4 sortorder_4 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[3]['name'] ?></a><?php } ?>
						<?php if(isset($navbar2categories[4]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'category/mc/'.$navbar2categories[4]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[4]['name']); } ?>" id="<?php echo $navbar2categories[4]['id'] ?>" class="category category-btn 5 sortorder_5 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[4]['name'] ?></a><?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div style="display: inline-block; position: absolute; float: right; margin-right: 8px; right: 8px; top: 50%; transform: translateY(-50%);">
				<button class="subscribe-btn" id="mailchimp-subscribe-button">Subscribe</button>
			</div>
		</div>
	</div>
</div>

<?php require_once $docroot . '/views/mailchimp/subscribe.php'; ?>

<script>
var editingon = false;
	
	if(typeof NavBar2Class == 'undefined'){
		class NavBar2 {
			
			// alert(isfeatured);
		setupactions(){
			// var editingon=false;
			$('.navbar2 .category').off('click');
			$('.navbar2 .category').click(function(){
				// alert('<?php echo $navbar2categoryfeatured ?>')
				if('<?php echo $navbar2categoryfeatured ?>'==true || '<?php echo $navbar2categoryfeatured ?>'=="1"){
					selectedfeatured = $(this).attr('class');
				}else{
					selectedfeatured=null;
				}
				// alert(selectedfeatured);

				var gotothis;
				var whichfeatured;
				var posturl = '<?php echo $baseurlminimal ?>category/c/';
				// selectedfeatured = this.id;
				var thedict;
				//alert(this.className);
				if(editingon==true){
					
					if(selectedfeatured==null || selectedfeatured==""){
						//should never reach here

						// window.location.href = "/editing/post?p="+this.id;
					}else{
						$('.categoriesbackground').css('display', 'inline-block');
						$('.categoriespopview').css('display', 'inline-block');
					}
					//updateifvideo(type, path, div);
				}else{
					// var mediatype = thedict['type'];
					// var prehref = '';
					// var preprehref = '';
					// preprehref = '/';
					// //alert(mediatype);
					// if(mediatype != 'podcast'){
					// 	prehref = preprehref+'post?p=';
					// 	var thehref = prehref.concat(thedict['id']);
					// 	var urltitle = thedict['title'].replace(/\s/g, '');
					// 	window.location.href = thehref+'&'+urltitle;
					// }else{
					// 	preprehref = '/brand-forward';
					// 	prehref = preprehref+'?p=';
					// 	var thehref = prehref.concat(thedict['id']);
					// 	var urltitle = thedict['title'].replace(/\s/g, '');
					// 	window.location.href = thehref+'&'+urltitle;
					// }
					// window.location.href = "http://theanywherecard.com/experiencenash_dev/post?p="+this.id;
					<?php if($navtype==1){ ?>
						window.location.href = "<?php echo $baseurlminimal ?>category/c/"+this.id+'/'+$(this).text().replace(/\W/g, '');
					<?php }else if($navtype==2){ ?>
						window.location.href = "<?php echo $baseurlminimal ?>category/mc/"+this.id+'/'+$(this).text().replace(/\W/g, '');
					<?php } ?>
					
				}
			});
		}

	}
		var NavBar2Class = new NavBar2();
	}
	
	NavBar2Class.setupactions();
</script>