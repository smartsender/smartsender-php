# SmartSender SDK (v3 API Binding for PHP 7)

## Installation

```$xslt
composer require smartsender/smartsender-php
```

## SmartSender API version 3

The SmartSender API can be found [here](https://kb.smartsender.io/doc/api-documentation/).

## Getting Started


```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$mailer = new \SmartSender\V3\Client\Mailer($adapter);
        
try {
    
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

Note that this repository is currently under development, additional classes and endpoints being actively added.
