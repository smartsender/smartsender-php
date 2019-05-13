<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 13:22
 */

namespace SmartSender\V3\Adapter;


use SmartSender\V3\Auth\AccessToken;
use SmartSender\V3\Exceptions\AdapterException;

class CurlAdapter implements AdapterInterface
{

    const DEFAULT_TIMEOUT = 10;

    protected $baseUri;

    protected $authHeaders = [];


    public function __construct(AccessToken $accessToken, string $baseUri = null)
    {

        if ($baseUri === null) {
            $baseUri = 'https://api.smartsender.io/v3';
        }

        $this->baseUri = $baseUri;

        $this->authHeaders = $accessToken->getAuthHeaders();
    }

    public function request(string $url, array $params = [])
    {

        try {

            if (!$ch = curl_init()) {
                throw new AdapterException('cURL initialization failure');
            }

            $body = count($params) > 0 ? strval(json_encode($params)) : '';

            if (!curl_setopt_array($ch, $this->prepareOptions($url, $body))) {
                throw new AdapterException(curl_error($ch));
            }

            if (!$response = curl_exec($ch)) {
                throw new AdapterException(curl_error($ch));
            }

            $parts = explode("\r\n\r\n", $response, 3);
            list($head, $responseBody) = ($parts[0] == 'HTTP/1.1 100 Continue')
                ? [
                    $parts[1],
                    $parts[2],
                ]
                : [
                    $parts[0],
                    $parts[1],
                ];

            $responseHeaders = [];
            $headerLines     = explode("\r\n", $head);
            array_shift($headerLines);
            foreach ($headerLines as $line) {
                list($key, $value) = explode(':', $line, 2);
                $responseHeaders[$key] = $value;
            }
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $responseObj = new Response($status, $responseHeaders, $responseBody);

            // Parse SmartSender errors
            $parsed = $responseObj->getParsedBody();
            if (!$parsed) {
                throw new AdapterException("Response parsing error. Response: $response");
            }

            if (isset($parsed['result'])
                && !$parsed['result']
                && (!isset($parsed['errors']) || count($parsed['errors']) < 1)) {
                throw new AdapterException("Undefined or unhandled error. Please contact us by support@smartsender.io");
            }

            if (isset($parsed['errors']) && count($parsed['errors']) > 0) {
                throw new AdapterException($parsed['errors'][0]);
            }

            return $responseObj;

        } catch (AdapterException $e) {
            if (isset($ch) && is_resource($ch)) {
                curl_close($ch);
            }

            throw $e;
        }
    }

    protected function prepareOptions(string $url, string $body): array
    {
        $options = [
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_SSL_VERIFYPEER => false,

            CURLOPT_URL            => $this->baseUri . $url,
            CURLOPT_INFILESIZE     => null,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($body),
            ],
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => static::DEFAULT_TIMEOUT,
        ];

        foreach ($this->authHeaders as $header => $value) {
            $options[CURLOPT_HTTPHEADER][] = "$header: $value";
        }

        if ($body) {
            $options[CURLOPT_POSTFIELDS] = $body;
        }

        return $options;
    }
}