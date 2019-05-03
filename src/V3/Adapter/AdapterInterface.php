<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 13:20
 */

namespace SmartSender\V3\Adapter;


use SmartSender\V3\Auth\AccessToken;

interface AdapterInterface
{

    public function __construct(AccessToken $accessToken, string $baseUri = null);

    public function request(string $url, array $params = []);
}