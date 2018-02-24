<?php

namespace Reusables;

?>

<style>
	.<?php echo $identifier ?>_wrapper.main { max-width: 700px; max-height: 600px; top: 50%; transform: translateY(-50%); }
</style>

<?php

	echo Structure::make(
		"modal_background",
		[
			"maincolumn"=>[
				Wrapper::wrapper1(
					[],
					[
						Structure::make(
							"main_with_hidden",
							[
								"title" => Data::getValue( $viewdict, 'formtitle' ),
								"c1" => [
									Section::make( "picker_form", $identifier )
								],
							],
							$identifier . "_internalstructure"
						)
					],
					$identifier . "_wrapper"
				)
			]
		],
		$identifier . "_modalbackground"
	);