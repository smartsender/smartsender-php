<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 16:01
 */

namespace SmartSender\Tests\V3\GlobalVariable;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\GlobalVariable\GlobalVariable;

class GlobalVariableTest extends TestCase
{

    public function testToArray()
    {
        $date = new \DateTime('now', new \DateTimeZone('UTC'));

        $globalVariable = new GlobalVariable('testName', 'testValue');
        $globalVariable->setCreatedAt($date);

        $array = $globalVariable->__toArray();

        $this->assertIsArray($array);

        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('value', $array);
        $this->assertArrayHasKey('createdAt', $array);

        $this->assertEquals('testName', $array['name']);
        $this->assertEquals('testValue', $array['value']);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $array['createdAt']);
    }

    public function testCreateFromArray()
    {
        $globalVariable = GlobalVariable::createFromArray([
            'name'      => 'testName',
            'value'     => 'testValue',
            'createdAt' => '2000-01-02 03:04:05',
        ]);

        $this->assertInstanceOf(GlobalVariable::class, $globalVariable);
        $this->assertEquals('testName', $globalVariable->getName());
        $this->assertEquals('testValue', $globalVariable->getValue());
        $this->assertEquals('2000-01-02 03:04:05', $globalVariable->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('UTC', $globalVariable->getCreatedAt()->getTimezone()->getName());
    }
}