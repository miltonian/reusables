<?php

namespace Reusables;

$required = array(
	"pages"=>array("link", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

ReusableClasses::checkRequired( "bulky", $viewdict, $required );

if(!isset($navtype)){ $navtype=1; }

if(!isset($isadmin)){ $isadmin=false; }

if(!isset($navbar2categoryfeatured)){ $navbar2categoryfeatured=false; }

if(isset($isadmin)){ if($isadmin){ $navbar2categoryfeatured = true; } }

if(!isset($tagline)){ $tagline=""; }

$menudict = [
	"pages" => $viewdict['pages'],
];

$categories = Data::getValue( $viewdict, 'categories' );

// exit( json_encode( $viewdict ) );

Data::addData( $menudict, "menuview1" );
echo Menu::make( "menuview_1", "menuview1");

?>

<style>
</style>

<div class="bulky main <?php echo $identifier ?>" style="<?php if($isadmin){ echo "margin-top: 60px"; } ?>">
	<div class="bulky container">
		<div class="bulky main-content">
			<div class="bulky socialbtns-container">
				<?php echo Sharing::make("socialpage_circles", [], "socialpages"); ?>
			</div>
			<a href="/">
				<div class="bulky logo-div">
					<?php if(isset($viewdict['logo'])){ ?>
						<img src=<?php echo $viewdict['logo'] ?> width="auto" height="auto">
					<?php }else{ ?>
						<h3><?php echo $viewdict['brandname'] ?></h3>
					<?php } ?>
				</div>
				<h6 class="bulky tagline"><?php echo $tagline ?></h6>
			</a>
			<div class="bulky search-container" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%);">
				<?php 
					Data::addData( [], $identifier . "_search" );
					echo Button::make( "search", $identifier . "_search" ); 
				?>
			</div>
		</div>
		<div class="bulky subnav">
			<div style="display: inline-block; position: absolute; float: left; margin-left: 8px; left: 8px;">
				<?php 
					Data::addData( [], $identifier . "_menubtn");
					echo Button::make( "hamburger", $identifier . "_menubtn" ); 
				?>
			</div>

			<?php if( $categories != "" ){ ?>
				<div class='bulky categories-wrapper'>
				<?php foreach ($categories as $c) { ?>
					<a href="<?php echo '/'.$c['id'] . '/' . preg_replace('/\PL/u', '', $c['name']); ?>" 
						id="<?php echo $c['id'] ?>" 
						class="bulky category category-btn 1 sortorder_1 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $c['name'] ?></a>
				<?php } ?>

				</div>
			<?php } ?>

			<?php if(isset($celldict['categories'][0]['name'])){ ?>
				<?php if($navtype==1){ ?>
					<div class="bulky categories-wrapper">
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
							bulky 
							category 
							category-btn 
							1 
							sortorder_1 
							featuredsectionid_<?php echo $featuredsectionid ?>
						">
							<?php echo $navbar2categories[0]['name'] ?>
						</a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[1]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[1]['name']); } ?>" id="<?php echo $navbar2categories[1]['id'] ?>" class="bulky category category-btn 2 sortorder_2 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[1]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[2]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[2]['name']); } ?>" id="<?php echo $navbar2categories[2]['id'] ?>" class="bulky category category-btn 3 sortorder_3 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[2]['name'] ?></a>
						<?php if(isset($navbar2categories[3]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[3]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[3]['name']); } ?>" id="<?php echo $navbar2categories[3]['id'] ?>" class="bulky category category-btn 4 sortorder_4 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[3]['name'] ?></a><?php } ?>
						<?php if(isset($navbar2categories[4]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/c/'.$navbar2categories[4]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[4]['name']); } ?>" id="<?php echo $navbar2categories[4]['id'] ?>" class="bulky category category-btn 5 sortorder_5 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[4]['name'] ?></a><?php } ?>
					</div>
				<?php }else if($navtype==2){ ?>
					<!-- this is for main categories -->
					<div class="bulky categories-wrapper">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[0]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[0]['name']); } ?>" id="<?php echo $navbar2categories[0]['id'] ?>" class="bulky category category-btn 1 sortorder_1 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[0]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[1]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[1]['name']); } ?>" id="<?php echo $navbar2categories[1]['id'] ?>" class="bulky category category-btn 2 sortorder_2 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[1]['name'] ?></a>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[2]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[2]['name']); } ?>" id="<?php echo $navbar2categories[2]['id'] ?>" class="bulky category category-btn 3 sortorder_3 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[2]['name'] ?></a>
						<?php if(isset($navbar2categories[3]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[3]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[3]['name']); } ?>" id="<?php echo $navbar2categories[3]['id'] ?>" class="bulky category category-btn 4 sortorder_4 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[3]['name'] ?></a><?php } ?>
						<?php if(isset($navbar2categories[4]['name'])){ ?><a href="<?php if($isadmin){ echo '#'; }else{ echo '/category/mc/'.$navbar2categories[4]['id'] . '/' . preg_replace('/\PL/u', '', $navbar2categories[4]['name']); } ?>" id="<?php echo $navbar2categories[4]['id'] ?>" class="bulky category category-btn 5 sortorder_5 featuredsectionid_<?php echo $featuredsectionid ?>"><?php echo $navbar2categories[4]['name'] ?></a><?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div style="display: inline-block; position: absolute; float: right; margin-right: 8px; right: 8px; top: 50%; transform: translateY(-50%);">
				<button class="bulky subscribe-btn" id="mailchimp-subscribe-button">Subscribe</button>
			</div>
		</div>
	</div>
</div>

<?php 
	// require_once 'miltonian/reusables/views/mailchimp/subscribe.php'; 
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