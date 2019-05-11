# Sending SMS and getting info about SMS

# Send simple SMS
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$smsClient       = new \SmartSender\V3\Client\Sms($adapter);

$sms = new \SmartSender\V3\Sms\Sms();
$sms->setFromName('SenderID');
$sms->setTo('+12341111111');
$sms->setText('Your text');
$sms->addTag('someTag');

$sms = $smsClient->sendSms($sms);

echo $sms->getId() . PHP_EOL;
``` 

## Send trigger SMS
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$smsClient       = new \SmartSender\V3\Client\Sms($adapter);

$trigger = new \SmartSender\V3\Sms\TriggerSms();
$trigger->setContactListId('yourContactListId');
$trigger->setContact('+12341111111');
$trigger->setFromName('SenderID');
$trigger->setText('Hello, {{myVariable}}!');
$trigger->addTag('someTag');
$trigger->addVariable(new \SmartSender\V3\Contact\Variable('myVariable', 'World'));

$trigger = $smsClient->sendTriggerSms($trigger);

echo $trigger->getId() . PHP_EOL;
```

## Getting information about SMS messages
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$smsClient       = new \SmartSender\V3\Client\Sms($adapter);

$smsMessages = $smsClient->getSmsInfo([
    '5cd5445819b605065f756c91',
    '5cd5473f19b605065f756c92',
]);

foreach ($smsMessages as $sms) {

    /** @var SmartSender\V3\Sms\Sms $sms */
    echo $sms->getId() . ' ' . $sms->getStatus() . ' ' . $sms->getFromName() . ' ' . $sms->getCreatedAt()
                                                                                         ->format('Y-m-d H:i:s') . PHP_EOL;
}
```