<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 12:12
 */

namespace SmartSender\Tests\V3\Mailer;


use PHPUnit\Framework\TestCase;
use SmartSender\V3\Email\Email;
use SmartSender\V3\Email\Target;

class EmailTest extends TestCase
{
    public function testToArray()
    {
        $email = new Email();
        $email->setFrom(new Target('from@example.com', 'From'));
        $email->setTo(new Target('to@example.com', 'To'));
        $email->setReplyTo(new Target('replyTo@example.com'));
        $email->setSubject('subj');
        $email->setHtml('html');
        $email->setText('text');
        $email->addHeader('header', 'value');
        $email->addTag('tag');
        $email->setPriority(3);

        $array = $email->__toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('from', $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('subject', $array);
        $this->assertArrayHasKey('html', $array);
        $this->assertArrayHasKey('text', $array);
        $this->assertArrayHasKey('headers', $array);
        $this->assertArrayHasKey('tags', $array);
        $this->assertArrayHasKey('priority', $array);

        $this->assertIsArray($array['from']);
        $this->assertArrayHasKey('email', $array['from']);
        $this->assertArrayHasKey('name', $array['from']);
        $this->assertEquals('from@example.com', $array['from']['email']);
        $this->assertEquals('From', $array['from']['name']);

        $this->assertIsArray($array['to']);
        $this->assertArrayHasKey('email', $array['to']);
        $this->assertArrayHasKey('name', $array['to']);
        $this->assertEquals('to@example.com', $array['to']['email']);
        $this->assertEquals('To', $array['to']['name']);

        $this->assertIsArray($array['replyTo']);
        $this->assertArrayHasKey('email', $array['replyTo']);
        $this->assertArrayHasKey('name', $array['replyTo']);
        $this->assertEquals('replyTo@example.com', $array['replyTo']['email']);
        $this->assertNull($array['replyTo']['name']);


        $this->assertEquals('subj', $array['subject']);
        $this->assertEquals('html', $array['html']);
        $this->assertEquals('text', $array['text']);

        $this->assertIsArray($array['headers']);
        $this->assertArrayHasKey('header', $array['headers']);
        $this->assertEquals('value', $array['headers']['header']);

        $this->assertIsArray($array['tags']);
        $this->assertContains('tag', $array['tags']);
    }
}