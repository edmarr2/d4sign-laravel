<?php

namespace Edmarr2\D4sign\Services;

use Edmarr2\D4sign\Exceptions\WithoutCryptKeyException;
use Edmarr2\D4sign\Exceptions\WithoutTokenException;
use GuzzleHttp\Client as GuzzleClient;

abstract class Client
{
    protected $client;

    public function __construct()
    {
        if (!config('d4sign.token_api')) {
            throw new WithoutTokenException();
        }

        if (!config('d4sign.crypt_key')) {
            throw new WithoutCryptKeyException();
        }
        $this->client = new GuzzleClient([
            'base_uri' => config('d4sign.base_uri'),
            'headers' => [
                'Accept' => 'application/json',
                'tokenAPI' => config('d4sign.token_api'),
                'cryptKey' => config('d4sign.crypt_key')
            ]
       ]);
    }

    public function get(string $url, array $query = [])
    {
        return $this->client->get($url, $query)->getBody()->getContents();
    }

    public function post(string $url, array $data = [])
    {
        return $this->client->post($url, $data)->getBody()->getContents();
    }

    public function put(string $url, array $data)
    {
        return $this->client->put($url, $data)->getBody()->getContents();
    }

    public function delete(string $url, array $data)
    {
        return $this->client->delete($url, $data)->getBody()->getContents();
    }
}