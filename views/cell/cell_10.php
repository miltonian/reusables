<?php
	// cell for admin side

	// $celldict

$required = array(
	"actions"=>array("backgroundimage", ""), 
	"featured_imagepath"=>"",  
	"title"=>"",
	"index"=>""
);
// exit(json_encode($celldict));
// ReusableClasses::checkRequired( $identifier, $celldict, $required );
	
	$cellactionshtml = "";
	if(isset($celldict['actions'])){
		$cellactionshtml .= "<div class='actions-div'>";
		$i=0;
		foreach ($celldict['actions'] as $action) {
			$cellactionshtml .= "<button id='" . $celldict['index'] . "' class='action index_".$i."' style='background-image: url(" . $action['backgroundimage'] . ");'></button>";
			$i++;
		}
		$cellactionshtml .= "</div>";
	}else{
		$celldict['actions'] = array();
	}
?>

<style>
</style>

<?php 
	echo "<div class='cell_10 " . $identifier . "' id=" . $celldict['index'] . " >";
		echo Wrapper::wrapper1( 
			[],
			array(
				Structure::make( "three_columns", [
					"sidecolumn_left"=>array(
						"<div class='featuredimage-div' style='background-image: url(" . Data::getValue( $celldict['featured_imagepath'] ) . ")'></div>"
					),
					"maincolumn"=>array(
						"
						<div class='content'>
							<h4 id='title'>" . Data::getValue( $celldict['title'] ) . "</h4>
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

var editingfunctions = [];
<?php foreach ($celldict['actions'] as $ca) { ?>
	<?php if( $ca['type'] == "modal" ){ ?>
		var thismodalclass = new <?php echo $ca['modal']['modalclass'] ?>Classes();
		editingfunctions.push( thismodalclass );
	<?php }else{ ?>
		editingfunctions.push( "nothing" );
	<?php } ?>
	<?php $i++; ?>
<?php } ?>

$('.cell_10 button#select').click(function(e){
	e.preventDefault();
});

$('.cell_10 button.action').click(function(e){
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
			// let modalclass = new cellactions[theindex][type]['modalclass']+Classes();
			// modalclass.populateview( $(this).id );
			editingfunctions[theindex].populateview(this.id);
			$('.modal_background').css({'display': 'inline-block'});
			$('.' + cellactions[theindex][type]['parentclass']).css({'display': 'inline-block'});
		}else if( type == "popview" ){

		}
	}

});
</script>