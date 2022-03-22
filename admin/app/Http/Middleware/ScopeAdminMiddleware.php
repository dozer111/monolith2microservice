<?php

namespace App\Http\Middleware;

use Closure;
use dozer111\UsersMicroservice\UsersApi;
use Illuminate\Http\Request;

class ScopeAdminMiddleware
{
    private UsersApi $service;

    public function __construct(UsersApi $service)
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
