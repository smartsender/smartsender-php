# Mailer Client for sending Emails, Trigger Emails and getting info about Emails

## Send an Email

```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$mailer = new \SmartSender\V3\Client\Mailer($adapter);

$email = new \SmartSender\V3\Email\Email();
$email->setFrom(new \SmartSender\V3\Email\Target('name@yourdomain.com', 'Your Name'));
$email->setTo(new \SmartSender\V3\Email\Target('someone@example.com'));
$email->setReplyTo(new \SmartSender\V3\Email\Target('reply@yourdomain.com', 'ReplyTo'));
$email->setSubject('Hello World subject');
$email->setHtml('<p>Hello World!</p>'); 
   
$email = $mailer->sendEmail($email);

echo $email->getId();
```

## Send a Trigger
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$mailer = new \SmartSender\V3\Client\Mailer($adapter);

$trigger = new \SmartSender\V3\Email\TriggerEmail();
$trigger->setContactListId('contactListId');
$trigger->setContact('contactEmailAddress');
$trigger->setTemplateId('templateId');
$trigger->addTag('someTag');
$trigger->addVariable(new \SmartSender\V3\Contact\Variable('newVariableName1', 'newVariableValue1'));

$trigger = $mailer->sendTriggerEmail($trigger);

echo $trigger->getId();
```

## Get Info
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$mailer = new \SmartSender\V3\Client\Mailer($adapter);

$info = $mailer->getEmailInfo([
    '5cd008bb19b60545d0026c54',
    '5cd0059219b60545d0026c53',
    '5cd0057b19b60545d0026c52',
]);

foreach ($info as $email) {

    /** @var \SmartSender\V3\Email\Email $email */
    echo $email->getId() . PHP_EOL;
    
    foreach ($email->getEvents() as $event) {
    
        /** @var \SmartSender\V3\Email\Event $event */
        echo $event->getEvent() . " " . $event->getDate()->format('Y-m-d H:i:s') . PHP_EOL;
    }
}
```