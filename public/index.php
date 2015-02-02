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


//    $app->make('cookies')->set('deneme','asdas123',time()+100);
//
//    $app->make('cookies')->set('deneme1','3',time() + 15 * 86400);

    dd($app->get('cookies')->get('deneme')->getValue());

} catch (\Phalcon\Exception $e) {
    //Hata olduğunda ekrana bas
    echo $e->getMessage();
}