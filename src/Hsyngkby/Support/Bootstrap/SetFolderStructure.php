<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Support\Application;

class SetFolderStructure {

    public function bootstrap(Application $app)
    {
        $app->bindPathsInContainer();
    }

}