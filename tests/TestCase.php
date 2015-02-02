<?php

class TestCase extends \Hsyngkby\Testing\TestCase
{

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        return $app;
    }

}