<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 15:56
 */

namespace SmartSender\Tests\V3\Email;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Email\Target;

class TargetTest extends TestCase
{

    public function testToArray()
    {
        $target = new Target('test@example.com', 'testName');

        $array = $target->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertEquals('test@example.com', $array['email']);
        $this->assertEquals('testName', $array['name']);
    }
}