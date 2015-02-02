<?php
//Start Time
define('START_TIME', microtime(TRUE));

//Composer Autoloader
include __DIR__ . '/../vendor/autoload.php';

$compiledPath = __DIR__.'/../storage/framework/compiled.php';

if (file_exists($compiledPath))
{
    require $compiledPath;
}