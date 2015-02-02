<?php

//Sistemin Autoload'unu yükle
$loader = require __DIR__ . '/../bootstrap/autoload.php';

try {

    //application'i yükle
    $app = require_once __DIR__ . '/../bootstrap/app.php';

//    $app->get('cache');
//    $app->get('eventsManager');
//    $app->get('cache');
//    $app->get('eventsManager');
//
//    //işlem bitti ekrana cıktıyı bas
//    echo $app->handle()->getContent();

dd(Config::get());


} catch (\Phalcon\Exception $e) {
    //Hata olduğunda ekrana bas
    echo $e->getMessage();
}