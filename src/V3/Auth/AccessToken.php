<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 12:21
 */

namespace SmartSender\V3\Auth;


class AccessToken implements AuthInterface
{

    /** @var string */
    private $accessToken;

    /**
     * AccessToken constructor.
     *
     * @param string $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return array
     */
    public function getAuthHeaders(): array
    {
        return [
            'Access-Token' => $this->accessToken,
        ];
    }
}