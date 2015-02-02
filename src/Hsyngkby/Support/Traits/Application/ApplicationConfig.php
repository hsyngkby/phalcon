<?php namespace Hsyngkby\Support\Traits\Application;

trait ApplicationConfig
{
    /**
     * Get the path to the configuration cache file.
     *
     * @return string
     */
    public function getCachedConfigPath()
    {
        return $this['path.storage'].'/framework/config.php';
    }
}