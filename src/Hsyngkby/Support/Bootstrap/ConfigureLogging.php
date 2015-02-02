<?php namespace Hsyngkby\Support\Bootstrap;

use Dotenv;
use InvalidArgumentException;
use Hsyngkby\Support\Application;
use Phalcon\Logger,
    Phalcon\Logger\Multiple as MultipleStream,
    Phalcon\Logger\Adapter\File as FileAdapter,
    Phalcon\Logger\Adapter\Stream as StreamAdapter,
    Phalcon\Logger\Adapter\Firephp as Firephp;

class ConfigureLogging {

    /**
     * Bootstrap the given application.
     *
     * @param  Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $app->instance('logger', function ()use($app) {
            $logger = new MultipleStream();

            foreach ($app->get('config')['logger.adapters'] as $adapter => $property) {
                if (!$property['enable']) continue;

                switch ($adapter) {
                    case 'file_adapter';
                        $logger->push(new FileAdapter($app->storagePath() . DIRECTORY_SEPARATOR . $property['file']));
                        break;
                    case 'stream_adapter';
                        $logger->push(new StreamAdapter($property['stream']));
                        break;
                    case 'firephp';
                        $logger->push(new Firephp());
                        break;
                }
            }

            return $logger;
        });

    }

}