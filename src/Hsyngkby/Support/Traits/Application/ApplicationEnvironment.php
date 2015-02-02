<?php namespace Hsyngkby\Support\Traits\Application;

use Hsyngkby\Support\Environment\EnvironmentDetector;

trait ApplicationEnvironment
{
    protected $environmentFile = '.env';

    public function environmentFile()
    {
        return $this->environmentFile ?: '.env';
    }

    public function environment()
    {
        if (func_num_args() > 0) {
            $patterns = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();

            foreach ($patterns as $pattern) {
                if (str_is($pattern, $this['env'])) {
                    return TRUE;
                }
            }

            return FALSE;
        }

        return $this['env'];
    }

    public function detectEnvironment(\Closure $callback)
    {
        $args = isset($_SERVER['argv']) ? $_SERVER['argv'] : null;

        return $this['env'] = (new EnvironmentDetector())->detect($callback, $args);
    }

}