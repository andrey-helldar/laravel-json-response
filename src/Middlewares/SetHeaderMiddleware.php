<?php

declare(strict_types=1);

namespace DragonCode\LaravelJsonResponse\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Lmc\HttpConstants\Header;

class SetHeaderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $this->set($request);

        return $next($request);
    }

    protected function set(Request $request)
    {
        $response->headers->set(Header::ACCEPT, 'application/json');
    }
}
