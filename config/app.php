<?php

return [
    'timezone' => 'UTC',//Europe/Istanbul

    'security' => [
        'key' => env('SECURITY_KEY', md5('Secret Key')),
        'mode' => env('SECURITY_MODE', 'cbc'),
        'chipher' => env('SECURITY_CHIPHER', 'rijndael-256'),
        'padding' => env('SECURITY_PADDING', '0'),
    ],

    'providers' => [
        //Config - Log System Provider olarak tanımlı
        'Hsyngkby\Cache\CacheServiceProvider',
        'Hsyngkby\Events\EventsServiceProvider',
        'Hsyngkby\Database\DatabaseServiceProvider',
        'Hsyngkby\Cookie\CookieServiceProvider',
        'Hsyngkby\Session\SessionServiceProvider',
        'Hsyngkby\Router\RouterServiceProvider',
    ],

    'aliases' => [
        'Config' => 'Hsyngkby\Support\Facades\Config',
        'Log' => 'Hsyngkby\Support\Facades\Log',
        'Cache' => 'Hsyngkby\Support\Facades\Cache',
        'Events' => 'Hsyngkby\Support\Facades\Events',
        'Route' => 'Hsyngkby\Support\Facades\Route',
    ]
];