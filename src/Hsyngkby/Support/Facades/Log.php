<?php namespace Hsyngkby\Support\Facades;

/**
 * @see \Hsyngkby\Config\Repository
 */
class Log extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'logger'; }

}
