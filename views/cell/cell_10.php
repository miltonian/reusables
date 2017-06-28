<?php
	// cell for admin side

	// $celldict

$required = array(
	"actions"=>array("backgroundimage", ""), 
	"featured_imagepath"=>"",  
	"title"=>""
);

ReusableClasses::checkRequired( "cell_10", $celldict, $required );
	
	$cellactionshtml = "";
	if(isset($celldict['actions'])){
		$cellactionshtml .= "<div class='actions-div'>";
		$i=0;
		foreach ($celldict['actions'] as $action) {
			$cellactionshtml .= "<button class='action index_".$i."' style='background-image: url(" . $action['backgroundimage'] . ");'></button>";
			$i++;
		}
		$cellactionshtml .= "</div>";
	}else{
		$celldict['actions'] = array();
	}
?>

<style>
	.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 5px; width: calc(100% - 5px); text-align: left; }
		.<?php echo $identifier ?> .featuredimage-div { display: inline-block; position: relative; margin: 0; padding: 0; border: 0; border-radius: 5px; width: 100%; padding-bottom: 100%; background-size: cover; background-position: center; background-repeat: no-repeat; }
		.<?php echo $identifier ?> .actions-div button { display: inline-block; position: relative; margin: 0; padding: 0; border-radius: 50%; border: 0px solid #e0e0e0; -webkit-appearance: none; background-color: white; width: 40px; height: 40px; cursor: pointer; background-size: 60%; background-position: center; background-repeat: no-repeat; float: left; }
			.<?php echo $identifier ?> .actions-div button:hover { background-color: rgba(0,0,5,0.1); }
</style>

<?php 
	echo "<div class='" . $identifier . "'>";
		echo Wrapper::wrapper1( 
			[],
			array(
				Structure::make( "three_columns", [
					"sidecolumn_left"=>array(
						"<div class='featuredimage-div' style='background-image: url(" . $celldict['featured_imagepath'] . ")'></div>"
					),
					"maincolumn"=>array(
						"
						<div class='content'>
							<h4 id='title'>" . $celldict['title'] . "</h4>
							<p id='status'>This project is Active</p>
						</div>
						"
					),
					"sidecolumn_right"=>array(
						$cellactionshtml
					),
				], $identifier."-structure")
			),
			$identifier."-wrapper"
		);

		echo "</div>";
	?>

<script>

var cellactions = <?php echo json_encode($celldict['actions']) ?>;

$('.<?php echo $identifier ?> button#select').click(function(e){
	e.preventDefault();
});

$('.<?php echo $identifier ?> button.action').click(function(e){
	e.preventDefault();
	var classes = $(this).attr('class');
	var classarray = classes.split(' ');
	var theindex = -1;
	for (var i = 0; i < classarray.length; i++) {
		if(classarray[i].match("^index_")){
			theindex = parseInt( classarray[i].split('_')[1] );
		}
	}
	if(theindex != -1){
		var type = cellactions[theindex]['type'];
		if( type == "link" ){
			window.open(cellactions[theindex][type]);
		}else if( type == "modal" ){
			$('.modal_background').css({'display': 'inline-block'});
			$(cellactions[theindex][type]).css({'display': 'inline-block'});
		}else if( type == "popview" ){

		}
	}

});

</script>