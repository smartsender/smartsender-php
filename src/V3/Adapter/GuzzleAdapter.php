<?php
/**
 * Created by PhpStorm.
 * User: himik
 * Date: 15.05.19
 * Time: 7:44
 */

namespace SmartSender\V3\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use SmartSender\V3\Auth\AccessToken;

class GuzzleAdapter implements AdapterInterface
{

    /** @var Client */
    protected $client;

    /** @var AccessToken */
    protected $accessToken;

    protected $baseUri;


    public function __construct(AccessToken $accessToken, string $baseUri = null, array $options = [])
    {
        $this->accessToken = $accessToken;
        $this->baseUri     = $baseUri;
        $this->client      = $this->createClient($options);
    }

    protected function createClient(array $options = [])
    {
        $accessHeaders = $this->accessToken->getAuthHeaders();
        $headers       = isset($options['headers']) && is_array($options['headers']) ? array_merge($options['headers'],
            $accessHeaders) : $accessHeaders;

        $options = array_merge($options, [
            'base_uri' => $this->baseUri,
            'headers'  => $headers,
        ]);

        return new Client($options);
    }

    public function request(string $url, array $params = [])
    {

        try {
            $response = $this->client->post($url, [
                'json' => $params,
            ]);

            $libraryResponse = new Response($response->getStatusCode(), $response->getHeaders(),
                $response->getBody()->getContents());
        } catch (ClientException $e) {
            $response = $e->getResponse();

            $libraryResponse = new Response($response->getStatusCode(), $response->getHeaders(),
                $response->getBody()->getContents());
        }

        return $libraryResponse;

    }

}