var navbarshowing = false;
$(document).ready(function(){
	navbarshowing=false;
});

	class slim_classes {

		slim_start(){
			
		}
		showonscroll(){
			$('.slim.desktopnav.main').css({'top': '-100px'});
				$(window).scroll(function(){
					var top1;
					var top2;
					var thisscroll = $(this).scrollTop();
					var changenav = false;
				   if (thisscroll > 300){
					   if(navbarshowing == false){
						   //alert('showing='+hT+hH-wH);
						   changenav = true;
						   navbarshowing = true;
						   //$('.navbar').css({'display': 'inline-block'});
						   top1 = '0px';
					   }
					}else {
						if(navbarshowing == true){
							//alert('hiding='+hT+hH-wH);
							changenav = true;
							navbarshowing = false;
							top1 = '-100px';
						}
					}
					if(changenav==true){
						changenav=false;
						$('.slim.desktopnav.main').stop().animate({
					       		'top': top1
				       			}, 300);
					}
				});
		}

	}