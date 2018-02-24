<?php

namespace Reusables;

?>

<style>
</style>

<div class="viewtype_button <?php echo $identifier ?> hamburger">
	<div class="btn-container">
		<div class="bar-single 1"></div>
		<div class="bar-single 2"></div>
		<div class="bar-single 3"></div>
	</div>
	<label>MENU</label>
</div>

<script>
var menuopen=false;
	$.fn.animateRotate = function(angle, duration, easing, complete) {
		  var args = $.speed(duration, easing, complete);
		  var step = args.step;
		  return this.each(function(i, e) {
		    args.complete = $.proxy(args.complete, e);
		    args.step = function(now) {
		      $.style(e, 'transform', 'rotate(' + now + 'deg)');
		      if (step) return step.apply(e, arguments);
		    };

		    $({deg: 0}).animate({deg: angle}, args);
		  });
		};

	$('.<?php echo $identifier ?>').click(function(){
		// var degrees1 = 45;
		// var degrees3 = -45;
		// var opacity2 = '0';
		// var fromtop1 = '6';
		// var fromtop3 = '-6';
		// var menutext = "CLOSE";
		// if(menuopen){
		// 	menuopen=false;
		// 	degrees1 = 0;
		// 	degrees3 = 0;
		// 	opacity2 = '1';
		// 	fromtop1 = '0';
		// 	fromtop3 = '0';
		// 	menutext = "MENU";
		// }else{
		// 	menuopen=true;
		// }

		// $('.<?php echo $identifier ?> .bar-single.1').animateRotate(degrees1, {
		//   	duration: 300,
		//   	easing: 'linear',
		//   	complete: function () {},
		//   	step: function () {}
		// });
		// $('.<?php echo $identifier ?> .bar-single.2').animate({'opacity': opacity2}, 300);
		// $('.<?php echo $identifier ?> .bar-single.3').animateRotate(degrees3, {
		//   	duration: 300,
		//   	easing: 'linear',
		//   	complete: function () {  },
		//   	step: function () {}
		// });
		// $('.<?php echo $identifier ?> .bar-single.1').animate({'top': fromtop1}, 300);
		// $('.<?php echo $identifier ?> .bar-single.3').animate({'top': fromtop3}, 300);
		// setTimeout(function(){$('.<?php echo $identifier ?> label').text(menutext);}, 200);
		
		$('.menuview_1').css({'display': 'inline-block', 'left': '0px'});
		$('.menuview_1').animate({'opacity': '1'});
		$('.menuview_1 .container').animate({'left': '0px'});
	});
</script>












