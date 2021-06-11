<?php

namespace Edmarr2\D4sign\Services;

abstract class Client
{
    protected $client;

    protected const ENV_PRODUCTION = 'https://secure.d4sign.com.br/api/v1/';

    protected const ENV_SANDBOX = 'http://demo.d4sign.com.br/api/v1/';

    protected function getBaseUri()
    {
        return $baseUri = config('d4sign.mode') === 'production' ? self::ENV_PRODUCTION : self::ENV_SANDBOX;
    }

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(
            [
                'base_uri' => $this->getBaseUri(),
                'headers'  => [
                    'Accept'   => 'application/json',
                    'tokenAPI' => config('d4sign.token_api'),
                    'cryptKey' => config('d4sign.crypt_key')
                ]
            ]
        );
    }

    /**
     * @param  string  $url
     * @param  array  $query
     *
     * @return mixed
     */
    public function get(string $url, array $query = [])
    {
        return $this->client->get($url, $query);
    }

    /**
     * @param  string  $url
     * @param  array  $data
     *
     * @return mixed
     */
    public function post(string $url, array $data = [])
    {
        return $this->client->post($url, [
            'json' => $data
        ]);
    }

    /**
     * @param  string  $url
     * @param  array  $data
     *
     * @return mixed
     */
    public function put(string $url, array $data)
    {
        return $this->client->put($url, [
            'json' => $data
        ]);
    }

    /**
     * @param  string  $url
     * @param  array  $data
     *
     * @return mixed
     */
    public function delete(string $url, array $data)
    {
        return $this->client->delete($url, $data);
    }

}
