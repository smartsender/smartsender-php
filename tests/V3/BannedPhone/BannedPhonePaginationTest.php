<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 13:37
 */

namespace SmartSender\Tests\V3\BannedPhone;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\BannedEmail\BannedEmailPagination;
use SmartSender\V3\BannedPhone\BannedPhonePagination;

class BannedPhonePaginationTest extends TestCase
{

    public function testToArray()
    {
        $pagination = new BannedPhonePagination();
        $pagination->setPhone('+12341111111');
        $pagination->setRejectType('testType');
        $pagination->setLimit(100);
        $pagination->setOffset(1000);

        $array = $pagination->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('phoneNumber', $array);
        $this->assertArrayHasKey('rejectType', $array);
        $this->assertArrayHasKey('limit', $array);
        $this->assertArrayHasKey('offset', $array);

        $this->assertEquals('+12341111111', $array['phoneNumber']);
        $this->assertEquals('testType', $array['rejectType']);
        $this->assertEquals(100, $array['limit']);
        $this->assertEquals(1000, $array['offset']);
    }
}