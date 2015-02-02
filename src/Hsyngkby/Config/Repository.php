<?php

namespace Hsyngkby\Config;

use Hsyngkby\Support\Application;
use Phalcon\Config as PHConfig;
use Symfony\Component\Finder\Finder;

class Repository extends PHConfig
{

    public function set($key, $value = NULL)
    {
        //key value şeklinde tekil bir giriş yaparsa
        if (is_string($key) && is_string($value)) {
            $this->addToConfigWithDot($key, $value);
        } //key string ama value olarak array gönderildiğinde
        elseif (is_string($key) && is_array($value)) {
            $_t[ $key ] = $value;
            $this->set($_t);
        } //key olarak bir array gönderilmişse
        elseif (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->addToConfigWithDot($k, $v);
            }
        } //eğer key ne string ne de array ise
        else {
            throw new \InvalidArgumentException;
        }
    }

    //laravel deki . ile ayırmalı sistem
    private function addToConfigWithDot($key, $value)
    {
        $arr = $this->toArray();
        $arr = array_add($arr, $key, $value);
        $this->merge($arr);
    }

    public function all(){
        return $this->toArray();
    }

    public function get($index = NULL, $defaultValue = NULL)
    {
        if ($index == NULL)
            return $this->toArray();

        return array_get($this->toArray(), $index, $defaultValue);
    }

    /**
     * Load the configuration items from all of the files.
     *
     * @param  \Hsyngkby\Support\Application $app
     *
     * @return void
     */
    public function loadConfigurationFiles(Application $app, $directory = NULL)
    {
        foreach ($this->getConfigurationFiles($app, $directory) as $key => $path) {
            $app->get('config')->set(strtolower($key), require $path);
        }
    }

    /**
     * Get all of the configuration files for the application.
     *
     * @param  \Hsyngkby\Support\Application $app
     *
     * @return array
     */
    protected function getConfigurationFiles(Application $app, $directory)
    {
        $directory = $directory ? $directory : $app->configPath();
        $files = [];

        foreach (Finder::create()->files()->name('*.php')->in($directory) as $file) {
            $files[ basename($file->getRealPath(), '.php') ] = $file->getRealPath();
        }

        return $files;
    }

    public function offsetGet($index)
    {
        return $this->get($index);
    }

}