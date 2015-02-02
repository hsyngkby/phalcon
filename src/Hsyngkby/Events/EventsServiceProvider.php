<?php namespace Hsyngkby\Events;

use Hsyngkby\Events\EventsRepository;
use Hsyngkby\Support\Application;
use Hsyngkby\Support\ServiceProvider;

class EventsServiceProvider extends ServiceProvider
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
        __l('[ServiceProvider] EventsServiceProvider : Register');

        $this->app->set('eventsManager', function(){
            __l('[ServiceProvider] EventsServiceProvider : set->eventsManager');
            return new EventsRepository();
        });
    }

    public static function loadConfig(Application $app)
    {
        __l('[ServiceProvider] EventsServiceProvider : LoadConfig');
        //$this->app->get('config')->loadConfigurationFiles($this->app, __DIR__ . '/config');
    }

    public static function loadHelper(Application $app)
    {
        __l('[ServiceProvider] EventsServiceProvider : loadHelper');
    }

    function boot()
    {
        __l('[ServiceProvider] EventsServiceProvider : Boot');
    }

    public function provides()
    {
        return [
            'eventsManager'
        ];
    }

}