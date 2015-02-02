<?php
if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string $key
     * @param  mixed  $default
     *
     * @return mixed
     */
    function env($key, $default = NULL)
    {
        $value = getenv($key);

        if ($value === FALSE) return value($default);

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return TRUE;

            case 'false':
            case '(false)':
                return FALSE;

            case 'null':
            case '(null)':
                return NULL;

            case 'empty':
            case '(empty)':
                return '';
        }

        return $value;
    }
}

if (!function_exists('__l')) {
    function __l()
    {
        if (!env('APP_DEBUG')) return;

        $args = func_get_args();

        $log_levels = [
            //'special'   => \Phalcon\Logger::SPECIAL,
            //'custom'    => \Phalcon\Logger::CUSTOM,
            'debug'   => \Phalcon\Logger::DEBUG,
            'info'    => \Phalcon\Logger::INFO,
            'notice'  => \Phalcon\Logger::NOTICE,
            'warning' => \Phalcon\Logger::WARNING,
            'alert'   => \Phalcon\Logger::ALERT,
            'error'   => \Phalcon\Logger::ERROR,
            //'critical'  => \Phalcon\Logger::CRITICAL,
            //'emergency' => \Phalcon\Logger::EMERGENCY,
        ];

        $log_level = [
            'type'  => 'log',
            'level' => \Phalcon\Logger::INFO
        ];

        foreach ($log_levels as $k => $v) {
            if (in_array($k, array_map('strtolower', $args))) {
                $log_level = [
                    'type'  => $k,
                    'level' => $v
                ];
            }
        }

        array_map(function ($x) use ($log_levels, $log_level) {
            if (array_key_exists(strtolower($x), $log_levels)) return;
            $msg = (string)$x;

            //Debugbar Servisi Yüklenmişse
//            if (app()->has('debugbarMessage')) {
//                app('debugbarMessage')->log($log_level['level'], $msg);
//            }

            Log::$log_level['type']($msg);

        }, $args);

    }
}

if ( ! function_exists('pre'))
{
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function pre()
    {
        array_map(function($x) { (new \Illuminate\Support\Debug\Dumper())->dump($x); }, func_get_args());
    }
}