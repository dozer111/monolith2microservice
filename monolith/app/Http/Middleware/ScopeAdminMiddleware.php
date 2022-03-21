<?php

namespace App\Http\Middleware;

use App\Services\UsersService;
use Closure;
use Illuminate\Http\Request;

class ScopeAdminMiddleware
{
    private UsersService $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $this->service->makeRequest('get','scope/admin');

        if (!$response->ok()) {
            abort(401, 'unauthorized');
        }

        return $next($request);
    }
}
