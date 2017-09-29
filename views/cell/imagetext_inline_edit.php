<?php

namespace Reusables;

	// cell for admin side

	// $viewdict

$required = array(
	"actions"=>array("backgroundimage", ""), 
	"featured_imagepath"=>"",  
	"title"=>"",
	"index"=>""
);
$cellindex = Data::getValue( $viewdict, 'index' );
// if($cellindex == 2){ exit("hey!" ); }

// exit( json_encode( Data::retrieveDataWithID( Data::getValue( $viewdict, 'data_id' ) ) ) );

$viewoptions = ReusableClasses::convertViewActions( $viewoptions );

// ReusableClasses::checkRequired( $identifier, $viewdict, $required );
	
	$cellactionshtml = "";
	if( isset( $viewoptions['actions'] ) ){
		$cellactionshtml .= "<div class='imagetext_inline_edit actions-div'>";
		$i=0;
		foreach ( $viewoptions['actions'] as $action ) {
			$actiontype = Data::getValue( $action, 'type' );
			if( $actiontype == "dropdown" ){
				$cellactionshtml .= "<div class='dropdown'>";
					$cellactionshtml .= "<div class='inner-dropdown'>";
						$cellactionshtml .= "<button id='" . Data::getValue( $viewdict, 'index' ) . "' class='inner-dropbtn imagetext_inline_edit action actionindex_" . $i . " index_" . $cellindex . "' style='background-image: url(" . $action['backgroundimage'] . ");'></button>";
						$cellactionshtml .= "<div id='inner-myDropdown_" . Data::getValue( $viewdict, 'index' ) . "' class='inner-dropdown-content'>";
							for ($a=0; $a < sizeof( $action['dropdown_array'] ); $a++) {
								$dropdownarray = $action['dropdown_array'];
								$cellactionshtml .= "<a href='" . $dropdownarray[$a]['link'] . "'>" . $dropdownarray[$a]['text'] . "</a>";
							}
						$cellactionshtml .= "</div>";
					$cellactionshtml .= "</div>";
				$cellactionshtml .= "</div>";
			}else{
				$cellactionshtml .= "<button id='" . Data::getValue( $viewdict, 'index' ) . "' class='imagetext_inline_edit action actionindex_" . $i . " index_" . $cellindex . "' style='background-image: url(" . $action['backgroundimage'] . ");'></button>";
			}

			$i++;
		}
		$cellactionshtml .= "</div>";
	}else{
		$viewoptions['actions'] = array();
	}

?>

<style>
</style>

<?php 
	echo "<div class='imagetext_inline_edit main " . $identifier . " index_" . Data::getValue( $viewdict, 'index' ) . "' id=" . Data::getValue( $viewdict, 'view_id' ) . " >";
		echo Wrapper::wrapper1( 
			[],
			array(
				Structure::make( "three_columns", [
					"sidecolumn_left"=>array(
						"<div class='imagetext_inline_edit featuredimage-div' style='background-image: url(" . Data::getValue( $viewdict, 'featured_imagepath' ) . ")'></div>"
					),
					"maincolumn"=>array(
						"
						<div class='imagetext_inline_edit content'>
							<h4 class='imagetext_inline_edit ' id='title'>" . Data::getValue( $viewdict, 'title' ) . "</h4>
							<p class='imagetext_inline_edit' id='desc'>" . Data::getValue( $viewdict, 'desc' ) . "</p>
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

	var cellactions = <?php echo json_encode( $viewoptions['actions'] ) ?>;

	<?php ReusableClasses::getEditingFunctionsJS( $viewoptions ) ?>;
	

function imagetext_inline_edit_start(){
	imagetext_inline_edit.setupactions( cellactions, editingfunctions );
	
	$('.inner-dropbtn.imagetext_inline_edit.action').click(function(){
		var actionindex = Reusable.getIndexFromClass( "actionindex_")
		// CHECK AGAIN
		document.getElementById("inner-myDropdown_"+actionindex).classList.toggle("show");
	});
}

	function dropdownaction(e) {
		// e.preventDefault();
		document.getElementById("inner-myDropdown").classList.toggle("show");
	}

	window.onclick = function(e) {
		// e.preventDefault();
		if (!e.target.matches('.inner-dropbtn')) {

			var dropdowns = document.getElementsByClassName("inner-dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
		}else{
			e.preventDefault();
		}
	}
</script>