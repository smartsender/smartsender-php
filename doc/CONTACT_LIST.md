# Contact Lists managing

## Adding contacts
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$contactList     = new \SmartSender\V3\Client\ContactList($adapter);

$contact = new SmartSender\V3\Contact\Contact('first@example.com');
$contact->setIsActive(true);                        // optional
$contact->setName('First');                         // optional
$contact->setPhoneNumber('+12341111111');           // optional
$contact->setExternalId('contactIdInYourSystem');   // optional
$contact->addVariable(new \SmartSender\V3\Contact\Variable('varName', 'varValue')); // optional. Variable must be defined in contact list.

$result = $contactList->addContacts('yourContactListId', [
    $contact,
    new \SmartSender\V3\Contact\Contact('second@example.com'),
]);
```

## Updating contacts
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$contactList     = new \SmartSender\V3\Client\ContactList($adapter);

$contact = new SmartSender\V3\Contact\Contact('first@example.com');
$contact->setEmail('changed@example.com');  // optional
$contact->setIsActive(false);               // optional
$contact->setName('Changed');               // optional

$result = $contactList->updateContacts('yourContactListId', [
    $contact,
], false);
```

## Removing contacts
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$contactList     = new \SmartSender\V3\Client\ContactList($adapter);

$result = $contactList->removeContacts('yourContactListId', [
    'first@example.com',
    'second@example.com',
    'changed@example.com',
]);
```

## Adding variables to Contact List
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$contactList     = new \SmartSender\V3\Client\ContactList($adapter);

$result = $contactList->addVariablesToContactList('yourContactListId', [
    new \SmartSender\V3\ContactList\Variable('someStringVariable', \SmartSender\V3\ContactList\Variable::ENUM_STRING),
    new \SmartSender\V3\ContactList\Variable('someDateVariable', \SmartSender\V3\ContactList\Variable::ENUM_DATE),
]);
```