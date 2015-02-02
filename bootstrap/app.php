<?php

$app = new Hsyngkby\Support\Application(
    realpath(__DIR__ . '/../')
);


if (!$app->hasBeenBootstrapped()) {
    $app->bootstrapWith(include __DIR__ . '/bootstrap.php');
}

//
////Set up the events manager to collect responses
////$app->get('eventsManager')->collectResponses(true);
//
////Attach a listener
//Events::attach('custom:custom', function ($event, $data) {
//    pre($data);
//});
//
////Attach a listener
//Events::attach('custom:custom', function ($event, $data) {
//    pre($data);
//});
//
////Fire the event
//Events::fire('custom:custom', $_SERVER);
//
//
//var_dump($app->get('eventsManager'));
//dd($app->get('dispatcher'));
////Get all the collected responses
////print_r($app->get('eventsManager')->getResponses());

return $app;
