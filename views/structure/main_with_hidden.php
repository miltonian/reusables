<?php
	$required = array(
		"title"=>"",
		"first"=>"",  
		"second"=>"",
		"third"=>""
	);

	ReusableClasses::checkRequired( "three_columns", $structuredict, $required );

?>

<style>
</style>

<div class="<?php echo $identifier ?> main_with_hidden">
	<div class="header">
		<button id="close">&#10006;</button>
		<?php echo Header::make( "header_5", ["title"=>$structuredict['title']], "campaignedit-header" ); ?>
		<?php echo Header::make( 
			"steps_1", 
			[
				"steps"=>array(
					["title"=>"Step 1", "subtitle"=>"Essentials"],
					["title"=>"Step 2", "subtitle"=>"Details"],
					["title"=>"Step 3", "subtitle"=>"Rewards"]
				)
			],
			"steps_1"
		)
		?>
	</div>
	<div class="body">
		<div class="column first" id="1">
			<?php 
				foreach ($structuredict['first'] as $view) {
					echo $view;
				}
			?>
		</div>
		<div class="column second" id="2">
			<?php 
				foreach ($structuredict['second'] as $view) {
					echo $view;
				}
			?>
		</div>
		<div class="column third" id="3">
			<?php 
				foreach ($structuredict['third'] as $view) {
					echo $view;
				}
			?>
		</div>
	</div>
</div>

<script>
	var columncount = 3;
	var currentcolumn = 1;
	$('.<?php echo $identifier ?> #close').click(function(){

		$('.main_with_hidden .column').css({'position': 'absolute'});
		$('.main_with_hidden .column').animate({'left': '100%'});

		$('.main_with_hidden .column#1').css({'position': 'relative'});
		$('.main_with_hidden .column#1').animate({'left': '0'});
		currentcolumn = 1;

		$('.<?php echo $identifier ?>').parent().css('display', 'none');
		$('.<?php echo $identifier ?>').parent().parent().parent().css('display', 'none');

		$('.main_with_hidden.next').css({'display': 'inline-block'});
		$('.main_with_hidden.save').css({'display': 'none'});

	});
	$('.main_with_hidden.next').click( function(e){
		e.preventDefault();
		$('.main_with_hidden .column#' + currentcolumn).css({'position': 'absolute'});
		$('.main_with_hidden .column#' + currentcolumn).animate({'left': '-100%'});

		$('.main_with_hidden .column#' + (currentcolumn+1) ).css({'position': 'relative'});
		$('.main_with_hidden .column#' + (currentcolumn+1) ).animate({'left': '0'});
		currentcolumn++;
		if( currentcolumn == columncount ){
			$('.main_with_hidden.next').css({'display': 'none'});
			$('.main_with_hidden.save').css({'display': 'inline-block'});
		}
	});
</script>