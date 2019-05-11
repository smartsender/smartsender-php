<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 11.05.19
 * Time: 14:19
 */

namespace SmartSender\Tests\V3\Contact;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Contact\Contact;
use SmartSender\V3\Contact\Variable;

class ContactTest extends TestCase
{
    public function testToArrayContactWithVariable()
    {
        $contact = new Contact('contact@example.com');

        $this->assertEquals('contact@example.com', $contact->getEmail());

        $contact->setPhone('+12341111111');
        $contact->setName('testName');
        $contact->setIsActive(true);
        $contact->setExternalId('testExternalId');
        $contact->addVariable(new Variable('varName', 'varValue'));

        $array = $contact->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('contact', $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('externalId', $array);
        $this->assertArrayHasKey('active', $array);
        $this->assertArrayHasKey('phoneNumber', $array);
        $this->assertArrayHasKey('variables', $array);

        $this->assertEquals('contact@example.com', $array['contact']);
        $this->assertEquals('contact@example.com', $array['email']);
        $this->assertEquals('testName', $array['name']);
        $this->assertEquals('testExternalId', $array['externalId']);
        $this->assertEquals('+12341111111', $array['phoneNumber']);
        $this->assertIsBool($array['active']);
        $this->assertTrue($array['active']);
        $this->assertIsArray($array['variables']);
        $this->assertCount(1, $array['variables']);
        $this->assertArrayHasKey('name', $array['variables'][0]);
        $this->assertArrayHasKey('value', $array['variables'][0]);
        $this->assertEquals('varName', $array['variables'][0]['name']);
        $this->assertEquals('varValue', $array['variables'][0]['value']);


        // NB!: important for contact updating. Email field can be changed instead of contact field
        //      that is used as identifier
        $contact->setEmail('new@example.com');

        $modified = $contact->__toArray();
        $this->assertIsArray($array);
        $this->assertArrayHasKey('contact', $modified);
        $this->assertArrayHasKey('email', $modified);
        $this->assertEquals('contact@example.com', $modified['contact']);
        $this->assertEquals('new@example.com', $modified['email']);
    }
}