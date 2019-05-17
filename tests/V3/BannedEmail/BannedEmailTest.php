<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 12:33
 */

namespace SmartSender\Tests\V3\BannedEmail;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\BannedEmail\BannedEmail;
use SmartSender\V3\Exceptions\BannedEmailException;

class BannedEmailTest extends TestCase
{

    public function testToArray()
    {
        $date = new \DateTime('now', new \DateTimeZone('UTC'));

        $bannedEmail = new BannedEmail('test@example.com', BannedEmail::TYPE_HARD, 'testRawLog');
        $bannedEmail->setCreatedAt($date);
        $bannedEmail->setExpireAt($date);

        $array = $bannedEmail->__toArray();

        $this->assertIsArray($array);

        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('rejectType', $array);
        $this->assertArrayHasKey('rawLog', $array);
        $this->assertArrayHasKey('createdAt', $array);
        $this->assertArrayHasKey('expireAt', $array);

        $this->assertEquals('test@example.com', $array['email']);
        $this->assertEquals(BannedEmail::TYPE_HARD, $array['rejectType']);
        $this->assertEquals('testRawLog', $array['rawLog']);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $array['createdAt']);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $array['expireAt']);
    }

    public function testCreateFromArray()
    {
        $bannedEmail = BannedEmail::createFromArray([
            'email'      => 'test@example.com',
            'rejectType' => BannedEmail::TYPE_HARD,
            'rawLog'     => 'testRawLog',
            'createdAt'  => '2000-01-01 01:02:03',
            'expireAt'   => '2100-01-01 01:02:03',
        ]);

        $this->assertInstanceOf(BannedEmail::class, $bannedEmail);
        $this->assertEquals('test@example.com', $bannedEmail->getEmail());
        $this->assertEquals(BannedEmail::TYPE_HARD, $bannedEmail->getRejectType());
        $this->assertEquals('testRawLog', $bannedEmail->getRawLog());
        $this->assertEquals('2000-01-01 01:02:03', $bannedEmail->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('UTC', $bannedEmail->getCreatedAt()->getTimezone()->getName());
        $this->assertEquals('2100-01-01 01:02:03', $bannedEmail->getExpireAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('UTC', $bannedEmail->getExpireAt()->getTimezone()->getName());
    }
}