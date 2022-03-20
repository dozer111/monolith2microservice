<?php

declare(strict_types=1);

namespace App\Services;

abstract class ApiService
{
    abstract protected function getEndpoint(): string;

    public function post(string $path,$data){
        return \Http::post("{$this->getEndpoint()}/{$path}",$data)->json();
    }
}
