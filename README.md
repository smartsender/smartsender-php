# SmartSender SDK (v3 API Binding for PHP 7)

## Installation

```$xslt
composer require smartsender/smartsender-php
```

or add to your composer.json file next row and then execute "composer install" command

```json
"require": {
  ...
  "smartsender/smartsender-php": ">=0.9.2",
  ...
}
```

## SmartSender API version 3

The SmartSender API can be found [here](https://kb.smartsender.io/doc/api-documentation/).

## Getting Started
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$mailer = new \SmartSender\V3\Client\Mailer($adapter);
        
try {
    
    // Almost all declared methods can throw an Exception, so you can catch it
    
    $email = new \SmartSender\V3\Email\Email();
        // Set parameters of Email
        // ...
                    
    $email = $mailer->sendEmail($email);
    echo $email->getId();
    
} catch(\SmartSender\V3\Exceptions\SmartSenderException $e) {
    echo $e->getMessage();
}
```

## SDK Documentation

- [x] [Mailer](/doc/MAILER.md)
- [x] [SMS messages](/doc/SMS.md)
- [x] [Contacts and Contact Lists](/doc/CONTACT_LIST.md)
- [x] [Email Black List](/doc/EMAIL_BLACK_LIST.md)
- [x] [Phone Black List](/doc/PHONE_BLACK_LIST.md)
- [x] [Global Variables](/doc/GLOBAL_VARIABLES.md)

Note that this repository is currently under development, additional classes and endpoints being actively added.
