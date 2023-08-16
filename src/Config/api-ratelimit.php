<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Throttling Strategy
    |--------------------------------------------------------------------------
    |
    | Define the default throttling strategy to be used for rate limiting.
    | Available strategies: "token_bucket", "sliding_window"
    |
    */

    'default_strategy' => 'token_bucket',

    /*
    |--------------------------------------------------------------------------
    | Throttling Strategies
    |--------------------------------------------------------------------------
    |
    | Define the configuration for different throttling strategies.
    |
    */

    'strategies' => [
        
        'token_bucket' => [
            'capacity' => 100,          // Maximum tokens available in the bucket
            'rate' => 10,               // Tokens replenished per time window
            'time_window' => 60,        // Time window in seconds
        ],

        'sliding_window' => [
            'limit' => 100,             // Maximum requests allowed
            'interval' => 60,           // Time interval in seconds
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Excluded Endpoints
    |--------------------------------------------------------------------------
    |
    | Define endpoints that are excluded from rate limiting.
    |
    */

    'excluded_endpoints' => [
        'public/api/unlimited',
    ],

];
