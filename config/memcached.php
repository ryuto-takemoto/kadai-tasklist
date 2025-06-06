<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Memcached Servers
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Memcached servers. You will have multiple
    | servers in a single group, allowing you to spread the load.
    |
    */

    'servers' => [
        [
            'host' => env('MEMCACHED_HOST', '127.0.0.1'),
            'port' => env('MEMCACHED_PORT', 11211),
            'weight' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | SASL Authentication Options
    |--------------------------------------------------------------------------
    |
    | If you are connecting to a Memcached server that requires authentication,
    | you will need to configure your username and password below. This will
    | be used when establishing a connection to the server.
    |
    */

    'options' => [
        // Memcached::OPT_CONNECT_TIMEOUT  => 2000,
    ],

];