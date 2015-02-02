<?php namespace Hsyngkby\Testing;

trait ApplicationTrait
{

    /**
     * The Illuminate application instance.
     *
     * @var \Hsyngkby\Support\Application
     */
    protected $app;

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        putenv('APP_ENV=testing');
        $this->app = $this->createApplication();
    }

    protected function getInstance()
    {
        return $this->app->getDI();
    }

}
