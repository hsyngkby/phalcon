<?php
return [
    /**
     * File
     * Database
     * Memcache
     * Mongo
     * Redis
     * HandlerSocket
     */

    'adapter'       => 'File',

    'file'          => [
        'uniqueId' => 'hsyngkby',
    ],
    'database'      => [
        'table'    => 'session_data'
    ],
    'memcache'      => [
        'host'       => env('MC_HOST', '127.0.0.1'),
        'port'       => env('MC_PORT', 11211),
        'lifetime'   => 8600,
        'prefix'     => env('MC_PREFIX', NULL),
        'persistent' => env('MC_PERSISTENT', FALSE),
    ],
    /**
     * @todo Serverda Mongo yoktu erteledim sonra yapacağım.
     */
    'mongo'         => [
        'server' => env('MG_SERVER', "mongodb://localhost"),
    ],
    'redis'         => [
        'host' => env('RDS_HOST', '127.0.0.1'),
        'port' => env('RDS_PORT', 6379)
    ],
    /**
     * @todo Yapılacak
     */
    'handlersocket' => [

    ]
];