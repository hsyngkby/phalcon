<?php
return [
    'adapters' => [
        'file_adapter'   => [
            'enable' => TRUE,
            'file'   => "logs/app.log" //herzaman storage altına kayıt yapar.
        ],
        'stream_adapter' => [
            'enable' => FALSE,
            'stream' => 'php://stdout'
        ],
        'firephp'        => [
            'enable' => FALSE,
        ],
    ],
];