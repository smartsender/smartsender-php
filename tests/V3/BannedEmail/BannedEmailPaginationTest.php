<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 13:37
 */

namespace SmartSender\Tests\V3\BannedEmail;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\BannedEmail\BannedEmailPagination;

class BannedEmailPaginationTest extends TestCase
{

    public function testToArray()
    {
        $pagination = new BannedEmailPagination();
        $pagination->setEmail('test@example.com');
        $pagination->setType('testType');
        $pagination->setLimit(100);
        $pagination->setOffset(1000);

        $array = $pagination->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('type', $array);
        $this->assertArrayHasKey('limit', $array);
        $this->assertArrayHasKey('offset', $array);

        $this->assertEquals('test@example.com', $array['email']);
        $this->assertEquals('testType', $array['type']);
        $this->assertEquals(100, $array['limit']);
        $this->assertEquals(1000, $array['offset']);
    }
}