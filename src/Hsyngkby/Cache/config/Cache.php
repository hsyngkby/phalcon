<?php

return [
    //cache dosyasının içindeki format
    'frontend' => 'Json',

    //cache tutacak sistem
    'backend' => 'File',

    'frontend_modules' => [

//        /**
//         * https://github.com/msgpack/msgpack-php
//         * yukaridaki modulu php ye kurmak gerekiyor.
//         * detaylı bilgide linkte var.
//         */
        'Msgpack' => [
            'lifetime' => 86400
        ],

//        /**
//         * It’s used to cache any kind of PHP data (big arrays, objects, text, etc). Data is serialized before stored in the backend.
//         */
        'Data' => [
            'lifetime' => 86400
        ],

//        /**
//         * https://github.com/igbinary/igbinary
//         * yukaridaki modulu php ye kurmak gerekiyor.
//         * detaylı bilgide linkte var.
//         */
        'Igbinary' => [
            'lifetime' => 86400
        ],

//        /**
//         * It’s used to cache binary data. The data is serialized using base64_encode before be stored in the backend.
//         * Sadece String Kabul Ediyor.
//         */
        'Base64' => [
            'lifetime' => 86400
        ],

//        /**
//         * Data is encoded in JSON before be stored in the backend. Decoded after be retrieved. This frontend is useful to share data with other languages or frameworks.
//         */
        'Json' => [
            'lifetime' => 86400
        ],

//        /**
//         * Read input data from standard PHP output
//         * kullanım şekli http://docs.phalconphp.com/en/latest/api/Phalcon_Cache_Frontend_Output.html
//         *
//         * $content = $cache->start("my-cache.html");
//         * echo date("r");
//         * $cache->save();
//         *
//         */
        'Output' => [
            'lifetime' => 86400
        ],

//        /**
//         * It’s used to cache any kind of PHP data without serializing them.
//         * http://docs.phalconphp.com/en/latest/reference/cache.html#frontend-adapters
//         */
        'None' => [
            'lifetime' => 86400
        ],
    ],

    'backend_modules' => [
//        /**
//         * Stores data to local plain files
//         * http://docs.phalconphp.com/en/latest/api/Phalcon_Cache_Backend_File.html
//         */
        /**
         * @todo File da expire olmuyor.
         */
        'File' => [
            'prefix' => null,
            'cacheDir' => STORAGE_PATH . '/framework/cache/',
        ],

//        /**
//         * Stores data to a memcached server
//         * http://docs.phalconphp.com/en/latest/api/Phalcon_Cache_Backend_Memcache.html
//         * sistemde memcached oluyor ama memcache olmuyo bazen onun için dikkat etmek gerekir.
//         *
//         * sudo apt-get install php5-memcache
//         */
        'Memcache' => [
            'prefix' => null,
            'host' => '127.0.0.1',
            'port' => 11211,
            'persistent' => false,
            'statsKey' => '_PHCM'
        ],

//        /**
//         * Stores data to the Alternative PHP Cache (APC)
//         * http://docs.phalconphp.com/en/latest/api/Phalcon_Cache_Backend_Apc.html
//         *
//         */
        /**
         * @todo increment decrement Expire işlemleri çalışmadı
         */
        'Apc' => [
            'prefix' => null,
        ],

//        /**
//         * Stores data to Mongo Database
//         * http://docs.phalconphp.com/en/latest/api/Phalcon_Cache_Backend_Mongo.html
//         *
//         * http://docs.mongodb.org/manual/tutorial/install-mongodb-on-ubuntu/
//         * sudo pecl install mongo  ve ini dosyası ayarları
//         */
        'Mongo' => [
            'prefix' => null,
            'server' => "mongodb://localhost",
            'db' => "caches",
            'collection' => "images"
        ],

//        /**
//         * Stores data in XCache
//         * http://docs.phalconphp.com/en/latest/api/Phalcon_Cache_Backend_Xcache.html
//         * Kurulu gelmiyor. kurmak ve ayarlamak lazım.
//         * Aynı APC gibi.
//         */
        'Xcache' => [
            'prefix' => null,
        ],

        /**
         * @todo database cache için ilk once database modulunu yazıp ayarlamam lazım.
         */
        'Database' => [
            'db' => 'current_db_connection',
            'table' => 'cache_data'
        ],

//        /**
//         * https://github.com/phalcon/incubator/tree/master/Library/Phalcon/Cache/Backend
//         */
        /**
         * @todo increment decrement Functionları Class içinde yok
         */
        'Redis' => [
            'host' => '127.0.0.1',
            'port' => 6379
        ],

//        /**
//         * https://github.com/phalcon/incubator/tree/master/Library/Phalcon/Cache/Backend
//         * Aslın "Memcached" kütüphanesi
//         */
        'Libmemcached' => [
            'tracking' => true,
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'post' => '11211',
                    'weight' => 1
                ]
            ],
            'statsKey' => '_PHCM'
        ],
        /**
         * Class kendi içinde RAM de tutuyor.
         * @todo queryKeys işlem out of memory hatasına yol açıyor.
         * @todo Expire işlemi olmuyor.
         */
        'Memory' => [
        ],

        /**
         * Sadece Windows Serverlarda çalışır.
         * http://php.net/manual/en/wincache.requirements.php
         * @todo Windows server olmadığı için test edemedim.
         */
        'Wincache' => [
        ],
    ]
];