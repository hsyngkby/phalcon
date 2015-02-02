<?php namespace Hsyngkby\Cookie;

use Hsyngkby\Support\Application;
use Phalcon\Http\Cookie;
use Phalcon\Http\Response\Cookies;

class CookieProvider implements \Phalcon\Http\Response\CookiesInterface
{

    protected $app;

    protected $cookies;

    public function __construct(Application $app, Cookies $cookies)
    {
        $this->app = $app;

        $this->cookies = $cookies;

        $this->cookies->setDI($app);

        foreach ($_COOKIE as $name => $value) {
            $this->cookies->set($name, $value);
        }
    }

    /**
     * Gets a cookie from the bag
     *
     * @param string name
     *
     * @return \Phalcon\Http\Cookie
     */
    function get($name)
    {
        return $this->cookies->get($name);
    }

    /**
     * Sets a cookie to be sent at the end of the request
     * This method overrides any cookie set before with the same name
     *
     * @param string  name
     * @param mixed   value
     * @param int     expire
     * @param string  path
     * @param boolean secure
     * @param string  domain
     * @param boolean httpOnly
     *
     * @return \Phalcon\Http\Response\Cookies
     */
    function set($name, $value = NULL, $expire = NULL, $path = NULL, $secure = NULL, $domain = NULL, $httpOnly = NULL)
    {
        $this->cookies->set($name, $value, $expire, $path, $secure, $domain, $httpOnly);

        $this->send();
    }

    /**
     * Set if cookies in the bag must be automatically encrypted/decrypted
     *
     * @param boolean useEncryption
     *
     * @return \Phalcon\Http\Response\Cookies
     */
    public function useEncryption($useEncryption)
    {
        return $this->cookies->useEncryption($useEncryption);
    }

    /**
     * Returns if the bag is automatically encrypting/decrypting cookies
     *
     * @return boolean
     */
    public function isUsingEncryption()
    {
        return $this->cookies->isUsingEncryption();
    }

    /**
     * Check if a cookie is defined in the bag or exists in the _COOKIE superglobal
     *
     * @param string name
     *
     * @return boolean
     */
    public function has($name)
    {
        return $this->cookies->has($name);
    }

    /**
     * Deletes a cookie by its name
     * This method does not removes cookies from the _COOKIE superglobal
     *
     * @param string name
     *
     * @return boolean
     */
    public function delete($name)
    {
        return $this->cookies->delete($name);
    }

    /**
     * Sends the cookies to the client
     * Cookies aren't sent if headers are sent in the current request
     *
     * @return boolean
     */
    public function send()
    {
        return $this->cookies->send();
    }

    /**
     * Reset set cookies
     *
     * @return \Phalcon\Http\Response\Cookies
     */
    public function reset()
    {
        return $this->cookies->reset();
    }

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->cookies->setDI($dependencyInjector);
    }


    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->cookies->getDI();
    }

}