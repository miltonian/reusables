<?php

namespace Reusables\CustomView;

extract( \Reusables\CustomView::makeFormVars( $customviewdict ) );
	
?>


<style>
</style>

<div class="<?php echo $identifier ?> form_simple_1 main">
	<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
		<input type="hidden" name="goto" value="userprofile">
			<?php 

				echo \Reusables\Structure::make( 
					"structure_2",
					[
						"maincolumn" => array(
							\Reusables\Input::make( 
								"textfield", 
								[
									"placeholder"=>"Title",
									"labeltext"=>"Title",
									"field_value"=>"",
									"field_index"=>1,
									"field_table"=>$default_tablename,
									"field_colname"=>"title",
									"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['title'] )
								], 
								"title_input"
							)
						)
					],
					"main_structure"
				);
			
			?>
		<button class="modalinner_1 save custombutton">Save</button>
	</div>
</div>
<script>

	var customviewdict = <?php echo json_encode($customviewdict) ?>;
	var dataarray = <?php echo json_encode( \Reusables\Data::getFullArray( $customviewdict ) ) ?>;
	var identifier = "<?php echo $identifier ?>";

	class <?php echo $identifier ?>Classes {
		populateview(index=null){
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "title", "title_input", "title", null );

		}
	}

	if(<?php echo $identifier ?> !== undefined || <?php echo $identifier ?> !== null) {
		let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
		<?php echo $identifier ?>.populateview();
	}


</script>
	
