<?php

$required = array(
	"pages"=>array("link", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

ReusableClasses::checkRequired( "navbar_2", $navdict, $required );

if(!isset($navtype)){ $navtype=1; }

if(!isset($isadmin)){ $isadmin=false; }

if(!isset($navbar2categoryfeatured)){ $navbar2categoryfeatured=false; }

if(isset($isadmin)){ if($isadmin){ $navbar2categoryfeatured = true; } }

if(!isset($tagline)){ $tagline=""; }

$menudict = [
	"pages" => $navdict['pages'],
];

// exit( json_encode( $navdict ) );

echo Menu::make( "menuview_1", $menudict, "menuview1");

?>

<style>
</style>

<div class="navbar_2 <?php echo $identifier ?>" style="<?php if($isadmin){ echo "margin-top: 60px"; } ?>">
	<div class="container">
		<div class="main-content">
			<div class="socialbtns-container">
				<?php echo Sharing::make("socialpagesbtns_1", [], "socialpages"); ?>
			</div>
			<a href="/">
				<div class="logo-div">
					<?php if(isset($navdict['logo'])){ ?>
						<img src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
					<?php }else{ ?>
						<h3><?php echo $navdict['brandname'] ?></h3>
					<?php } ?>
				</div>
				<h6 class="tagline"><?php echo $tagline ?></h6>
			</a>
			<div class="search-container" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%);">
				<?php echo Button::make( "searchbar_1", [], "searchbar" ); ?>
			</div>
		</div>
		<div class="subnav">
			<div style="display: inline-block; position: absolute; float: left; margin-left: 8px; left: 8px;">
				<?php echo Button::make( "menubtn_1", [], "menubtn" ); ?>
			</div>

			<?php if( sizeof( $navdict['categories'] ) > 0 ){ ?>
				<div class='categories-wrapper'>
				<?php foreach ($navdict['categories'] as $c) { ?>
					<a href="<?php echo '/'.$c['id'] . '/' . preg_replace('/\PL/u', '', $c['name']); ?>" 
						id="<?php echo $c['id'] ?>" 
						class="category category-btn 1 sortorder_1 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $c['name'] ?></a>
				<?php } ?>

				</div>
			<?php } ?>

			<?php if(isset($celldict['categories'][0]['name'])){ ?>
				<?php if($navtype==1){ ?>
					<div class="categories-wrapper">
						<a href="
							<?php 
								if($isadmin){ 
									echo '#'; 
								}else{ 
									echo '/category/c/'.$navbar2categories[0]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[0]['name']); 
								} 
							?>
						" 
						id="
							<?php 
								echo $navbar2categories[0]['id']
							?>
						" 
						class="
							category 
							category-btn 
							1 
							sortorder_1 
							featuredsectionid_<?php echo $featuredsectionid ?>
						">
							<?php echo $navbar2categories[0]['name'] ?>
						</a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[1]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[1]['name']); } ?>" id="<?php echo $navbar2categories[1]['id'] ?>" class="category category-btn 2 sortorder_2 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[1]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[2]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[2]['name']); } ?>" id="<?php echo $navbar2categories[2]['id'] ?>" class="category category-btn 3 sortorder_3 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[2]['name'] ?></a>
						<?php if(isset($navbar2categories[3]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[3]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[3]['name']); } ?>" id="<?php echo $navbar2categories[3]['id'] ?>" class="category category-btn 4 sortorder_4 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[3]['name'] ?></a><?php } ?>
						<?php if(isset($navbar2categories[4]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[4]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[4]['name']); } ?>" id="<?php echo $navbar2categories[4]['id'] ?>" class="category category-btn 5 sortorder_5 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[4]['name'] ?></a><?php } ?>
					</div>
				<?php }else if($navtype==2){ ?>
					<!-- this is for main categories -->
					<div class="categories-wrapper">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[0]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[0]['name']); } ?>" id="<?php echo $navbar2categories[0]['id'] ?>" class="category category-btn 1 sortorder_1 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[0]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[1]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[1]['name']); } ?>" id="<?php echo $navbar2categories[1]['id'] ?>" class="category category-btn 2 sortorder_2 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[1]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[2]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[2]['name']); } ?>" id="<?php echo $navbar2categories[2]['id'] ?>" class="category category-btn 3 sortorder_3 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[2]['name'] ?></a>
						<?php if(isset($navbar2categories[3]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[3]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[3]['name']); } ?>" id="<?php echo $navbar2categories[3]['id'] ?>" class="category category-btn 4 sortorder_4 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[3]['name'] ?></a><?php } ?>
						<?php if(isset($navbar2categories[4]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[4]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[4]['name']); } ?>" id="<?php echo $navbar2categories[4]['id'] ?>" class="category category-btn 5 sortorder_5 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[4]['name'] ?></a><?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div style="display: inline-block; position: absolute; float: right; margin-right: 8px; right: 8px; top: 50%; transform: translateY(-50%);">
				<button class="subscribe-btn" id="mailchimp-subscribe-button">Subscribe</button>
			</div>
		</div>
	</div>
</div>

<?php 
	require_once 'views/mailchimp/subscribe.php'; 
?>

<script>
var editingon = false;
	
	if(typeof <?php echo $identifier ?> == 'undefined'){
		class <?php echo $identifier ?>Classes {
			
		setupactions(){
			// var editingon=false;
			$('.<?php echo $identifier ?> .category').off('click');
			$('.<?php echo $identifier ?> .category').click(function(){
				// alert('<?php echo $navbar2categoryfeatured ?>')
				if('<?php echo $navbar2categoryfeatured ?>'==true || '<?php echo $navbar2categoryfeatured ?>'=="1"){
					selectedfeatured = $(this).attr('class');
				}else{
					selectedfeatured=null;
				}
				// alert(selectedfeatured);

				var gotothis;
				var whichfeatured;
				var posturl = '/category/c/';
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
						window.location.href = "/category/c/"+this.id+'/'+$(this).text().replace(/\W/g, '');
					<?php }else if($navtype==2){ ?>
						window.location.href = "/category/mc/"+this.id+'/'+$(this).text().replace(/\W/g, '');
					<?php } ?>
					
				}
			});
		}

	}
		var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	}
	
	<?php echo $identifier ?>.setupactions();
</script>