<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 14:51
 */

namespace SmartSender\V3\Adapter;


class Response
{

    /** @var int */
    protected $status;

    /** @var array */
    protected $headers = [];

    /** @var string */
    protected $body = '';

    /** @var array */
    protected $parsedBody = [];

    /**
     * Response constructor.
     *
     * @param int    $status
     * @param array  $headers
     * @param string $body
     */
    public function __construct(int $status, array $headers, string $body = '')
    {
        $this->status  = $status;
        $this->headers = $headers;
        $this->body    = $body;

        $parsedBody = json_decode($body, true);
        if ($parsedBody && is_array($parsedBody)) {
            $this->parsedBody = $parsedBody;
        }
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return Response
     */
    public function setStatus(int $status): Response
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $headerName
     *
     * @return string|null
     */
    public function getHeader(string $headerName)
    {
        return isset($this->headers[$headerName]) ? $this->headers[$headerName] : null;
    }

    /**
     * @param array $headers
     *
     * @return Response
     */
    public function setHeaders(array $headers): Response
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return Response
     */
    public function setBody(string $body): Response
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return array
     */
    public function getParsedBody(): array
    {
        return $this->parsedBody;
    }

    /**
     * @param array $parsedBody
     *
     * @return Response
     */
    public function setParsedBody(array $parsedBody): Response
    {
        $this->parsedBody = $parsedBody;

        return $this;
    }

    /**
     * @return bool
     */
    public function ok() {

        return $this->status < 400;
    }
}