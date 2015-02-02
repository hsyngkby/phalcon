<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Config\Repository;
use Hsyngkby\Support\Application;
use Illuminate\Filesystem\Filesystem;

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
            $filesystem = new Filesystem();
            $items = $filesystem->get($cached);
            $items = is_array($items) ? $items : json_decode($items,1);
            if (is_array($items)) {
                $loadedFromCache = TRUE;
            }else{
                $items = null;
            }
        }
        $app->instance('config', $config = new Repository($items));

        // Next we will spin through all of the configuration files in the configuration
        // directory and load each one into the repository. This will make all of the
        // options available to the developer for use in various parts of this app.
        if (!isset($loadedFromCache) || $app->getVariable('env')!='production') {
            $app->get('config')->loadConfigurationFiles($app);
        }

        date_default_timezone_set($config['app.timezone']);
    }


}
