<?php

declare(strict_types=1);

namespace App\Services;

final class UsersService extends ApiService
{

    protected function getEndpoint(): string
    {
        return  env('USERS_MS'). '/api';
    }
}
