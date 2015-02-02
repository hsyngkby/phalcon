<?php namespace Hsyngkby\Support;

use Hsyngkby\Support\Traits\Application\ApplicationBoot;
use Hsyngkby\Support\Traits\Application\ApplicationCall;
use Hsyngkby\Support\Traits\Application\ApplicationConfig;
use Hsyngkby\Support\Traits\Application\ApplicationEnvironment;
use Hsyngkby\Support\Traits\Application\ApplicationPaths;
use Hsyngkby\Support\Traits\Application\ApplicationProvider;
use Hsyngkby\Support\Traits\Application\ApplicationVariable;

class Application extends \Phalcon\DI\FactoryDefault
{

    use ApplicationPaths,
        ApplicationEnvironment,
        ApplicationVariable,
        ApplicationConfig,
        ApplicationProvider,
        ApplicationBoot,
        ApplicationCall;

    protected $hasBeenBootstrapped = FALSE;

    protected $booted = FALSE;

    public function __construct($basePath)
    {
        parent::__construct();

        $this->setBasePath($basePath);

    }

    public function bootstrapWith(array $bootstrappers)
    {
        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }

        $this->hasBeenBootstrapped = TRUE;
    }
    public function hasBeenBootstrapped()
    {
        return $this->hasBeenBootstrapped;
    }

    public function instance($abstract, $instance)
    {
        if (is_array($abstract)) {
            list($abstract, $alias) = $this->extractAlias($abstract);

            $this[ 'aliases.' . $abstract ] = $alias;
        }
        if (!$this->has($abstract))
            $this->attempt($abstract, $instance);
        else
            throw new \InvalidArgumentException($abstract . " is instance already");

    }

    protected function extractAlias(array $definition)
    {
        return [key($definition), current($definition)];
    }

    public function offsetGet($name)
    {
        return $this->getVariable($name);
    }

    public function offsetSet($name, $definition)
    {
        return $this->setVariable($name, $definition);
    }

    public function get($name, $parameters = NULL)
    {
        return $this->make($name, $parameters);
    }

}