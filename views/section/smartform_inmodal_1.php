<?php

namespace Reusables;

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
								"title" => $sectiondict['formtitle'],
								"c1" => [
									Section::make( "smartform_1", $identifier )
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