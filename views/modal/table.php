<?php 

namespace Reusables;

$title = Data::getValue( $viewoptions, 'title' );

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
								"title" => $title,
								"c1" => [
									Table::make( "default", $identifier ),
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

?>