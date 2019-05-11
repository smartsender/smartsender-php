<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 18:39
 */

namespace SmartSender\V3\Client;


use SmartSender\V3\Adapter\Response;
use SmartSender\V3\BannedPhone\BannedPhone;
use SmartSender\V3\BannedPhone\BannedPhonePagination;
use SmartSender\V3\Exceptions\BannedPhoneException;
use SmartSender\V3\Exceptions\SmartSenderException;

class PhoneBlackList extends BaseClient
{
    /**
     * @param BannedPhone[] $bannedPhones
     *
     * @return bool
     * @throws SmartSenderException
     */
    public function add(array $bannedPhones): bool
    {
        $request = [
            'records' => [],
        ];

        foreach ($bannedPhones as $bannedPhone) {
            if (!$bannedPhone instanceof BannedPhone) {
                throw new SmartSenderException('bannedPhone must be an instance of ' . BannedPhone::class);
            }

            if (!in_array($bannedPhone->getType(), BannedPhone::ALLOWED_TYPES)) {
                throw new BannedPhoneException('type ' . $bannedPhone->getType() . ' is not allowed');
            }

            $request['records'][] = $bannedPhone->__toArray();
        }

        /** @var Response $response */
        $response = $this->adapter->request('/phone-blacklist/add', $request);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $phone
     * @param string $type
     * @param int    $offset
     * @param int    $limit
     *
     * @return BannedPhonePagination
     * @throws SmartSenderException
     */
    public function paginate(string $phone = '', string $type = '', $offset = 0, $limit = 20): BannedPhonePagination
    {
        $pagination = new BannedPhonePagination();
        $pagination->setOffset($offset);
        $pagination->setLimit($limit);

        if (!empty($email)) {
            $pagination->setPhone($phone);
        }

        if (!empty($type)) {
            $pagination->setType($type);
        }

        /** @var Response $response */
        $response = $this->adapter->request('/phone-blacklist/find', $pagination->__toArray());
        $parsed   = $response->getParsedBody();

        if (!isset($parsed['data']) || !is_array($parsed['data']) || !isset($parsed['totalCount'])) {
            throw new SmartSenderException("no data in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $pagination->setTotalCount(intval($parsed['totalCount']));

        foreach ($parsed['data'] as $banned) {
            $pagination->addBannedPhone(BannedPhone::createFromArray($banned));
        }

        return $pagination;
    }

    /**
     * @param string $phone
     *
     * @return bool
     */
    public function remove(string $phone): bool
    {
        /** @var Response $response */
        $response = $this->adapter->request('/phone-blacklist/remove', [
            'phoneNumber' => $phone,
        ]);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }
}