<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 13:03
 */

namespace SmartSender\Tests\V3\Mailer;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\ContactList\Variable;
use SmartSender\V3\Mailer\TriggerEmail;

class TriggerEmailTest extends TestCase
{

    public function testToArray()
    {
        $trigger = new TriggerEmail();
        $trigger->setContactListId('contactListId');
        $trigger->setContact('contact@example.com');
        $trigger->setTemplateId('templateId');
        $trigger->addTag('tag');
        $trigger->addVariable(new Variable('var', 'val'));

        $array = $trigger->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('contactListId', $array);
        $this->assertArrayHasKey('contact', $array);
        $this->assertArrayHasKey('templateId', $array);
        $this->assertArrayHasKey('tags', $array);
        $this->assertArrayHasKey('variables', $array);

        $this->assertEquals('contactListId', $array['contactListId']);
        $this->assertEquals('contact@example.com', $array['contact']);
        $this->assertEquals('templateId', $array['templateId']);

        $this->assertIsArray($array['tags']);
        $this->assertContains('tag', $array['tags']);

        $this->assertIsArray($array['variables']);
        $this->assertCount(1, $array['variables']);
        $this->assertIsArray($array['variables'][0]);
        $this->assertArrayHasKey('name', $array['variables'][0]);
        $this->assertArrayHasKey('value', $array['variables'][0]);
    }
}