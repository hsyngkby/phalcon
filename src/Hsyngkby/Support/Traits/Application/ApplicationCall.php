<?php namespace Hsyngkby\Support\Traits\Application;

trait ApplicationCall
{
    protected $instence = [];
    /**
     * Resolve the given type from the container.
     *
     * (Overriding Container::make)
     *
     * @param  string  $abstract
     * @param  array   $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = [])
    {
        //return $this->get($abstract, $parameters);

        if (isset($this->instence[$abstract])){
            return $this->instence[$abstract];
        }

        if (isset($this->deferredServices[$abstract]))
        {
            $this->loadDeferredProvider($abstract);
        }

        $this->instence[$abstract] = parent::get($abstract, $parameters);
        return $this->instence[$abstract];

    }
    /**
     * Load the provider for a deferred service.
     *
     * @param  string  $service
     * @return void
     */
    public function loadDeferredProvider($service)
    {
        if ( ! isset($this->deferredServices[$service]))
        {
            return;
        }

        $provider = $this->deferredServices[$service];

        // If the service provider has not already been loaded and registered we can
        // register it with the application and remove the service from this list
        // of deferred services, since it will already be loaded on subsequent.
        if ( ! isset($this->loadedProviders[$provider]))
        {
            $this->registerDeferredProvider($provider, $service);
        }
    }
    /**
     * Register a deferred provider and service.
     *
     * @param  string  $provider
     * @param  string  $service
     * @return void
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        // Once the provider that provides the deferred service has been registered we
        // will remove it from our local list of the deferred services with related
        // providers so that this container does not try to resolve it out again.
        if ($service) unset($this->deferredServices[$service]);

        $this->register($instance = new $provider($this));

        if ( ! $this->booted)
        {
            $this->booting(function() use ($instance)
            {
                $this->bootProvider($instance);
            });
        }
    }

    /**
    ####################################################################################################################
    ####################################################################################################################
    ####################################################################################################################
    ####################################################################################################################
    */

    /**
     * Call the given Closure / class@method and inject its dependencies.
     *
     * @param  callable|string $callback
     * @param  array           $parameters
     * @param  string|null     $defaultMethod
     *
     * @return mixed
     */
    public function call($callback, array $parameters = [], $defaultMethod = NULL)
    {
        if ($this->isCallableWithAtSign($callback) || $defaultMethod) {
            return $this->callClass($callback, $parameters, $defaultMethod);
        }

        $dependencies = $this->getMethodDependencies($callback, $parameters);

        return call_user_func_array($callback, $dependencies);
    }

    /**
     * Determine if the given string is in Class@method syntax.
     *
     * @param  mixed $callback
     *
     * @return bool
     */
    protected function isCallableWithAtSign($callback)
    {
        if (!is_string($callback)) {
            return FALSE;
        }

        return strpos($callback, '@') !== FALSE;
    }

    /**
     * Call a string reference to a class using Class@method syntax.
     *
     * @param  string      $target
     * @param  array       $parameters
     * @param  string|null $defaultMethod
     *
     * @return mixed
     * @throws \InvalidArgumentException
     */
    protected function callClass($target, array $parameters = [], $defaultMethod = NULL)
    {
        $segments = explode('@', $target);

        // If the listener has an @ sign, we will assume it is being used to delimit
        // the class name from the handle method name. This allows for handlers
        // to run multiple handler methods in a single class for convenience.
        $method = count($segments) == 2 ? $segments[1] : $defaultMethod;

        if (is_null($method)) {
            throw new \InvalidArgumentException("Method not provided.");
        }

        return $this->call([$this->make($segments[0]), $method], $parameters);
    }

    /**
     * Get all dependencies for a given method.
     *
     * @param  callable|string  $callback
     * @param  array  $parameters
     * @return array
     */
    protected function getMethodDependencies($callback, $parameters = [])
    {
        $dependencies = [];

        foreach ($this->getCallReflector($callback)->getParameters() as $key => $parameter)
        {
            $this->addDependencyForCallParameter($parameter, $parameters, $dependencies);
        }

        return array_merge($dependencies, $parameters);
    }

    /**
     * Get the proper reflection instance for the given callback.
     *
     * @param  callable|string  $callback
     * @return \ReflectionFunctionAbstract
     */
    protected function getCallReflector($callback)
    {
        if (is_string($callback) && strpos($callback, '::') !== false)
        {
            $callback = explode('::', $callback);
        }

        if (is_array($callback))
        {
            return new \ReflectionMethod($callback[0], $callback[1]);
        }

        return new \ReflectionFunction($callback);
    }

    /**
     * Get the dependency for the given call parameter.
     *
     * @param  \ReflectionParameter  $parameter
     * @param  array  $parameters
     * @param  array  $dependencies
     * @return mixed
     */
    protected function addDependencyForCallParameter(\ReflectionParameter $parameter, array &$parameters, &$dependencies)
    {
        if (array_key_exists($parameter->name, $parameters))
        {
            $dependencies[] = $parameters[$parameter->name];

            unset($parameters[$parameter->name]);
        }
        elseif ($parameter->getClass())
        {
            $dependencies[] = $this->make($parameter->getClass()->name);
        }
        elseif ($parameter->isDefaultValueAvailable())
        {
            $dependencies[] = $parameter->getDefaultValue();
        }
    }

}