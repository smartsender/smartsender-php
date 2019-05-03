<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 12:24
 */

namespace SmartSender\Tests\V3\Auth;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Auth\AccessToken;

class AccessTokenTest extends TestCase
{
        public function testGetAuthHeaders()
        {
            $accessToken = new AccessToken('thisIsTestAccessToken');
            $headers = $accessToken->getAuthHeaders();

            $this->assertArrayHasKey('Access-Token', $headers);
            $this->assertCount(1, $headers);
            $this->assertEquals('thisIsTestAccessToken', $headers['Access-Token']);

        }
}