# Request SmartSender API using adapter's request() method

```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter     = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

/** @var \SmartSender\V3\Adapter\Response $response */
$response = $adapter->request("/v3/mailer/send", [
    'from' => [
        'email' => 'name@yourdomain.com',
        'name' => 'Your Name',
    ],
    'to' => [
        'email' => 'someone@example.com',
    ],
    'replyTo' => [
        'email' => 'reply@yourdomain.com',
        'name' => 'ReplyTo',
    ],
    'subject' => "Hello World",
    'html' => "<p>Hello World!</p>",
    'text' => 'Hello World!',
    'tags' => [
        'someTag',
    ],
    'headers' => [
        'X-Additional-Header' => 'additional-header-value',
    ],
]);

// Response HTTP status
echo $response->getStatus() . PHP_EOL;

// Response HTTP headers
foreach($response->getHeaders() as $header => $value) {
    echo "$header: $value" . PHP_EOL;
}

// Response body
echo $response->getBody() . PHP_EOL;

// Response body parsed to array
var_dump($response->getParsedBody());
```