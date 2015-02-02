<?php

$app = new Hsyngkby\Support\Application(
    realpath(__DIR__ . '/../')
);

if (!$app->hasBeenBootstrapped()) {
    $app->bootstrapWith(include __DIR__ . '/bootstrap.php');
}

return $app;
