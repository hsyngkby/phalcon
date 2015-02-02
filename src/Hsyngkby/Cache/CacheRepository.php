<?php namespace Hsyngkby\Cache;

use Hsyngkby\Support\Application;

class CacheRepository
{
    protected $app;

    protected $cache;

    protected $config;

    function __construct(Application $app, $config, $_frontend = null, $_backend = null)
    {
        $this->setup($app,$config,$_frontend,$_backend);
    }

    public function setup(Application $app, $config, $_frontend = null, $_backend = null){
        $this->app = $app;
        $frontend = $_frontend ? $_frontend : $config['frontend'];
        $frontend_class = "\\Phalcon\\Cache\\Frontend\\$frontend";
        $frontendOpt = $config['frontend_modules'][$frontend];
        $frontend = new $frontend_class($frontendOpt);

        $backend = $_backend ? $_backend : $config['backend'];
        $backend_class = "\\Phalcon\\Cache\\Backend\\$backend";
        $backendOpt = $config['backend_modules'][$backend];

        if ($backend == 'Redis') {
            $redis = new \Redis();
            $redis->connect($backendOpt['host'], $backendOpt['port']);
            $backendOpt = ['redis' => $redis];
        }
        $this->cache = new $backend_class($frontend, $backendOpt);

    }

    public function __call($method, $param = [])
    {
        if (count($param) == 0) return $this->getCache()->$method();
        if (count($param) == 1) return $this->getCache()->$method($param[0]);
        if (count($param) == 2) return $this->getCache()->$method($param[0], $param[1]);
        if (count($param) == 3) return $this->getCache()->$method($param[0], $param[1], $param[2]);
        if (count($param) == 4) return $this->getCache()->$method($param[0], $param[1], $param[2], $param[3]);
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function setApp($app)
    {
        $this->app = $app;
    }

}