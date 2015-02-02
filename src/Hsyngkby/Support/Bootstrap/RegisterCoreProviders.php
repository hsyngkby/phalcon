<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Support\Application;

class RegisterCoreProviders
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
        __l('[Bootstrap] RegisterCoreProviders');

        $this->RegisterSecurityManager($app);

        $this->RegisterDispatcherManager($app);

        $this->RegisterCryptManager($app);
    }

    protected function RegisterSecurityManager($app)
    {
        __l('[Bootstrap] RegisterCoreProviders -> RegisterSecurityManager');
    }

    protected function RegisterCryptManager($app)
    {
        __l('[Bootstrap] RegisterCoreProviders -> RegisterCryptManager');

        $app->get('crypt')->setKey($app->get('config')['app.security.key']);
        $app->get('crypt')->setMode($app->get('config')['app.security.mode']);
        $app->get('crypt')->setCipher($app->get('config')['app.security.chipher']);
        $app->get('crypt')->setPadding($app->get('config')['app.security.padding']);
    }

    protected function RegisterDispatcherManager(Application $app)
    {
        __l('[Bootstrap] RegisterCoreProviders -> RegisterDispatcherManager');

        $app->set('dispatcher', function () use ($app) {

            //Obtain the standard eventsManager from the DI
            $eventsManager = $app->getShared('eventsManager');

            //Instantiate the Security plugin
            $security = $app->get('security');

            //Listen for events produced in the dispatcher using the Security plugin
            $eventsManager->attach('dispatch', $security);

            $dispatcher = $app->getShared('dispatcher');

            //Bind the EventsManager to the Dispatcher
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }

}
