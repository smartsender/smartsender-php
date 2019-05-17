<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 18:35
 */

namespace SmartSender\V3\Client;


use SmartSender\V3\Adapter\Response;
use SmartSender\V3\Exceptions\SmartSenderException;
use SmartSender\V3\Email\Email;
use SmartSender\V3\Email\TriggerEmail;

class Mailer extends BaseClient
{

    /**
     * @param Email $email
     *
     * @return Email
     * @throws SmartSenderException
     */
    public function sendEmail(Email $email): Email
    {
        /** @var Response $response */
        $response = $this->adapter->request('/v3/mailer/send', $email->__toArray());

        $parsed = $response->getParsedBody();
        if (!isset($parsed['messageId']) || empty($parsed['messageId'])) {
            throw new SmartSenderException("empty message id in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $email->setId($parsed['messageId']);

        return $email;
    }

    /**
     * @param TriggerEmail $triggerEmail
     *
     * @return TriggerEmail
     * @throws SmartSenderException
     */
    public function sendTriggerEmail(TriggerEmail $triggerEmail): TriggerEmail
    {
        /** @var Response $response */
        $response = $this->adapter->request('/v3/mailer/trigger', $triggerEmail->__toArray());

        $parsed = $response->getParsedBody();
        if (!isset($parsed['messageId']) || empty($parsed['messageId'])) {
            throw new SmartSenderException("empty message id in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $triggerEmail->setId($parsed['messageId']);

        return $triggerEmail;
    }

    /**
     * @param array $ids
     *
     * @return array
     * @throws SmartSenderException
     */
    public function getEmailInfo(array $ids): array
    {
        /** @var Response $response */
        $response = $this->adapter->request('/v3/mailer/info', ['ids' => $ids]);

        $parsed = $response->getParsedBody();
        if (!isset($parsed['emails']) || !is_array($parsed['emails'])) {
            throw new SmartSenderException("empty emails in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $return = [];
        foreach ($parsed['emails'] as $array) {
            $return[] = Email::createFromArray($array);
        }

        return $return;
    }
}