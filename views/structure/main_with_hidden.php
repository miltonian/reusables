<?php

namespace Reusables;

	$columns = array();
	$allkeys = array_keys($structuredict);
	$columncount=0;


	foreach ($allkeys as $k) {

		if( $k == "title" || $k == "steps" ){
			continue;
		}
		// $dict = [$k => $structuredict[$k] ];
		array_push($columns, $structuredict[$k]);

	}

	// exit(json_encode(sizeof($columns)));


	// $step1dict = [
	// 			"steps"=>array(
	// 				["title"=>"Step 1", "subtitle"=>""],
	// 				["title"=>"Step 2", "subtitle"=>""],
	// 				["title"=>"Step 3", "subtitle"=>""]
	// 			)
	// 		];

	$mainheaderdict = [ "title"=>$structuredict['title'] ];

	$step1dict = ["steps" => Data::getValue( $structuredict, 'steps' ) ];
	// exit( json_encode( $structuredict ) );


	Data::add( $mainheaderdict, $identifier . "_main_header" );
	Data::add( $step1dict, $identifier . "_steps" );
// exit( json_encode( $step1dict['steps'] ) );

?>

<style>
</style>

<div class="viewtype_structure <?php echo $identifier ?> main_with_hidden main">
	<div class="main_with_hidden header">
		<button class="main_with_hidden" id="close">&#10006;</button>
		<?php echo Header::make( "basic", $identifier . "_main_header" ); ?>
		<?php
			if( $step1dict['steps'] != "" ) {
				echo Header::make( "steps", $identifier . "_steps" );
			}
		?>
	</div>
	<div class="main_with_hidden body">

	<?php for ($i=0; $i < sizeof($columns); $i++) {
		if( isset( $columns[$i] ) ) {
			if( !is_string( $columns[$i] ) ) {
				$columncount++;
				?>

				<div class="main_with_hidden column c<?php echo ($i+1) ?>" id="main_with_hidden_<?php echo $i+1 ?>">
					<?php
						foreach ($columns[$i] as $view) {
							echo $view;
						}
					?>
				</div>

			<?php
			}
		}
	} ?>

	</div>
</div>

<script>
	var columncount = <?php echo $columncount ?>;
	var currentcolumn = 1;

	$('.<?php echo $identifier ?> #close').click(function(){

		$('.main_with_hidden .column').css({'position': 'absolute'});
		$('.main_with_hidden .column').animate({'left': '100%'});

		$('.main_with_hidden .column#main_with_hidden_1').css({'position': 'relative'});
		$('.main_with_hidden .column#main_with_hidden_1').animate({'left': '0'}, 0);
		currentcolumn = 1;

		$('.<?php echo $identifier ?>').parent().css('display', 'none');
		$('.<?php echo $identifier ?>').parent().parent().parent().css('display', 'none');

		if( columncount > 1 ) {
			$('.main_with_hidden.next').css({'display': 'inline-block'});
			$('.main_with_hidden.save').css({'display': 'none'});
		}else{
			$('.main_with_hidden.next').css({'display': 'none'});
			$('.main_with_hidden.save').css({'display': 'inline-block'});
		}

	});
	$('.main_with_hidden.next').click( function(e){
		e.preventDefault();
		$('.main_with_hidden .column#main_with_hidden_' + currentcolumn).css({'position': 'absolute'});
		$('.main_with_hidden .column#main_with_hidden_' + currentcolumn).animate({'left': '-100%'});

		$('.main_with_hidden .column#main_with_hidden_' + (currentcolumn+1) ).css({'position': 'relative'});
		$('.main_with_hidden .column#main_with_hidden_' + (currentcolumn+1) ).animate({'left': '0'});
		currentcolumn++;
		// alert( "currentcolumn: " + currentcolumn + ", columncount: " + columncount )
		if( currentcolumn == columncount ){
			$('.main_with_hidden.next').css({'display': 'none'});
			$('.main_with_hidden.save').css({'display': 'inline-block'});
		}
	});

	function gotostep( tostep ) {

		if( tostep != currentcolumn ){
			$('.main_with_hidden .column#main_with_hidden_' + currentcolumn).css({'position': 'absolute'});

			if( tostep > currentcolumn ){
				$('.main_with_hidden .column#main_with_hidden_' + currentcolumn).animate({'left': '-100%'});
			}else{
				$('.main_with_hidden .column#main_with_hidden_' + currentcolumn).animate({'left': '100%'});
			}

			$('.main_with_hidden .column#main_with_hidden_' + (tostep) ).css({'position': 'relative'});
			$('.main_with_hidden .column#main_with_hidden_' + (tostep) ).animate({'left': '0'});
			currentcolumn = tostep;

			if( currentcolumn == columncount ){
				$('.main_with_hidden.next').css({'display': 'none'});
				$('.main_with_hidden.save').css({'display': 'inline-block'});
			}else{
				$('.main_with_hidden.next').css({'display': 'inline-block'});
				$('.main_with_hidden.save').css({'display': 'none'});
			}
		}

	}

</script>
