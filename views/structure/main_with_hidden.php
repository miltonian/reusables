<?php
	$required = array(
		"title"=>"",
		"c1"=>"",  
		"c2"=>"",
		"c3"=>""
		// ...
	);

	$columns = array();
	$allkeys = array_keys($structuredict);
	foreach ($allkeys as $k) {

		if( $k == "title" ){
			continue;
		}
		// $dict = [$k => $structuredict[$k] ];
		array_push($columns, $structuredict[$k]);
		
	}
	// exit(json_encode(sizeof($columns)));

	// ReusableClasses::checkRequired( "main_with_hidden", $structuredict, $required );

?>

<style>
</style>

<div class="<?php echo $identifier ?> main_with_hidden main">
	<div class="main_with_hidden header">
		<button class="main_with_hidden" id="close">&#10006;</button>
		<?php echo Header::make( "header_5", ["title"=>$structuredict['title']], "campaignedit-header" ); ?>
		<?php echo Header::make( 
			"steps_1", 
			[
				"steps"=>array(
					["title"=>"Step 1", "subtitle"=>""],
					["title"=>"Step 2", "subtitle"=>""],
					["title"=>"Step 3", "subtitle"=>""]
				)
			],
			"steps_1"
		)
		?>
	</div>
	<div class="main_with_hidden body">
	<?php for ($i=0; $i < sizeof($columns); $i++) { ?>
		<div class="main_with_hidden column c<?php echo ($i+1) ?>" id="<?php echo $i+1 ?>">
			<?php 
				foreach ($columns[$i] as $view) {
					echo $view;
				}
			?>
		</div>

	<?php } ?>
		
	</div>
</div>

<script>
	var columncount = <?php echo sizeof($columns) ?>;
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