<?php namespace Hsyngkby\Database;

use Hsyngkby\Database\event\DBEventListener;
use Hsyngkby\Support\Application;
use Hsyngkby\Support\ServiceProvider;

use \Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

class DatabaseServiceProvider extends ServiceProvider
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
        __l('[ServiceProvider] DatabaseServiceProvider : Register');

        if ($this->app->getVariable('env') === 'development') {
            $db_event_listener = new DBEventListener();
            $this->app->get('eventsManager')->attach('db', $db_event_listener);
            __l('[ServiceProvider] DatabaseServiceProvider : DBEventListener');
        }

        //$this->app->set('db', $this->app->get('eventsManager'));

        $this->app->instance('db', function () {

            __l('[ServiceProvider] DatabaseServiceProvider : instance->db');

            $db_adapter = new DbAdapter(
                $this->app->get('config')['db.' . $this->app->get('config')['db.adapter']]
            );

            //Eğer EvetListener a db işlendiyse.
            if ($this->app->get('eventsManager')->hasListeners('db')) {
                $db_adapter->setEventsManager($this->app->get('eventsManager'));
            }

            return $db_adapter;
        });
    }

    public static function loadConfig(Application $app)
    {
        __l('[ServiceProvider] DatabaseServiceProvider : loadConfig');
        $app->get('config')->loadConfigurationFiles($app, __DIR__ . '/config');
    }

    public static function loadHelper(Application $app)
    {
        __l('[ServiceProvider] DatabaseServiceProvider : loadHelper');
    }

    function boot()
    {
        __l('[ServiceProvider] DatabaseServiceProvider : Boot');
    }

    public function provides()
    {
        return [
            'db'
        ];
    }

}

//
//
//<?php namespace Hsyngkby\Database;
//
//use \Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
//
//app('loader')->registerFilesInDir(__DIR__ . '/helper/');
//app('loader')->registerFilesInDir(__DIR__ . '/config/');
//
//if (ENV == 'development') {
//    app('loader')->registerFilesInDir(__DIR__ . '/event/');
//    $db_event_listener = new \DBEventListener();
//    app('eventsManager')->attach('db', $db_event_listener);
//}
//
//
//app()->set('db', function () {
//
//    __l('[Setted] Database Service app("db")');
//
//    $db_adapter = new DbAdapter(
//        get_config('db.' . get_config('db.adapter'))
//    );
//
//    //Eğer EvetListener a db işlendiyse.
//    if (app('eventsManager')->hasListeners('db')) {
//        $db_adapter->setEventsManager(app('eventsManager'));
//    }
//
//    return $db_adapter;
//});
//
//__l('[loaded] Database Service app("db")');
