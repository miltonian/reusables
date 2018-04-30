<?php

namespace Reusables;

$columncount=0;

?>


	</div>
</div>

<script>
	var columncount = <?php echo $columncount ?>;
	var currentcolumn = 1;

	$('.<?php echo $identifier ?>.main_with_hidden.main .close').click(function(e){
		e.preventDefault();
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