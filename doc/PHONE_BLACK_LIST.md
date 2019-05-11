# Client for blacklisted phone numbers managing

## Add banned phone numbers
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$phoneBlackList = new \SmartSender\V3\Client\PhoneBlackList($adapter);

$result = $phoneBlackList->add([
    new SmartSender\V3\BannedPhone\BannedPhone('+12341111111', \SmartSender\V3\BannedPhone\BannedPhone::TYPE_UNSUBSCRIBE),
    new SmartSender\V3\BannedPhone\BannedPhone('+12342222222', \SmartSender\V3\BannedPhone\BannedPhone::TYPE_IMPORT),
]);
```

## Paginate banned phone numbers
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$phoneBlackList = new \SmartSender\V3\Client\PhoneBlackList($adapter);

/** @var \SmartSender\V3\BannedPhone\BannedPhonePagination $pagination */
$pagination = $phoneBlackList->paginate('', \SmartSender\V3\BannedPhone\BannedPhone::TYPE_IMPORT);

echo 'Records count: ' . $pagination->getTotalCount() . PHP_EOL;
echo 'Records per page (limit): ' . $pagination->getLimit() . PHP_EOL;
echo 'Records offset: ' . $pagination->getOffset() . PHP_EOL;

foreach ($pagination->getBannedPhones() as $bannedPhone) {

    /** @var \SmartSender\V3\BannedPhone\BannedPhone $bannedPhone */
    echo $bannedPhone->getPhone() . ' ' . $bannedPhone->getType() . ' ' . $bannedPhone->getCreatedAt()
                                                                                      ->format('Y-m-d H:i:s') . PHP_EOL;
}
```

## Remove phone from phones black list
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$phoneBlackList = new \SmartSender\V3\Client\PhoneBlackList($adapter);

$result = $phoneBlackList->remove('+12341111111');
```