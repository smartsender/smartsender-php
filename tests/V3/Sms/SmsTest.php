<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 16:17
 */

namespace SmartSender\Tests\V3\Sms;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Sms\Sms;

class SmsTest extends TestCase
{

    public function testToArray()
    {

        $date = new \DateTime('now', new \DateTimeZone('UTC'));

        $sms = new Sms();
        $sms->setId('testId');
        $sms->setStatus('testStatus');
        $sms->setDomain('example.com');
        $sms->setTo('+12341111111');
        $sms->setFromName('testFromName');
        $sms->setText('testText');
        $sms->setCreatedAt($date);
        $sms->addTag('testTag');

        $array = $sms->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('status', $array);
        $this->assertArrayHasKey('domain', $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('fromName', $array);
        $this->assertArrayHasKey('text', $array);
        $this->assertArrayHasKey('tags', $array);
        $this->assertArrayHasKey('createdAt', $array);

        $this->assertEquals('testId', $array['id']);
        $this->assertEquals('testStatus', $array['status']);
        $this->assertEquals('example.com', $array['domain']);
        $this->assertEquals('+12341111111', $array['to']);
        $this->assertEquals('testFromName', $array['fromName']);
        $this->assertEquals('testText', $array['text']);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $array['createdAt']);
        $this->assertIsArray($array['tags']);
        $this->assertCount(1, $array['tags']);
        $this->assertEquals('testTag', $array['tags'][0]);
    }

    public function testCreateFromArray()
    {
        $sms = Sms::createFromArray([
            'id'        => 'testId',
            'status'    => 'testStatus',
            'text'      => 'testText',
            'to'        => '+12341111111',
            'from'      => 'testFrom',
            'createdAt' => '2000-01-02 03:04:05',
        ]);

        $this->assertInstanceOf(Sms::class, $sms);
        $this->assertEquals('testId', $sms->getId());
        $this->assertNull($sms->getDomain());
        $this->assertEquals('testStatus', $sms->getStatus());
        $this->assertEquals('testText', $sms->getText());
        $this->assertEquals('testFrom', $sms->getFromName());
        $this->assertEquals('+12341111111', $sms->getTo());
        $this->assertEquals('2000-01-02 03:04:05', $sms->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('UTC', $sms->getCreatedAt()->getTimezone()->getName());
    }
}