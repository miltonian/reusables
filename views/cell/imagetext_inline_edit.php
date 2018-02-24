<?php

namespace Reusables;

	// cell for admin side

	// $viewdict

// exit( json_encode( Data::getValue( $identifier ) ) );

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

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "index", "description", "celldate", "celltype", "slug", "actions" ], 
		[],
		$identifier
	);

?>
<script>
	var viewdict = <?php echo json_encode( Data::getValue( $identifier ) ) ?>;
</script>
<?php

// ReusableClasses::checkRequired( $identifier, $viewdict, $required );
	
	$cellactionshtml = "";
	if( isset( $viewoptions['actions'] ) ){
		$cellactionshtml .= "<div class='imagetext_inline_edit actions-div'>";
		$i=0;
		foreach ( $viewoptions['actions'] as $action ) {
			$actiontype = Data::getValue( $action, 'type' );
			if( $actiontype == "link" ) {
				$linkpath = Data::getValue( $action, 'link' ) . Data::getValue( $viewdict, 'slug' );
				$cellactionshtml .= "<a href='" . $linkpath . "' target='_blank'><button id='" . Data::getValue( $viewdict, 'index' ) . "' class='imagetext_inline_edit action actionindex_" . $i . " index_" . $cellindex . "' style='background-image: url(" . $action['backgroundimage'] . ");'></button></a>";
			}else if( $actiontype == "dropdown" ){
				$cellactionshtml .= "<div class='dropdown'>";
					$cellactionshtml .= "<div class='inner-dropdown'>";
						$cellactionshtml .= "<button class='inner-dropbtn imagetext_inline_edit action actionindex_" . $i . " index_" . $cellindex . "' style='background-image: url(" . $action['backgroundimage'] . ");'></button>";
						$cellactionshtml .= "<div id='inner-myDropdown_" . Data::getValue( $viewdict, 'index' ) . "' class='inner-dropdown-content'>";
							for ($a=0; $a < sizeof( $action['actions'] ); $a++) {
								$dropdownarray = $action['actions'];
								$linkpath = Data::getValue( $dropdownarray[$a], 'link' );
								// if( $linkpath == "" ){ $linkpath = "#"; }
								$cellactionshtml .= "<a class='dropdown_action cellactionindex_" . $i . " dropdownindex_" . $a . " index_" . $cellindex . "' href='" . $linkpath . "'><img class='dropdownimg' src='" . Data::getValue( $dropdownarray[$a], 'imagepath' ) . "'><label class='dropdownlabel'>" . $dropdownarray[$a]['text'] . "</label></a>";
								// exit( json_encode( $action['actions'] ) );
								echo "<script>";
									ReusableClasses::getDropdownFunctionsJS( $dropdownarray );
								echo "</script>";
								// script
								// echo "<script> alert( JSON.stringify( $('.inner-dropbtn.imagetext_inline_edit.action.actionindex_" . $i . " index_" . $cellindex . " .dropdown_action.actionindex_" . $i . "') ) ) </script>";
								// $cellactionshtml .= "<script> Reusable.addAction( $('.inner-dropbtn.imagetext_inline_edit.action.actionindex_" . $i . " index_" . $cellindex . " .dropdown_action.actionindex_" . $i . "'), dropdownfunctions, " . $i . ", " . json_encode( $dropdownarray ) . ", null, null ) </script>";
							}
						$cellactionshtml .= "</div>";
					$cellactionshtml .= "</div>";
				$cellactionshtml .= "</div>";

				

				// Data::addData( ["list" => $action['dropdown_array']], $identifier . "dropdown" );
				// Menu::make( "dropdown", $identifier . "dropdown" );
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
						$cellactionshtml,
						"<img class='imagetext_inline_edit drag_icon' src='/vendor/miltonian/reusables/images/icons/drag_reorder_gray-2.png'>"
					),
				], $identifier."-structure")
			),
			$identifier."-wrapper"
		);

		echo "</div>";
	?>

<script>

	var cellactions = <?php echo json_encode( $viewoptions['actions'] ) ?>;

	

	<?php 
		ReusableClasses::getEditingFunctionsJS( $viewoptions ) 
	?>;

	function imagetext_inline_edit_start() {
		imagetext_inline_edit.setupactions( cellactions, editingfunctions, viewdict );

		$('.inner-dropbtn.imagetext_inline_edit.action').click(function(){

			var cellindex = Reusable.getIndexFromClass( "index_", this)
			// CHECK AGAIN
			var dropdowns = document.getElementsByClassName("inner-dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
			document.getElementById("inner-myDropdown_"+cellindex).classList.toggle("show");
		});
	}

	function dropdownaction(e) {
		// e.preventDefault();

		document.getElementById("inner-myDropdown").classList.toggle("show");
	}

	// window.onclick = function(e) {
	$(window).click(function(e){
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
	})
</script>