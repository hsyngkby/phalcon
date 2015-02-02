<?php namespace Hsyngkby\Cookie;

use Hsyngkby\Support\Application;
use Hsyngkby\Support\ServiceProvider;

class CookieServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = TRUE;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        __l('[ServiceProvider] CookieServiceProvider : Register');
        $this->app->set('cookies', function () {
            __l('[ServiceProvider] CookieServiceProvider : set->cookies');

            $cookies = new \Phalcon\Http\Response\Cookies();
            $cookies->useEncryption($this->app->get('config')['cookie.useEncryption']);

            return new CookieProvider($this->app, $cookies);
        });
    }

    public static function loadConfig(Application $app)
    {
        __l('[ServiceProvider] CookieServiceProvider : LoadConfig');
        $app->get('config')->loadConfigurationFiles($app, __DIR__ . '/config');
    }

    public static function loadHelper(Application $app)
    {
        __l('[ServiceProvider] CookieServiceProvider : loadHelper');
    }

    function boot()
    {
        __l('[ServiceProvider] CookieServiceProvider : Boot');
    }

    public function provides()
    {
        return [
            'cookies'
        ];
    }


}
