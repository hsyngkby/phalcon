<?php namespace Hsyngkby\Support\Bootstrap;

use Dotenv;
use InvalidArgumentException;
use Hsyngkby\Support\Application;

class DetectEnvironment {

    /**
     * Bootstrap the given application.
     *
     * @param  Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        Dotenv::load($app['path'], $app->environmentFile());

        $app->detectEnvironment(function()
        {
            return env('APP_ENV', 'production');
        });
    }

}