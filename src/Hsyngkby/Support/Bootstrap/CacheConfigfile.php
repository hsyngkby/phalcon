<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Support\Application;
use Illuminate\Filesystem\Filesystem;

class CacheConfigFile
{

    /**
     * Bootstrap the given application.
     *
     * @param  \Hsyngkby\Support\Application $app
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        if ($app->getVariable('env') === 'production') return;

        $filesystem = new Filesystem();
        $file = $app->storagePath() . '/framework/config.php';
        $data = $app->get('config')->toArray();
        $data['last_cached_time'] = date('d.m.Y H:i:s');

        $data = json_encode($data);

        if (!$filesystem->exists($file)) {
            $filesystem->put($file, $data);
        } else {
            $filesystem->delete($file);
            $filesystem->put( $file, $data );
        }

    }

}