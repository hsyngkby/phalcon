<?php
return [
    /**
     * Direct
     *      Directly outputs the messages passed to the flasher
     *      http://docs.phalconphp.com/en/latest/api/Phalcon_Flash_Direct.html
     * Session
     *      Temporarily stores the messages in session, then messages can be printed in the next request
     *      http://docs.phalconphp.com/en/latest/api/Phalcon_Flash_Session.html
     */
    'adapter'        => 'Session',

    'messages-class' => [
        "error"   => "alert alert-error",
        "notice"  => "alert alert-info",
        "success" => "alert alert-success",
        "warning" => "alert alert-warning",
    ]

];