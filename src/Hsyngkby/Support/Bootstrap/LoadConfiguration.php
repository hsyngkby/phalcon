<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Config\Repository;
use Symfony\Component\Finder\Finder;
use Hsyngkby\Support\Application;

class LoadConfiguration
{

    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $items = [];

        // First we will see if we have a cache configuration file. If we do, we'll load
        // the configuration items from that file so that it is very quick. Otherwise
        // we will need to spin through every configuration file and load them all.
        if (file_exists($cached = $app->getCachedConfigPath())) {
            $items = require $cached;
           // $items = is_array($items) ? $items : unserialize($items);
            $loadedFromCache = TRUE;
        }

        $app->instance('config', $config = new Repository($items));

        // Next we will spin through all of the configuration files in the configuration
        // directory and load each one into the repository. This will make all of the
        // options available to the developer for use in various parts of this app.
        if (!isset($loadedFromCache)) {
            $app->get('config')->loadConfigurationFiles($app);
        }

        date_default_timezone_set($config['app.timezone']);
    }


}
