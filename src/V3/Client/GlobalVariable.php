<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 10.05.19
 * Time: 13:18
 */

namespace SmartSender\V3\Client;


use SmartSender\V3\Adapter\Response;

class GlobalVariable extends BaseClient
{

    /**
     * @param \SmartSender\V3\GlobalVariable\GlobalVariable $globalVariable
     *
     * @return bool
     */
    public function create(\SmartSender\V3\GlobalVariable\GlobalVariable $globalVariable): bool
    {
        /** @var Response $response */
        $response = $this->adapter->request('global-variables/create', $globalVariable->__toArray());

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $name
     *
     * @return \SmartSender\V3\GlobalVariable\GlobalVariable
     */
    public function findOne(string $name): \SmartSender\V3\GlobalVariable\GlobalVariable
    {
        /** @var Response $response */
        $response = $this->adapter->request('global-variables/create', [
            'name' => $name,
        ]);

        return \SmartSender\V3\GlobalVariable\GlobalVariable::createFromArray($response->getParsedBody());
    }

    /**
     * @return \SmartSender\V3\GlobalVariable\GlobalVariable[]
     */
    public function all(): array
    {
        /** @var Response $response */
        $response = $this->adapter->request('global-variables/all');

        $globalVariables = [];
        foreach($response->getParsedBody() as $globalVariable) {
            $globalVariables[] = \SmartSender\V3\GlobalVariable\GlobalVariable::createFromArray($globalVariable);
        }

        return $globalVariables;
    }

    /**
     * @param \SmartSender\V3\GlobalVariable\GlobalVariable $globalVariable
     *
     * @return bool
     */
    public function update(\SmartSender\V3\GlobalVariable\GlobalVariable $globalVariable): bool
    {
        /** @var Response $response */
        $response = $this->adapter->request('global-variables/update', $globalVariable->__toArray());

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    /**
     * @param \SmartSender\V3\GlobalVariable\GlobalVariable $globalVariable
     *
     * @return bool
     */
    public function remove(\SmartSender\V3\GlobalVariable\GlobalVariable $globalVariable): bool
    {
        /** @var Response $response */
        $response = $this->adapter->request('global-variables/remove', $globalVariable->__toArray());

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }
}