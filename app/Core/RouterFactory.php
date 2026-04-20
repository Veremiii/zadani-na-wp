<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * Creates the main application router with defined routes.
	 */
	public static function createRouter(): RouteList
	{


		$router = new RouteList;

		$router->addRoute('', ['presenter' => 'Admin:Home', 'action' => 'default']);
		$router->addRoute('post/<postId>', ['presenter' => 'Admin:Post', 'action' => 'show']);
		$router->addRoute('<presenter>/<action>', ['presenter' => 'Dashboard', 'action' => 'default']);

		return $router;
	}
}
