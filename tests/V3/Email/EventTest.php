<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 15:51
 */

namespace SmartSender\Tests\V3\Email;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Email\Event;

class EventTest extends TestCase
{
    public function testCreateFromArray()
    {
        $event = Event::createFromArray([
            'event' => 'eventName',
            'datetime' => '2000-01-02 03:04:05',
        ]);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals('eventName', $event->getEvent());
        $this->assertEquals('2000-01-02 03:04:05', $event->getDate()->format('Y-m-d H:i:s'));
        $this->assertEquals('UTC', $event->getDate()->getTimezone()->getName());
    }
}