<?php

//Set 404 paths
Route::notFound(array(
    "controller" => "index",
    "action" => "route404"
));