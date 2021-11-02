<?php

return [
    // cloudfront distribution name
    'distribution_name' => env('CLOUDFRONT_DISTRIBUTION_NAME', 'd2vb6hbl2rj3fc.cloudfront.net'),


    // for routing blueprint or index requests depending on the server.
    "external_domain" => env( "EXTERNAL_DOMAIN",  'blueprint.malleyindustries.com' ),
    "internal_domain" => env( "INTERNAL_DOMAIN",  'index.malleyindustries.com' ),


    "freight_verify_domain" => env("FORD_MILESTONE_DOMAIN", "https://test.api.freightverify.com"),
    "freight_verify_user" => env("FORD_MILESTONE_USER", ""),
    "freight_verify_pass" => env("FORD_MILESTONE_PASS", ""),
    "freight_verify_endpoint" => env("FORD_MILESTONE_ENDPOINT", ""),


];
