<?php

?>

<style>
.menubtn_1 {
	display: inline-block;
	position: relative;
	cursor: pointer;
}
.menubtn_1 .btn-container {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 10px;
	text-align: center;
	background: transparent;
	cursor: pointer;
	width: 20px;
}
.menubtn_1 .bar-single {
	position: relative;
	display: inline-block;
	margin: 2px 0px;
	margin-right: 0;
	padding: 0;
	width: 100%;
	height: 2px;
	background-color: #333333;
	border-radius: 1px;
	cursor: pointer;
}
.menubtn_1 label {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	color: #706966;
	margin-left: -5px;
	margin-right: 5px;
	top: -4px;
	font-size: 12px;
	font-weight: 500;
	cursor: pointer;
}
</style>

<div class="menubtn_1">
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

	$('.menubtn_1').click(function(){
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

		// $('.menubtn_1 .bar-single.1').animateRotate(degrees1, {
		//   	duration: 300,
		//   	easing: 'linear',
		//   	complete: function () {},
		//   	step: function () {}
		// });
		// $('.menubtn_1 .bar-single.2').animate({'opacity': opacity2}, 300);
		// $('.menubtn_1 .bar-single.3').animateRotate(degrees3, {
		//   	duration: 300,
		//   	easing: 'linear',
		//   	complete: function () {  },
		//   	step: function () {}
		// });
		// $('.menubtn_1 .bar-single.1').animate({'top': fromtop1}, 300);
		// $('.menubtn_1 .bar-single.3').animate({'top': fromtop3}, 300);
		// setTimeout(function(){$('.menubtn_1 label').text(menutext);}, 200);
		
		$('.menuview1').css({'display': 'inline-block', 'left': '0px'});
		$('.menuview1').animate({'opacity': '1'});
		$('.menuview1 .container').animate({'left': '0px'});
	});
</script>












