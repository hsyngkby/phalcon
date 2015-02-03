<?php namespace Hsyngkby\Session;

use Hsyngkby\Support\Application;
use Phalcon\Http\Cookie;
use Phalcon\Session\AdapterInterface;

class SessionRepository implements AdapterInterface
{

    protected $app;

    protected $session;

    public function __construct(Application $app, AdapterInterface $session)
    {
        $this->app = $app;

        $this->session = $session;

    }

    /**
     * Starts the session (if headers are already sent the session will not be started)
     *
     * @return boolean
     */
    public function start()
    {
        if (!$this->session->isStarted())
            return $this->session->start();
    }

    /**
     * Sets session's options
     *
     *<code>
     *    session->setOptions(array(
     *        'uniqueId' => 'my-private-app'
     *    ));
     *</code>
     *
     * @param array options
     */
    public function setOptions($options)
    {
        $this->session->setOptions($options);
    }

    /**
     * Get internal options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->session->getOptions();
    }

    /**
     * Gets a session variable from an application context
     *
     * @param string  index
     * @param mixed   defaultValue
     * @param boolean remove
     *
     * @return mixed
     */
    public function get($index, $defaultValue = NULL)
    {
        return $this->session->get($index, $defaultValue);
    }

    /**
     * Sets a session variable in an application context
     *
     *<code>
     *    session->set('auth', 'yes');
     *</code>
     *
     * @param string index
     * @param string value
     */
    public function set($index, $value)
    {
        $this->session->set($index, $value);
    }

    /**
     * Check whether a session variable is set in an application context
     *
     *<code>
     *    var_dump($session->has('auth'));
     *</code>
     *
     * @param string index
     *
     * @return boolean
     */
    public function has($index)
    {
        return $this->session->has($index);
    }

    /**
     * Removes a session variable from an application context
     *
     *<code>
     *    $session->remove('auth');
     *</code>
     *
     * @param string index
     */
    public function remove($index)
    {
        $this->session->remove($index);
    }

    /**
     * Returns active session id
     *
     *<code>
     *    echo $session->getId();
     *</code>
     *
     * @return string
     */
    public function getId()
    {
        return $this->session->getId();
    }

    /**
     * Check whether the session has been started
     *
     *<code>
     *    var_dump($session->isStarted());
     *</code>
     *
     * @return boolean
     */
    public function isStarted()
    {
        return $this->session->isStarted();
    }

    /**
     * Destroys the active session
     *
     *<code>
     *    var_dump(session->destroy());
     *</code>
     *
     * @return boolean
     */
    public function destroy($session_id = NULL)
    {
        return $this->session->destroy($session_id);
    }

}