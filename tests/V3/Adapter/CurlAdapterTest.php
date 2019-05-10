<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 14:30
 */

namespace SmartSender\Tests\V3\Adapter;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Adapter\AdapterInterface;
use SmartSender\V3\Adapter\CurlAdapter;
use SmartSender\V3\Adapter\Response;
use SmartSender\V3\Auth\AccessToken;

class CurlAdapterTest extends TestCase
{

    /** @var AdapterInterface */
    private $curlAdapter;

    public function setUp()
    {
        $accessToken = $this->getMockBuilder(AccessToken::class)
                            ->setConstructorArgs(['thisIsTestAccessToken'])
                            ->setMethods(['getAuthHeaders'])
                            ->getMock()
        ;

        $accessToken->method('getAuthHeaders')->willReturn(['X-Access-Token-Testing' => 'thisIsTestAccessToken']);

        $this->curlAdapter = new CurlAdapter($accessToken, 'https://httpbin.org');
    }

    public function testRequest()
    {
        $response = $this->curlAdapter->request('/anything', ['testParamKey' => 'testParamValue']);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->ok());


        $this->assertArrayHasKey('headers', $response->getParsedBody());
        $this->assertArrayHasKey('json', $response->getParsedBody());
        $this->assertArrayHasKey('method', $response->getParsedBody());
        $this->assertEqualsIgnoringCase('POST', $response->getParsedBody()['method']);
        $this->assertArrayHasKey('X-Access-Token-Testing', $response->getParsedBody()['headers']);
        $this->assertEquals('thisIsTestAccessToken', $response->getParsedBody()['headers']['X-Access-Token-Testing']);
        $this->assertArrayHasKey('testParamKey', $response->getParsedBody()['json']);
        $this->assertEquals('testParamValue', $response->getParsedBody()['json']['testParamKey']);

    }
}