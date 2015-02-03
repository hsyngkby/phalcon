<?php namespace Hsyngkby\Support\Facades;

/**
 * @see \Hsyngkby\Config\Repository
 */
class Route extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'router'; }

}
