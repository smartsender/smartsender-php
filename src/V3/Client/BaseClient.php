<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 18:34
 */

namespace SmartSender\V3\Client;


use SmartSender\V3\Adapter\AdapterInterface;

class BaseClient
{

    const SUPPORT_EMAIL = 'support@smartsender.io';

    /** @var AdapterInterface */
    protected $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getInfo(): string
    {

        return 'SmartSender API V3';
    }
}