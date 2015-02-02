<?php namespace Hsyngkby\Cache;

use Hsyngkby\Support\Application;
use Hsyngkby\Support\ServiceProvider;
use Hsyngkby\Cache\CacheRepository;

class CacheServiceProvider extends ServiceProvider
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
        __l('[ServiceProvider] CacheServiceProvider : Register');
        $this->app->instance('cache', function () {
            __l('[ServiceProvider] CacheServiceProvider : instance->cache');
            $config = $this->app->get('config')['cache'];
            return new CacheRepository($this->app, $config);
        });
    }

    /*
        function frontCacheMsgpack($opt = [])
        {
            return new \Phalcon\Cache\Frontend\Msgpack($opt);
        }

        function frontCacheData($opt = [])
        {
            return new \Phalcon\Cache\Frontend\Data($opt);
        }

        function frontCacheIgbinary($opt = [])
        {
            return new \Phalcon\Cache\Frontend\Igbinary($opt);
        }

        function frontCacheBase64($opt = [])
        {
            return new \Phalcon\Cache\Frontend\Base64($opt);
        }

        function frontCacheJson($opt = [])
        {
            return new \Phalcon\Cache\Frontend\Json($opt);
        }

        function frontCacheOutput($opt = [])
        {
            return new \Phalcon\Cache\Frontend\Output($opt);
        }

        function frontCacheNone($opt = [])
        {
            return new \Phalcon\Cache\Frontend\None($opt);
        }

        function backendApc($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Apc($frontend, $opt);
        }

        function backendFile($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\File($frontend, $opt);
        }

        function backendLibmemcached($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Libmemcached($frontend, $opt);
        }

        function backendMemcache($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Memcache($frontend, $opt);
        }

        function backendMemory($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Memory($frontend, $opt);
        }

        function backendMango($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Mongo($frontend, $opt);
        }

        function backendRedis($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Redis($frontend, $opt);
        }

        function backendXcache($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Xcache($frontend, $opt);
        }

        function backendDatabase($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Database($frontend, $opt);
        }

        function backendWincache($frontend, $opt = [])
        {
            return new \Phalcon\Cache\Backend\Wincache($frontend, $opt);
        }*/

    public static function loadConfig(Application $app)
    {
        __l('[ServiceProvider] CacheServiceProvider : LoadConfig');
        $app->get('config')->loadConfigurationFiles($app, __DIR__ . '/config');
    }

    public static function loadHelper(Application $app)
    {
        __l('[ServiceProvider] CacheServiceProvider : loadHelper');
    }

    function boot()
    {
        __l('[ServiceProvider] CacheServiceProvider : Boot');
    }

    public function provides()
    {
        return [
            'cache', 'cache.store', 'memcached.connector', 'command.cache.clear', 'command.cache.table'
        ];
    }


}
