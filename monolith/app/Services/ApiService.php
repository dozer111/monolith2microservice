<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class ApiService
{
    abstract protected function getEndpoint(): string;

    protected function request(string $method, string $path, $data = [])
    {
        $response = $this->makeRequest($method,$path,$data);

        if ($response->ok()) {
            return $response->json();
        }

        throw new HttpException($response->status(),$response->body());
    }

    public function makeRequest(string $method, string $path, $data = []): Response
    {
        return \Http::acceptJson()
            ->withHeaders([
                'Authorization' => 'Bearer ' . request()->cookie('jwt')
            ])
            ->$method("{$this->getEndpoint()}/{$path}", $data);
    }

    public function get(string $path)
    {
        return $this->request('get', $path);
    }

    public function post(string $path, $data)
    {
        return $this->request('post', $path, $data);
    }

    public function put(string $path, $data)
    {
        return $this->request('put', $path, $data);
    }

    public function delete(string $path)
    {
        return $this->request('delete', $path);
    }
}
