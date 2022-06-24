<?php
namespace Modules\BodyguardBOM\Http\Controllers;


trait PartNumberComponentsTrait {

    protected array $prefix = [
        "BGK" => "Kit",
        "BGC" => "Sub Component of a Kit",
    ];

    protected array $colours = [
        "WHT" => "White",
        "GRY" => "Malley Grey",
        "YLW" => "Yellow",
        "GRN" => "Green",
        "BLU" => "Blue",
        "BLK" => "Black",
    ];

    protected array $roof_heights = [
        "ALL" => "Not applicable",
        "HR" => "High Roof",
        "MR" => "Medium Roof",
        "LR" => "Low Roof",
    ];


    protected array $kit_codes = [
        'C1D' => [
                'desc' => '1 Piece ceiling with dome light',
                'ext' => "Contains a single sheet of moulded ABS Plastic with dome light holes cut out. Does not contain lights, default 2 holes, can be changed by special request"
            ],
        'C1S' => [
                'desc' => '1 piece ceiling without dome light',
                'ext' => "Contains a single sheet of moulded ABS Plastic without dome light cut-out"
            ],
        'C2D' => [
                'desc' => '2 piece ceiling with dome light',
                'ext' => "Contains 2 sheets of moulded ABS Plastic (one with a expanded overlap to hide the seam) with dome light holes cut out. Does not contain lights, default 2 holes, can be changed by special request"
            ],
        'C2S' => [
                'desc' => '2 piece ceiling with without light',
                'ext' => "Contains 2 sheets of moulded ABS Plastic (one with a expanded overlap to hide the seam) without dome light cut-outs."
            ],
        'C3D' => [
                'desc' => '3 piece ceiling with dome light',
                'ext' => "Contains 3 sheets of moulded ABS Plastic (one with a expanded overlap to hide the seam) with dome light holes cut out. Does not contain lights, default 2 holes, can be changed by special request."
                ],
        'C3S' => [
                'desc' => '3 piece ceiling without dome light',
                'ext' => "Contains 3 sheets of moulded ABS Plastic (one with a expanded overlap to hide the seam) without dome light cut-outs."
            ],
        'DOS' => [
                'desc' => 'door panel kit with sliding doors',
                'ext' => "Contains 3 to 5 sheets of CNC'd ABS Plastic to cover access holes in the sliding and rear driver/passenger side doors"
            ],
        'PAS' => [
                'desc' => 'solid partition',
                'ext' => "Contains a single sheet of moulded ABS Plastic with the potential of a stiffening metal rib, a bottom metal floor bracket. Does not contain a window"
            ],
        'PDS' => [
                'desc' => 'solid partition with door',
                'ext' => "Contains a single sheet of moulded ABS Plastic with the potential of a stiffening metal rib, a bottom metal floor bracket, a door and supporting hardware,  without a window"
            ],
        'PDW' => [
                'desc' => 'window partition with door',
                'ext' => "Contains a single sheet of moulded ABS Plastic with the potential of a stiffening metal rib, a bottom metal floor bracket, a door and supporting hardware, with a window"
            ],
        'PAW' => [
                'desc' => 'window partition',
                'ext' => "Contains a single sheet of moulded ABS Plastic with the potential of a stiffening metal rib, a bottom metal floor bracket. Is fitted with a window"
            ],
        'TRD' => [
                'desc' => 'trim for around the rear doors ',
                'ext' => "Contains one to two moulded ABS plastic sheets per door, that attach around the rear door windows. Some High Roof vehicles will be supplied with additional extended door trim."
            ],
        'TWS' => [
                'desc' => 'for for above doors on a van with a sliding door',
                'ext' => "Contains several moulded ABS Plastic pieces that bridge the gap from the wall to the ceiling. This can include the Driver side (DS Front, RS Rear), above the rear doors, the passenger side and cab. For a single sliding passenger door"
            ],
        'TWD' => [
                'desc' => 'trim for above doors on a van with two sliding doors',
                'ext' => "Contains several moulded ABS Plastic pieces that bridge the gap from the wall to the ceiling. This can include the Driver side (DS Front, RS Rear), above the rear doors, the passenger side and cab. For double sliding doors"
            ],
        'WLC' => [
                'desc' => 'wall liner',
                'ext' => "Contains a complete set of moulded ABS Plastic sheets to cover the Driver and Passenger side walls. Windows are not cut out"
            ],
        'WLE' => [
                'desc' => 'wall liner with E-Track',
                'ext' => "Contains a complete set of moulded ABS Plastic sheets to cover the Driver and Passenger side walls. Windows are not cut out, and brackets and E-Track are included"
            ],
        'WLW' => [
                'desc' => 'wall liner with windows',
                'ext' => "Contains a complete set of moulded ABS Plastic sheets to cover the Driver and Passenger side walls. Windows are cut out"
        ],
    ];



    protected array $chassis = [
        "Ford Transit" => [
            "FTR" => "Any wheelbase",
            "FTR130STD" => '130" regular wheelbase',
            "FTR148STD" => '148" regular wheelbase',
            "FTR148EXT" => '148" extended wheelbase',
        ],
//        'Ram ProMaster' => [
//
//        ]
    ];




    protected array $part_codes = [
        "TRD" => "Trim Piece",
        "WLC" => "Wall Liner Cargo Panel",
        "WLE" => "Wall Liner with E-Track Panel",
        "WLW" => "Wall Liner with Window Cutout Panel",
        "CEI" => "Ceiling Piece",
        "WIN" => "Window Panel",
        "PAR" => "Partition Panel",
        "OTH" => "Other type of part",
    ];


}