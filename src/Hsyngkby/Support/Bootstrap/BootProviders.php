<?php namespace Hsyngkby\Support\Bootstrap;

use Hsyngkby\Support\Application;

class BootProviders {

	/**
	 * Bootstrap the given application.
	 *
	 * @param  \Hsyngkby\Support\Application  $app
	 * @return void
	 */
	public function bootstrap(Application $app)
	{
		$app->boot();
	}

}
