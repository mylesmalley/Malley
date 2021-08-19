<?php

return [
    // cloudfront distribution name
    'distribution_name' => env('CLOUDFRONT_DISTRIBUTION_NAME', 'd2vb6hbl2rj3fc.cloudfront.net'),


    // for routing blueprint or index requests depending on the server.
    "external_domain" => env( "EXTERNAL_DOMAIN",  'blueprint.malleyindustries.com' ),
    "internal_domain" => env( "INTERNAL_DOMAIN",  'index.malleyindustries.com' ),
];
