<?php

return [
    'assets' => [
        'minify' => [
            'filters' => [
                "ImportImports"					=> true,
                "RemoveComments"				=> true,
                "RemoveEmptyRulesets"			=> true,
                "RemoveEmptyAtBlocks"			=> true,
                'ConvertLevel3Properties'       => true,
                'ConvertLevel3AtKeyframes'      => true,
                "Variables"						=> true,
                "RemoveLastDelarationSemiColon"	=> true
            ],
            'plugins' => [
                "Variables"						=> true,
                "ConvertFontWeight"				=> true,
                "ConvertHslColors"				=> true,
                "ConvertRgbColors"				=> true,
                "ConvertNamedColors"			=> true,
                "CompressColorValues"			=> true,
                "CompressUnitValues"			=> true,
                "CompressExpressionValues"		=> true
            ]
        ],
        'optimize' => [
            'jpegoptim_options' => [
                '--strip-all',
                '--all-progressive'
            ],
            'optipng_options' => [
                '-o7',
                '-strip all'
            ],
            'gifsicle_options' => [
                '-O3'
            ]
        ]
    ]
];