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
use Psr\Http\Message\ResponseInterface;
use SmartSender\V3\Auth\AccessToken;
use SmartSender\V3\Exceptions\AdapterException;

class GuzzleAdapter implements AdapterInterface
{

    /** @var Client */
    protected $client;

    /** @var AccessToken */
    protected $accessToken;

    /** @var string */
    protected $baseUri = 'https://api.smartsender.io';


    public function __construct(AccessToken $accessToken, string $baseUri = null, array $options = [])
    {
        if (!is_null($baseUri)) {
            $this->baseUri = $baseUri;
        }
        $this->accessToken = $accessToken;
        $this->client      = $this->createClient($options);
    }

    protected function createClient(array $options = []): Client
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

    public function request(string $url, array $params = []): Response
    {
        try {
            $response = $this->client->post($url, [
                'json' => $params,
            ]);

            return $this->createLibraryResponse($response);
        } catch (ClientException $e) {
            throw new AdapterException($e->getMessage(), $e->getCode());
        }
    }

    protected function createLibraryResponse(ResponseInterface $response)
    {
        return new Response($response->getStatusCode(), $response->getHeaders(), $response->getBody()->getContents());
    }

}