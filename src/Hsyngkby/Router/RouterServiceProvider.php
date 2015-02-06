<?php namespace Hsyngkby\Router;

use Hsyngkby\Support\Application;
use Hsyngkby\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

class RouterServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = TRUE;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        __l('[ServiceProvider] RouterServiceProvider : Register');

        $this->app->set('router', function () {
            $router = new \Phalcon\Mvc\Router(false);

            return $router;
        });

        $directory = $this->app->get('config')['router.route_files_dir'];
        $files = [];
        foreach (Finder::create()->files()->name('*.php')->in($directory) as $file) {
            include $file->getRealPath();
        }
    }

    public static function loadConfig(Application $app)
    {
        __l('[ServiceProvider] RouterServiceProvider : LoadConfig');
        $app->get('config')->loadConfigurationFiles($app, __DIR__ . '/config');
    }

    public static function loadHelper(Application $app)
    {
        __l('[ServiceProvider] RouterServiceProvider : loadHelper');
    }

    function boot()
    {
        __l('[ServiceProvider] RouterServiceProvider : Boot');
    }

    public function provides()
    {
        return [
            'router'
        ];
    }

}