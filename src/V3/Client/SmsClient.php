<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 19:18
 */

namespace SmartSender\V3\Client;


use SmartSender\V3\Adapter\Response;
use SmartSender\V3\Exceptions\SmartSenderException;
use SmartSender\V3\Sms\Sms;
use SmartSender\V3\Sms\TriggerSms;

class SmsClient extends BaseClient
{

    /**
     * @param Sms $sms
     *
     * @return Sms
     * @throws SmartSenderException
     */
    public function sendSms(Sms $sms): Sms
    {
        /** @var Response $response */
        $response = $this->adapter->request('sms/send', $sms->__toArray());

        $parsed = $response->getParsedBody();
        if (!isset($parsed['sms_id']) || empty($parsed['sms_id'])) {
            throw new SmartSenderException("empty SMS id in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $sms->setId($parsed['sms_id']);

        return $sms;
    }

    /**
     * @param TriggerSms $triggerSms
     *
     * @return TriggerSms
     * @throws SmartSenderException
     */
    public function sendTriggerSms(TriggerSms $triggerSms): TriggerSms
    {
        /** @var Response $response */
        $response = $this->adapter->request('sms/trigger', $triggerSms->__toArray());

        $parsed = $response->getParsedBody();
        if (!isset($parsed['sms_id']) || empty($parsed['sms_id'])) {
            throw new SmartSenderException("empty SMS id in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $triggerSms->setId($parsed['sms_id']);

        return $triggerSms;
    }

    /**
     * @param array $ids
     *
     * @return array
     * @throws SmartSenderException
     */
    public function getSmsInfo(array $ids): array
    {
        /** @var Response $response */
        $response = $this->adapter->request('sms/info', ['ids' => $ids]);

        $parsed = $response->getParsedBody();
        if (!isset($parsed['data']) || !is_array($parsed['data'])) {
            throw new SmartSenderException("empty data in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $return = [];
        foreach ($parsed['data'] as $array) {
            $return[] = Sms::createFromArray($array);
        }

        return $return;
    }
}