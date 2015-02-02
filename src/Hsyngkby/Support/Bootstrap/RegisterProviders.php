<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Support\Facades\Facade;
use Hsyngkby\Support\AliasLoader;
use Hsyngkby\Support\Application;

class RegisterProviders {

    /**
     * Bootstrap the given application.
     *
     * @param  \Hsyngkby\Support\Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        __l('[Bootstrap] RegisterProviders');
        $app->registerConfiguredProviders();
    }

}