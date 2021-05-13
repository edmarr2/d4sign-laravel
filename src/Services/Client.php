<?php

namespace Edmarr2\D4sign\Services;

use GuzzleHttp\Client as GuzzleClient;

abstract class Client
{
    protected $client;
    
    protected const ENV_PRODUCTION = 'https://secure.d4sign.com.br/api/v1';
    
    protected const ENV_SANDBOX = 'http://demo.d4sign.com.br/api/v1';
    
    public function __construct()
    {
        $baseUri = config('d4sign.mode') === 'production' ? self::ENV_PRODUCTION : self::ENV_SANDBOX;
    
            $this->client = new GuzzleClient(
            [
                'base_uri' => $baseUri,
                'headers' => [
                    'Accept' => 'application/json',
                    'tokenAPI' => config('d4sign.token_api'),
                    'cryptKey' => config('d4sign.crypt_key')
                ]
            ]
        );
    }
    
    public function get(string $url, array $query = [])
    {
        return $this->client->get($url, $query);
    }
    
    public function post(string $url, array $data = [])
    {
        return $this->client->post($url, $data);
    }
    
    public function put(string $url, array $data)
    {
        return $this->client->put($url, $data);
    }
    
    public function delete(string $url, array $data)
    {
        return $this->client->delete($url, $data);
    }
}