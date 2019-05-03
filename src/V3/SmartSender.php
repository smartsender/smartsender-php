<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 19:19
 */

namespace SmartSender\V3;


use SmartSender\V3\Adapter\AdapterInterface;
use SmartSender\V3\Adapter\Response;
use SmartSender\V3\Exceptions\SmartSenderException;
use SmartSender\V3\Mailer\Email;

class SmartSender
{
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

    public function sendEmail(Email $email): Email
    {
        /** @var Response $response */
        $response = $this->adapter->request('mailer/send', $email->__toArray());

        $parsed = $response->getParsedBody();
        if (!isset($parsed['messageId']) || empty($parsed['messageId'])) {
            throw new SmartSenderException("empty message id in response. Please contact support@smartsender.io");
        }

        $email->setId($parsed['messageId']);

        return $email;
    }
}