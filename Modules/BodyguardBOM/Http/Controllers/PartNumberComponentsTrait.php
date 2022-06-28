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

    /**
     * @param string|null $color_key
     * @return mixed|string
     */
    public function get_colour_by_key( ?string $color_key )
    {
        return $this->colours[ $color_key ] ?? "Not Set";
    }


    /**
     * @var array
     */
    protected array $roof_heights = [
        "ALL" => "Not applicable",
        "HR" => "High Roof",
        "MR" => "Medium Roof",
        "LR" => "Low Roof",
    ];


    /**
     * @param string|null $key
     * @return string
     */
    public function get_roof_height_by_key( ?string $key ): string
    {
        return $this->roof_heights[ $key ] ?? "Not Set";
    }


    /**
     * @var array
     */
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
                'ext' => "Contains a single sheet of moulded ABS Plastic with the potential of a stiffening metal rib, a bottom metal floor bracket. Does not contain a window",
                'template' => [
                    'parts' =>
                        [
                            [
                                'description' => 'Partition panel',
                                'kit_code' => 'PAR',
                            ],
                            [
                                'description' => 'Other type of part',
                                'kit_code' => 'OTH',
                            ]
                        ]
                    ],
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
                'ext' => "Contains a complete set of moulded ABS Plastic sheets to cover the Driver and Passenger side walls. Windows are not cut out",
                'template' => [
                    'parts' =>
                        [
                            [
                                'description' => 'Driver Side Panel (Rear)',
                                'kit_code' => 'WLC',
                            ],
                            [
                                'description' => 'Driver Side Panel (Front toward Cab)',
                                'kit_code' => 'WLC',
                            ],
                            [
                                'description' => 'Passenger Side Panel',
                                'kit_code' => 'WLC',
                            ],
                        ]
                    ],

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


    /**
     * @param string|null $kit_code
     * @return string
     */
    public function get_kit_code_description( ?string $kit_code ): string
    {
        return $this->kit_codes[ $kit_code ]['desc'] ?? "Not Set";
    }





    /**
     * @var array
     */
    protected array $chassis = [
        "Ford Transit" => [
            "FTRALL" => "Any wheelbase",
            "FTR130STD" => '130" regular wheelbase',
            "FTR148STD" => '148" regular wheelbase',
            "FTR148EXT" => '148" extended wheelbase',
        ],
        "Ford Transit Connect (2014)" => [
            "2014FTCALL" => "Any wheelbase",
            "2014FTC105" => "Short wheelbase",
            "2014FTC121" => "Long wheelbase",
        ]
//        'Ram ProMaster' => [
//
//        ]
    ];


    /**
     * @param string $string
     * @return string
     */
    protected function get_chassis_by_key( string $string ): string
    {
        $flat_array_of_chassis = [];

        foreach( $this->chassis as $key => $sub )
        {

            // gets the parent key and prepends it to the final description.
            // array_walk modifies an existing array whereas array_map returns a new one.
            array_walk( $sub, function(&$el) use ($key){
                $el = "$key, $el";
            });

            $flat_array_of_chassis += $sub;
        }

        return $flat_array_of_chassis[ $string ];
    }




    protected array $part_codes = [
        "TRD" => ['desc' => "Trim Piece",
                'ext' => ''],
        "WLC" => ['desc' =>"Wall Liner Cargo Panel",  'ext' => ''],
        "WLE" => ['desc' =>"Wall Liner with E-Track Panel",
                'ext' => ''],
        "WLW" => ['desc' =>"Wall Liner with Window Cutout Panel",
                'ext' => ''],
        "CEI" => ['desc' =>"Ceiling Piece",
                'ext' => ''],
        "WIN" => ['desc' =>"Window Panel",
                'ext' => ''],
        "PAR" => ['desc' =>"Partition Panel",
                'ext' => ''],
        "OTH" => ['desc' =>"Other type of part",
                'ext' => ''],
    ];


    /**
     * @var array
     */
    protected array $part_locations = [
        "Driver Side" => [
            "DSA" => "Full length",
            "DSF" => "Front (toward cab)",
            "DSR" => "Rear ",
        ],
        "Passenger Side" => [
            "PSA" => "Full length",
            "PSF" => "Front (toward cab)",
            "PSR" => "Rear ",
        ],
        'Partition' => [
            'PAA' => "Full width",
            "PAD" => "Driver Side",
            "PAC" => "Centre",
            "PAP" => "Passenger side",
        ]
    ];


    /**
     * @param string|null $string $string
     * @return string
     */
    protected function get_part_location_by_key( ?string $string ): string
    {
        $flat_array_of_part_locations = [];

        foreach( $this->part_locations as $key => $sub )
        {

            array_walk( $sub, function(&$el) use ($key){
                $el = "$key, $el";
            });

            $flat_array_of_part_locations += $sub;
        }

        return $flat_array_of_part_locations[ $string ] ?? "Not Applicable";
    }


}