<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 15:24
 */

namespace SmartSender\Tests\V3\ContactList;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\ContactList\Variable;
use SmartSender\V3\Exceptions\VariableException;

class VariableTest extends TestCase
{
    public function testReservedNames()
    {
        $this->assertIsArray(Variable::RESERVED_NAMES);
        $this->assertContains('name', Variable::RESERVED_NAMES);
        $this->assertContains('email', Variable::RESERVED_NAMES);
        $this->assertContains('phonenumber', Variable::RESERVED_NAMES);
        $this->assertContains('externalid', Variable::RESERVED_NAMES);
        $this->assertContains('createdat', Variable::RESERVED_NAMES);

        $this->expectException(VariableException::class);

        new Variable('phoneNumber', Variable::ENUM_STRING);
    }

    public function testReservedEmail()
    {
        $this->expectException(VariableException::class);

        new Variable('testVariableName', 'someNotAllowedEnum');
    }
}