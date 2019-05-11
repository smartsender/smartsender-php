# Global Variables management

## Adding
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$globalVariableClient = new \SmartSender\V3\Client\GlobalVariable($adapter);

$result = $globalVariableClient->create(new \SmartSender\V3\GlobalVariable\GlobalVariable('variableName', 'variableValue'));
```

## List all global variables
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$globalVariableClient = new \SmartSender\V3\Client\GlobalVariable($adapter);

$globalVariables = $globalVariableClient->all();
foreach ($globalVariables as $globalVariable) {

    /** @var \SmartSender\V3\GlobalVariable\GlobalVariable $globalVariable */
    echo $globalVariable->getName() . ': ' . $globalVariable->getValue() . ' ' . $globalVariable->getCreatedAt()
                                                                                                ->format('Y-m-d H:i:s')
    ;
}
```

## Updating
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$globalVariableClient = new \SmartSender\V3\Client\GlobalVariable($adapter);

$result = $globalVariableClient->update(new \SmartSender\V3\GlobalVariable\GlobalVariable('variableName', 'nextVariableValue'));
```

## Removing
```php
$accessToken = new \SmartSender\V3\Auth\AccessToken('putYourAccessTokenHere');
$adapter = new \SmartSender\V3\Adapter\CurlAdapter($accessToken);

$globalVariableClient = new \SmartSender\V3\Client\GlobalVariable($adapter);

$result = $globalVariableClient->remove(new \SmartSender\V3\GlobalVariable\GlobalVariable('variableName'));
```