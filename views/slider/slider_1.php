<?php 

namespace Reusables;

	// $docroot = $_SERVER['DOCUMENT_ROOT'];
?>

<style>
</style>

<div class="slider_1 <?php echo $identifier ?>" style="">
	<div id="sliderwrapper" style="display: inline-block; position: relative; margin: 0; padding: 0; width: 3000px; height: 500px; left: 44%; margin-left: -1500px;">
		<div class="sliderobj 0" style="-ms-transform: scale(0.8,0.8); -webkit-transform: scale(0.8,0.8); transform: scale(0.8,0.8);"><?php $cell5id=$slider1array[3]['id']; $cell5title=$slider1array[3]['title']; $cell5image=$slider1array[3]['featured_imagepath']; $notitle=true; include $docroot.'/reusables/views/cell_5.php'; ?></div>
		<div class="sliderobj 1" style="-ms-transform: scale(0.8,0.8); -webkit-transform: scale(0.8,0.8); transform: scale(0.8,0.8);"><?php $cell5id=$slider1array[0]['id']; $cell5title=$slider1array[0]['title']; $cell5image=$slider1array[0]['featured_imagepath']; $notitle=true; include $docroot.'/reusables/views/cell_5.php'; ?></div>
		<div class="sliderobj 2"><?php $cellid=$slider1array[1]['id']; $cell5title=$slider1array[1]['title']; $cell5image=$slider1array[1]['featured_imagepath']; $notitle=false; include $docroot.'/reusables/views/cell_5.php'; ?></div>
		<div class="sliderobj 3" style="-ms-transform: scale(0.8,0.8); -webkit-transform: scale(0.8,0.8); transform: scale(0.8,0.8);"><?php $cell5id=$slider1array[2]['id']; $cell5title=$slider1array[2]['title']; $cell5image=$slider1array[2]['featured_imagepath']; $notitle=true; include $docroot.'/reusables/views/cell_5.php'; ?></div>
	</div>
</div>

<script>
	var hiddendiv = $('.sliderobj.0');
	var leftdiv = $('.sliderobj.1');
	var middiv = $('.sliderobj.2');
	var rightdiv = $('.sliderobj.3');

	var totalwidth = $('.sliderobj.1').width() + $('.sliderobj.2').width() + $('.sliderobj.3').width()+$('.sliderobj.0').width();
	$('#sliderwrapper').css({'width': totalwidth+'px', 'margin-left': '-'+((totalwidth/2.0)+$('.sliderobj.0').width()/2)+'px'});
	class Slider1 {
		
		firetimer(){
			setTimeout(
				function(){
					let Slider1Class = new Slider1();
					Slider1Class.moveright();
				}, 
				5000
			);
		}
		moveright(){
			// alert(totalwidth/4);
			// alert($('#sliderwrapper').css('left'));
			$('#sliderwrapper').animate({'left': '1237'}, 450, 'swing', function(){
				$('#sliderwrapper').css({'left': '527.5px'});
				rightdiv.insertBefore(hiddendiv);
				var goingtobemiddiv = leftdiv;
				leftdiv = hiddendiv;
				hiddendiv = rightdiv;
				rightdiv = middiv;
				middiv = goingtobemiddiv;

				let Slider1Class = new Slider1();
				Slider1Class.firetimer();
			});
			// hiddendiv.animate({'left': hiddendiv.width()});
			// leftdiv.animate({'left': hiddendiv.width(), '-ms-transform': 'scale(1,1)', '-webkit-transform': 'scale(1,1)', 'transform': 'scale(1,1)'});
			// leftdiv.animate({'left': hiddendiv.width()}, 300);
			$('.sliderobj').find('label').css('opacity', '0');
			leftdiv.find('label').css('opacity', '1');
			leftdiv.css('borderSpacing', 0.8).animate(
			    {
			      borderSpacing: 1
			    },
			    {
			    step: function(now,fx) {
			      $(this).css('transform','scale('+now+')', '-webkit-transform','scale('+now+')', '-ms-transform','scale('+now+')');  
			    },
			    duration:'450'
		  	});
		  	middiv.css('borderSpacing', 1).animate(
			    {
			      borderSpacing: 0.8
			    },
			    {
			    step: function(now,fx) {
			      $(this).css('transform','scale('+now+')', '-webkit-transform','scale('+now+')', '-ms-transform','scale('+now+')');  
			    },
			    duration:'450'
		  	});
			// middiv.animate({'left': hiddendiv.width()});
			// rightdiv.animate({'left': hiddendiv.width()});
		}
		moveleft(){
			// alert(totalwidth/4);
			// alert($('#sliderwrapper').css('left'));
			$('#sliderwrapper').animate({'left': '-182'}, 450, 'swing', function(){
				$('#sliderwrapper').css({'left': '527.5px'});
				leftdiv.insertAfter(hiddendiv);
				var goingtobemiddiv = rightdiv;
				rightdiv = hiddendiv;
				hiddendiv = leftdiv;
				leftdiv = middiv;
				middiv = goingtobemiddiv;

				firetimer();
			});
			// hiddendiv.animate({'left': hiddendiv.width()});
			// leftdiv.animate({'left': hiddendiv.width(), '-ms-transform': 'scale(1,1)', '-webkit-transform': 'scale(1,1)', 'transform': 'scale(1,1)'});
			// leftdiv.animate({'left': hiddendiv.width()}, 300);
			$('.sliderobj').find('label').css('opacity', '0');
			rightdiv.find('label').css('opacity', '1');
			rightdiv.css('borderSpacing', 0.8).animate(
			    {
			      borderSpacing: 1
			    },
			    {
			    step: function(now,fx) {
			      $(this).css('transform','scale('+now+')', '-webkit-transform','scale('+now+')', '-ms-transform','scale('+now+')');  
			    },
			    duration:'450'
		  	});
		  	middiv.css('borderSpacing', 1).animate(
			    {
			      borderSpacing: 0.8
			    },
			    {
			    step: function(now,fx) {
			      $(this).css('transform','scale('+now+')', '-webkit-transform','scale('+now+')', '-ms-transform','scale('+now+')');  
			    },
			    duration:'450'
		  	});
			// middiv.animate({'left': hiddendiv.width()});
			// rightdiv.animate({'left': hiddendiv.width()});
		}

		setupactions(){
			var editingon=false;
			$('.sliderobj').click(function(){
				var gotothis;
				var whichfeatured;
				var posturl = 'http://entrenash.co/post?p=';
				// selectedfeatured = this.id;
				var thedict;
				//alert(this.className);
				if(this.className == 'sliderobj 0'){
					// gotothis = posturl+featuredonepostid;
					gotothis = posturl;
				}else if(this.className == 'sliderobj 1'){
					// gotothis = posturl+featuredtwopostid;
					gotothis = posturl;
				}else if(this.className == 'sliderobj 2'){
					// gotothis = posturl+featuredthreepostid;
					gotothis = posturl;
				}else if(this.className == 'sliderobj 3'){
					// gotothis = posturl+featuredfourpostid;
					gotothis = posturl;
				}
				
				if(editingon==true){
					// $('.articlesbackground').css('display', 'inline-block');
					// $('.articlespopview').css('display', 'inline-block');
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
					// window.location.href = "http://theanywherecard.com/experiencenash_dev/post";
				}
			});
		}

	}
		
	let Slider1Class = new Slider1();
	Slider1Class.firetimer();
	Slider1Class.setupactions();
</script>

