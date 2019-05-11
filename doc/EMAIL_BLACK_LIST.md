# Client for blacklisted emails managing

## Add banned email addresses
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$emailBlackList = new \SmartSender\V3\Client\EmailBlackList($adapter);

$first = new \SmartSender\V3\BannedEmail\BannedEmail();
$first->setEmail('first@example.com');
$first->setType(\SmartSender\V3\BannedEmail\BannedEmail::TYPE_HARD);
$first->setRawLog('creating by setters');

$add = [
    $first,
    new \SmartSender\V3\BannedEmail\BannedEmail('second@example.com',
        \SmartSender\V3\BannedEmail\BannedEmail::TYPE_COMPLAINT, 'creating by class constructor'),
];
$result = $emailBlackList->add($add);
```

## Paginate banned emails
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$emailBlackList = new \SmartSender\V3\Client\EmailBlackList($adapter);

/** @var \SmartSender\V3\BannedEmail\BannedEmailPagination $pagination */
$pagination = $emailBlackList->paginate('', 'complaint'); // empty parameters will paginate all records

echo 'Records count: ' . $pagination->getTotalCount() . PHP_EOL;
echo 'Records per page (limit): ' . $pagination->getLimit() . PHP_EOL;
echo 'Records offset: ' . $pagination->getOffset() . PHP_EOL;

foreach ($pagination->getBannedEmails() as $bannedEmail) {
    
    /** @var \SmartSender\V3\BannedEmail\BannedEmail $bannedEmail */
    echo $bannedEmail->getEmail() . ' ' . $bannedEmail->getType() . ' ' . $bannedEmail->getExpireAt()
                                                                                      ->format('Y-m-d H:i:s') . PHP_EOL;
}
```

## Remove emails from black list
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$emailBlackList = new \SmartSender\V3\Client\EmailBlackList($adapter);

$result = $emailBlackList->remove('example@example.com', '');
```