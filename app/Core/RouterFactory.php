<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList;

        // 1. Hlavní stránka (už ne Admin:Home, ale jen Home)
        $router->addRoute('', 'Home:default');

        // 2. Detail příspěvku (už ne Admin:Post, ale jen Post)
        $router->addRoute('post/<postId>', 'Post:show');

        // 3. Obecné pravidlo pro ostatní věci (Sign, Dashboard atd.)
        $router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');

        return $router;
    }
}