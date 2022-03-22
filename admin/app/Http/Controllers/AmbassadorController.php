<?php

namespace App\Http\Controllers;


use dozer111\UsersMicroservice\UsersApi;

class AmbassadorController extends Controller
{
    private UsersApi $service;

    public function __construct(UsersApi $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = collect($this->service->get('users'));
        return $users->filter(fn($user) => $user['is_admin'] === 0)->values();
    }
}
