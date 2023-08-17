<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Throttling Strategy
    |--------------------------------------------------------------------------
    |
    | Define the default throttling strategy to be used for rate limiting.
    | Available strategies: "token_bucket", "sliding_window", "my_custom_strategy"
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
            'capacity' => 100,
            'rate' => 10,
            'time_window' => 60,
        ],
        'sliding_window' => [
            'limit' => 100,
            'interval' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Throttling Strategies
    |--------------------------------------------------------------------------
    |
    | Define custom throttling strategies along with their parameters.
    |
    */

    'custom_strategies' => [
        'my_custom_strategy' => [
            'param1' => 'value1',
            'param2' => 'value2',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Rate Limit
    |--------------------------------------------------------------------------
    |
    | Set a global rate limit that applies to all endpoints.
    |
    */

    'global_rate_limit' => [
        'limit' => 200,
        'interval' => 3600, // 1 hour
    ],

    /*
    |--------------------------------------------------------------------------
    | Different Strategies per Endpoint
    |--------------------------------------------------------------------------
    |
    | Set different throttling strategies for specific endpoints.
    |
    */

    'endpoint_strategies' => [
        'public/api/unlimited' => 'no_limit',
        'api/posts' => 'token_bucket',
    ],

    /*
    |--------------------------------------------------------------------------
    | Dynamic Configuration Loading
    |--------------------------------------------------------------------------
    |
    | Load configuration settings dynamically.
    |
    */

    'dynamic_configuration' => true,

    /*
    |--------------------------------------------------------------------------
    | Custom Headers
    |--------------------------------------------------------------------------
    |
    | Customize rate limit header names in the API response.
    |
    */

    'response_headers' => [
        'limit_header' => 'X-Custom-Limit',
        'remaining_header' => 'X-Custom-Remaining',
        'reset_header' => 'X-Custom-Reset',
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging and Notifications
    |--------------------------------------------------------------------------
    |
    | Enable logging and notifications for exceeded rate limits.
    |
    */

    'logging' => true,
    'notifications' => true,

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
