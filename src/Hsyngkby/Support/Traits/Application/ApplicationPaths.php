<?php namespace Hsyngkby\Support\Traits\Application;

trait ApplicationPaths
{
    public function setBasePath($basePath)
    {
        $this['path'] = $basePath;

        return $this;
    }

    public function bindPathsInContainer()
    {
        foreach (['base', 'app', 'bootstrap', 'config', 'database', 'public', 'resource', 'storage'] as $path) {
            $this['path.' . $path] = $this->{$path . 'Path'}();

            if (!defined(strtoupper($path . "_path"))) {
                define(strtoupper($path . "_path"), $this['path.' . $path]);
            }

        }
    }

    public function path()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('APP_PATH', 'app');
    }

    public function basePath()
    {
        return $this['path'];
    }

    public function appPath()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('APP_PATH', 'app');
    }

    public function bootstrapPath()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('BOOTSTRAP_PATH', 'bootstrap');
    }

    public function configPath()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('CONFIG_PATH', 'config');
    }

    public function databasePath()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('DATABASE_PATH', 'database');
    }

    public function publicPath()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('PUBLIC_PATH', 'public');
    }

    public function resourcePath()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('RESOURCE_PATH', 'resource');
    }

    public function storagePath()
    {
        return $this['path.base'] . DIRECTORY_SEPARATOR . env('STORAGE_PATH', 'storage');
    }


}