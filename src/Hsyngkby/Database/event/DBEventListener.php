<?php
namespace Hsyngkby\Database\event;

class DBEventListener
{
    protected $_time;

    public function __construct()
    {
        //__l('[loaded] Database Event Listener');
    }

    public function afterConnect()
    {
        //__l('DBEventListener : afterConnect');
    }

    public function beforeQuery($event, $connection)
    {
        //__l('DBEventListener : beforeQuery');
        //$this->_time = microtime_float();
        //__l('DBEventListener : microtime_float = ' . $this->_time);
    }

    public function afterQuery($event, $connection)
    {
        //__l('DBEventListener : afterQuery');

        //__l('[' . (microtime_float($this->_time)) . ']' . ' ' . $connection->getSQLStatement() . ' ' . json_encode($connection->getSQLVariables()));
    }
}
