<?php
//Setting a specific default
Route::setDefaultModule('backend');
Route::setDefaultNamespace('Backend\Controllers');
Route::setDefaultController('index');
Route::setDefaultAction('index');

//Using an array
Route::setDefaults(array(
    'controller' => 'index',
    'action' => 'index'
));