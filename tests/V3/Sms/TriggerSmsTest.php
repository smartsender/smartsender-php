<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 16:33
 */

namespace SmartSender\Tests\V3\Sms;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Contact\Variable;
use SmartSender\V3\Sms\TriggerSms;

class TriggerSmsTest extends TestCase
{

    public function testToArray()
    {
        $trigger = new TriggerSms();
        $trigger->setId('testId');
        $trigger->setContact('testContact');
        $trigger->setContactListId('testContactListId');
        $trigger->setFromName('testFromName');
        $trigger->setText('testText');
        $trigger->addTag('testTag');
        $trigger->addVariable(new Variable('testVarName', 'testVarValue'));

        $array = $trigger->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('contact', $array);
        $this->assertArrayHasKey('contactListId', $array);
        $this->assertArrayHasKey('fromName', $array);
        $this->assertArrayHasKey('text', $array);
        $this->assertArrayHasKey('tags', $array);
        $this->assertArrayHasKey('variables', $array);

        $this->assertEquals('testId', $array['id']);
        $this->assertEquals('testContact', $array['contact']);
        $this->assertEquals('testContactListId', $array['contactListId']);
        $this->assertEquals('testFromName', $array['fromName']);
        $this->assertEquals('testText', $array['text']);
        $this->assertIsArray($array['tags']);
        $this->assertCount(1, $array['tags']);
        $this->assertEquals('testTag', $array['tags'][0]);
        $this->assertIsArray($array['variables']);
        $this->assertCount(1, $array['variables']);
        $this->assertIsArray($array['variables'][0]);
        $this->assertArrayHasKey('name', $array['variables'][0]);
        $this->assertArrayHasKey('value', $array['variables'][0]);
        $this->assertEquals('testVarName', $array['variables'][0]['name']);
        $this->assertEquals('testVarValue', $array['variables'][0]['value']);
    }
}