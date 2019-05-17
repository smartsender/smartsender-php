<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 13:46
 */

namespace SmartSender\Tests\V3\BannedPhone;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\BannedPhone\BannedPhone;

class BannedPhoneTest extends TestCase
{
    public function testToArray()
    {

        $date = new \DateTime('now', new \DateTimeZone('UTC'));

        $bannedPhone = new BannedPhone('+12341111111', BannedPhone::TYPE_IMPORT);
        $bannedPhone->setCreatedAt($date);

        $array = $bannedPhone->__toArray();

        $this->assertIsArray($array);

        $this->assertArrayHasKey('phoneNumber', $array);
        $this->assertArrayHasKey('rejectType', $array);
        $this->assertArrayHasKey('createdAt', $array);

        $this->assertEquals('+12341111111', $array['phoneNumber']);
        $this->assertEquals(BannedPhone::TYPE_IMPORT, $array['rejectType']);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $array['createdAt']);
    }

    public function testCreateFromArray()
    {
        $bannedPhone = BannedPhone::createFromArray([
            'phoneNumber'     => '+12341111111',
            'rejectType'      => BannedPhone::TYPE_IMPORT,
            'createdAt' => '2000-01-01 01:02:03',
        ]);

        $this->assertInstanceOf(BannedPhone::class, $bannedPhone);
        $this->assertEquals('+12341111111', $bannedPhone->getPhone());
        $this->assertEquals(BannedPhone::TYPE_IMPORT, $bannedPhone->getRejectType());
        $this->assertEquals('2000-01-01 01:02:03', $bannedPhone->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('UTC', $bannedPhone->getCreatedAt()->getTimezone()->getName());
    }
}