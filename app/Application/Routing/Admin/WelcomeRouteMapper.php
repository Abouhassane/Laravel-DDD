<?php

declare(strict_types=1);

namespace App\Application\Routing\Admin;

use App\Application\Routing\RouteMapper;
use Illuminate\Routing\Router;

final class WelcomeRouteMapper implements RouteMapper
{
    public function map(Router $router): void
    {
        $router->get('/', function () {
            return view('welcome');
        });
    }
}
