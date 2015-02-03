<?php namespace Hsyngkby\Session;

use Hsyngkby\Support\Application;
use Hsyngkby\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
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
        __l('[ServiceProvider] SessionServiceProvider : Register');

        $this->registerFlashSession();
        $this->registerSessionAdapters();
        $this->registerSession();
    }

    public function registerSessionAdapters()
    {
        $config = $this->app->get('config')['session'];

        $this->app->instance('session.file', function () use ($config) {
            __l('[ServiceProvider] SessionServiceProvider : set->session FILE ADAPTER');
            $session = new \Phalcon\Session\Adapter\Files([
                'uniqueId' => $config['file']['uniqueId'],
            ]);

            return $session;
        });

        $this->app->instance('session.database', function () use ($config) {
            __l('[ServiceProvider] SessionServiceProvider : set->session DATABASE ADAPTER');
            $session = new \Phalcon\Session\Adapter\Database([
                'db'    => $this->app->get('db'),
                'table' => $config['database']['table'],
            ]);

            return $session;
        });

        $this->app->instance('session.memcache', function () use ($config) {
            __l('[ServiceProvider] SessionServiceProvider : set->session MEMCACHE ADAPTER');
            $session = new \Phalcon\Session\Adapter\Memcache([
                'host'       => $config['memcache']['host'],        // mandatory
                'port'       => $config['memcache']['port'],        // optional (standard: 11211)
                'lifetime'   => $config['memcache']['lifetime'],    // optional (standard: 8600)
                'prefix'     => $config['memcache']['prefix'],      // optional (standard: [empty_string]), means memcache key is my-app_31231jkfsdfdsfds3
                'persistent' => $config['memcache']['persistent'],  // optional (standard: false)
            ]);

            return $session;
        });

        $this->app->instance('session.mongo', function () use ($config) {
            __l('[ServiceProvider] SessionServiceProvider : set->session MONGO ADAPTER');
            dd('mongo yok şuan');
        });

        $this->app->instance('session.redis', function () use ($config) {
            __l('[ServiceProvider] SessionServiceProvider : set->session REDIS ADAPTER');

            $session = new \Phalcon\Session\Adapter\Redis([
                'path' => "tcp://" . $config['redis']['host'] . ":" . $config['redis']['port'] . "?weight=1"
            ]);

            return $session;
        });

        $this->app->instance('session.handlersocket', function () use ($config) {
            __l('[ServiceProvider] SessionServiceProvider : set->session HANDLERSOCKET ADAPTER');

            dd('handlersocket yok.');
        });
    }

    public function registerSession()
    {
        $this->app->set('session', function () {
            $config = $this->app->get('config')['session'];
            $session = NULL;
            $adapter = strtolower($config['adapter']);

            if (!$this->app->has('session.' . $adapter)) {
                throw new \InvalidArgumentException('Invalid Session Adapter');
            }

            $session = $this->app->get('session.' . $adapter);

            $sessionRepository = new SessionRepository($this->app, $session);
            $sessionRepository->start();

            return $sessionRepository;

        });
    }

    public function registerFlashSession()
    {
        $this->app->set('flash', function () {
            __l('[ServiceProvider] SessionServiceProvider : set->flash');
            $config = $this->app->get('config')['flash'];
            if (strtolower($config['adapter']) == 'direct') {
                $flash = new \Phalcon\Flash\Direct($config['messages-class']);

                return $flash;
            }
            if (strtolower($config['adapter']) == 'session') {
                $flash = new \Phalcon\Flash\Session();

                return $flash;
            }

        });
    }

    public static function loadConfig(Application $app)
    {
        __l('[ServiceProvider] SessionServiceProvider : LoadConfig');
        $app->get('config')->loadConfigurationFiles($app, __DIR__ . '/config');
    }

    public static function loadHelper(Application $app)
    {
        __l('[ServiceProvider] SessionServiceProvider : loadHelper');
    }

    function boot()
    {
        __l('[ServiceProvider] SessionServiceProvider : Boot');
    }

    public function provides()
    {
        return [
            'flash', 'session', 'session.file', 'session.database', 'session.memcache', 'session.mongo', 'session.redis','session.handlersocket'
        ];
    }


}
