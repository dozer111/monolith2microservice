<?php

namespace App\Http\Controllers;

use App\Services\UsersService;

class AmbassadorController extends Controller
{
    public UsersService $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = collect($this->service->get('users'));
        return $users->filter(fn($user) => $user['is_admin'] === 0)->values();
    }
}
