<?php
namespace Modules\BodyguardBOM\Http\Controllers\Parts;


trait PartNumberComponentsTrait {

    protected array $prefix = [
        "BGK" => "Kit",
        "BGC" => "Sub Component of a Kit",
    ];

    protected array $colours = [
        "WHT" => "White",
        "GRY" => "Malley Grey",
    ];

    protected array $roof_heights = [
        "NA" => "Not applicable",
        "HR" => "High Roof",
        "MR" => "Medium Roof",
        "LR" => "Low Roof",
    ];

}