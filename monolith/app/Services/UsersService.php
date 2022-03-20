<?php

declare(strict_types=1);

namespace App\Services;

final class UsersService extends ApiService
{

    protected function getEndpoint(): string
    {
        return "http://172.17.0.1:8001/api";
    }
}
