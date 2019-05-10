<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 18:37
 */

namespace SmartSender\V3\Client;


use SmartSender\V3\Adapter\Response;
use SmartSender\V3\BannedEmail\BannedEmail;
use SmartSender\V3\BannedEmail\BannedEmailPagination;
use SmartSender\V3\Exceptions\SmartSenderException;

class EmailBlackList extends BaseClient
{
    /**
     * @param array $bannedEmails
     *
     * @return bool
     * @throws SmartSenderException
     */
    public function add(array $bannedEmails): bool
    {
        $request = [
            'records' => [],
        ];

        foreach ($bannedEmails as $bannedEmail) {
            if (!$bannedEmail instanceof BannedEmail) {
                throw new SmartSenderException('banned emails must be an instances of ' . BannedEmail::class);
            }

            $request['records'][] = $bannedEmail->__toArray();
        }

        /** @var Response $response */
        $response = $this->adapter->request('/blacklist/add', $request);

        $parsed = $response->getParsedBody();

        return ($parsed && isset($parsed['result'])) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $email
     * @param string $type
     * @param int    $offset
     * @param int    $limit
     *
     * @return BannedEmailPagination
     * @throws SmartSenderException
     */
    public function paginate(string $email = '', string $type = '', $offset = 0, $limit = 20): BannedEmailPagination
    {
        $pagination = new BannedEmailPagination();
        $pagination->setOffset($offset);
        $pagination->setLimit($limit);

        if (!empty($email)) {
            $pagination->setEmail($email);
        }

        if (!empty($type)) {
            $pagination->setType($type);
        }

        /** @var Response $response */
        $response = $this->adapter->request('/blacklist/find', $pagination->__toArray());
        $parsed   = $response->getParsedBody();

        if (!isset($parsed['data']) || !is_array($parsed['data']) || !isset($parsed['totalCount'])) {
            throw new SmartSenderException("no data in response. Please contact " . self::SUPPORT_EMAIL);
        }

        $pagination->setTotalCount(intval($parsed['totalCount']));

        foreach ($parsed['data'] as $banned) {
            $pagination->addBannedEmail(BannedEmail::createFromArray($banned));
        }

        return $pagination;
    }

    /**
     * @param string $email
     * @param string $type
     *
     * @return bool
     * @throws
     */
    public function remove(string $email, string $type = ''): bool
    {
        $request = [
            'email' => $email,
        ];

        if (!empty($type)) {
            $request['type'] = $type;
        }

        /** @var Response $response */
        $response = $this->adapter->request('/blacklist/remove', $request);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }
}