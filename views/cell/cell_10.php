<?php

namespace Reusables;

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
		$cellactionshtml .= "<div class='cell_10 actions-div'>";
		$i=0;
		foreach ($celldict['actions'] as $action) {
			if($action['type'] == "dropdown" ){
				$cellactionshtml .= "<div class='dropdown_1'>";
					$cellactionshtml .= "<div class='inner-dropdown'>";
						$cellactionshtml .= "<button id='" . $celldict['index'] . "' class='inner-dropbtn cell_10 action index_".$i."' style='background-image: url(" . $action['backgroundimage'] . ");'></button>";
						$cellactionshtml .= "<div id='inner-myDropdown_" . $celldict['index'] . "' class='inner-dropdown-content'>";
							for ($a=0; $a < sizeof( $action['dropdown_array'] ); $a++) {
								$dropdownarray = $action['dropdown_array'];
								$cellactionshtml .= "<a href='" . $dropdownarray[$a]['link'] . "'>" . $dropdownarray[$a]['text'] . "</a>";
							}
						$cellactionshtml .= "</div>";
					$cellactionshtml .= "</div>";
				$cellactionshtml .= "</div>";
			}else{
				$cellactionshtml .= "<button id='" . $celldict['index'] . "' class='cell_10 action index_".$i."' style='background-image: url(" . $action['backgroundimage'] . ");'></button>";
			}

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
	echo "<div class='cell_10 main " . $identifier . "' id=" . $celldict['index'] . " >";
		echo Wrapper::wrapper1( 
			[],
			array(
				Structure::make( "three_columns", [
					"sidecolumn_left"=>array(
						"<div class='cell_10 featuredimage-div' style='background-image: url(" . Data::getValue( $celldict, 'featured_imagepath' ) . ")'></div>"
					),
					"maincolumn"=>array(
						"
						<div class='cell_10 content'>
							<h4 class='cell_10 ' id='title'>" . Data::getValue( $celldict, 'title' ) . "</h4>
							<p class='cell_10 ' id='status'>This project is Active</p>
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

function cell_10_start(){
	cell_10.setupactions( cellactions, editingfunctions );
	
	$('.inner-dropbtn.cell_10.action').click(function(){
		document.getElementById("inner-myDropdown_"+this.id).classList.toggle("show");
	});
}

	function dropdownaction(e) {
				// e.preventDefault();
				// $('#inner-dropdown-content').toggle("show");
			    document.getElementById("inner-myDropdown").classList.toggle("show");
			}

			// Close the dropdown if the user clicks outside of it
			window.onclick = function(event) {
				// event.preventDefault();
				// alert(event.target)
			  if (!event.target.matches('.inner-dropbtn')) {

			    var dropdowns = document.getElementsByClassName("inner-dropdown-content");
			    var i;
			    for (i = 0; i < dropdowns.length; i++) {
			      var openDropdown = dropdowns[i];
			      if (openDropdown.classList.contains('show')) {
			        openDropdown.classList.remove('show');
			      }
			    }
			  }else{
			  	event.preventDefault();
			  }
			}
</script>