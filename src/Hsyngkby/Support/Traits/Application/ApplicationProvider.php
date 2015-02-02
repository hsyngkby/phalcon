<?php namespace Hsyngkby\Support\Traits\Application;

use Hsyngkby\Support\ProviderRepository;
use Illuminate\Filesystem\Filesystem;
use Hsyngkby\Support\ServiceProvider;

trait ApplicationProvider
{

    /**
     * All of the registered service providers.
     *
     * @var array
     */
    protected $serviceProviders = [];

    /**
     * The names of the loaded service providers.
     *
     * @var array
     */
    protected $loadedProviders = [];

    /**
     * The deferred services and their providers.
     *
     * @var array
     */
    protected $deferredServices = [];

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    public function registerConfiguredProviders()
    {
        __l('[App] registerConfiguredProviders');

        $manifestPath = $this->storagePath() . '/framework/services.json';

        (new ProviderRepository($this, new Filesystem, $manifestPath))
            ->load($this->get('config')['app.providers']);
    }

    /**
     * Register a service provider with the application.
     *
     * @param  \Illuminate\Support\ServiceProvider|string $provider
     * @param  array                                      $options
     * @param  bool                                       $force
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function register($provider, $options = [], $force = FALSE)
    {
        if ($registered = $this->getProvider($provider) && !$force)
            return $registered;

        // If the given "provider" is a string, we will resolve it, passing in the
        // application instance automatically for the developer. This is simply
        // a more convenient way of specifying your service provider classes.
        if (is_string($provider)) {
            $provider = $this->resolveProviderClass($provider);
        }

        $provider->register();

        // Once we have registered the service we will iterate through the options
        // and set each of them on the application so they will be available on
        // the actual loading of the service objects and for developer usage.
        foreach ($options as $key => $value) {
            $this[ $key ] = $value;
        }

        $this->markAsRegistered($provider);

        // If the application has already booted, we will call this boot method on
        // the provider class so it has an opportunity to do its boot logic and
        // will be ready for any usage by the developer's application logics.
        if ($this->booted) {
            $this->bootProvider($provider);
        }

        return $provider;
    }

    /**
     * Get the registered service provider instance if it exists.
     *
     * @param  \Illuminate\Support\ServiceProvider|string $provider
     *
     * @return \Illuminate\Support\ServiceProvider|null
     */
    public function getProvider($provider)
    {
        $name = is_string($provider) ? $provider : get_class($provider);

        return array_first($this->serviceProviders, function ($key, $value) use ($name) {
            return $value instanceof $name;
        });
    }

    /**
     * Resolve a service provider instance from the class name.
     *
     * @param  string $provider
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function resolveProviderClass($provider)
    {
        return new $provider($this);
    }

    /**
     * Mark the given provider as registered.
     *
     * @param  \Illuminate\Support\ServiceProvider
     *
     * @return void
     */
    protected function markAsRegistered($provider)
    {
        $class = get_class($provider);
        //$this['events']->fire($class, [$provider]);

        $this->serviceProviders[] = $provider;

        $this->loadedProviders[ $class ] = TRUE;
    }

    /**
     * Boot the given service provider.
     *
     * @param  \Illuminate\Support\ServiceProvider $provider
     *
     * @return void
     */
    protected function bootProvider(ServiceProvider $provider)
    {
        if (method_exists($provider, 'boot')) {
            return $this->call([$provider, 'boot']);
        }
    }

    /**
     * Set the application's deferred services.
     *
     * @param  array $services
     *
     * @return void
     */
    public function setDeferredServices(array $services)
    {
        $this->deferredServices = $services;
    }

    public function getDeferredServices()
    {
        return $this->deferredServices;
    }
}