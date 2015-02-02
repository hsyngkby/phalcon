<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Support\Facades\Facade;
use Hsyngkby\Support\AliasLoader;
use Hsyngkby\Support\Application;

class RegisterFacades {

    /**
     * Bootstrap the given application.
     *
     * @param  \Hsyngkby\Support\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        Facade::clearResolvedInstances();

        Facade::setFacadeApplication($app);

        AliasLoader::getInstance($app->get('config')['app.aliases'])->register();
    }

}