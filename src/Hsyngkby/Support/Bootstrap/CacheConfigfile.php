<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Support\Application;
use Illuminate\Filesystem\Filesystem;

class CacheConfigfile
{

    /**
     * Bootstrap the given application.
     *
     * @param  \Hsyngkby\Support\Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $file = new Filesystem();
        $file->put($app->storagePath() . '/framework/config.php', serialize($app->get('config')->toArray()));
    }

}