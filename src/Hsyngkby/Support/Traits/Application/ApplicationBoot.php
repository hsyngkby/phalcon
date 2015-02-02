<?php namespace Hsyngkby\Support\Traits\Application;

trait ApplicationBoot
{
    protected $bootingCallbacks = [];

    protected $bootedCallbacks = [];

    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->booted) return;

        // Once the application has booted we will also fire some "booted" callbacks
        // for any listeners that need to do work after this initial booting gets
        // finished. This is useful when ordering the boot-up processes we run.
        $this->fireAppCallbacks($this->bootingCallbacks);

        array_walk($this->serviceProviders, function($p) {
            $this->bootProvider($p);
        });

        $this->booted = true;

        $this->fireAppCallbacks($this->bootedCallbacks);
    }

    /**
     * Call the booting callbacks for the application.
     *
     * @param  array  $callbacks
     * @return void
     */
    protected function fireAppCallbacks(array $callbacks)
    {
        foreach ($callbacks as $callback)
        {
            call_user_func($callback, $this);
        }
    }

}