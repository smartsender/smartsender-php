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
use SmartSender\V3\BannedEmail\BannedEmail;
use SmartSender\V3\BannedEmail\Pagination;
use SmartSender\V3\Contact\Contact;
use SmartSender\V3\ContactList\Variable;
use SmartSender\V3\Exceptions\SmartSenderException;
use SmartSender\V3\Mailer\Email;
use SmartSender\V3\Mailer\TriggerEmail;

class SmartSender
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

    /**
     * @param Email $email
     *
     * @return Email
     * @throws SmartSenderException
     */
    public function sendEmail(Email $email): Email
    {
        /** @var Response $response */
        $response = $this->adapter->request('mailer/send', $email->__toArray());

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
        $response = $this->adapter->request('mailer/trigger', $triggerEmail->__toArray());

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
        $response = $this->adapter->request('mailer/info', ['ids' => $ids]);

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


    /**
     * @param array $bannedEmails
     *
     * @return bool
     * @throws SmartSenderException
     */
    public function addToBlackList(array $bannedEmails): bool
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
        $response = $this->adapter->request('blacklist/add', $request);

        $parsed = $response->getParsedBody();

        return ($parsed && isset($parsed['result'])) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $email
     * @param string $type
     * @param int    $offset
     * @param int    $limit
     *
     * @return Pagination
     * @throws SmartSenderException
     */
    public function paginateBlackList(string $email = '', string $type = '', $offset = 0, $limit = 20): Pagination
    {
        $pagination = new Pagination();
        $pagination->setOffset($offset);
        $pagination->setLimit($limit);

        if (!empty($email)) {
            $pagination->setEmail($email);
        }

        if (!empty($type)) {
            $pagination->setType($type);
        }

        /** @var Response $response */
        $response = $this->adapter->request('blacklist/find', $pagination->__toArray());
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
    public function removeFromBlackList(string $email, string $type = ''): bool
    {
        $request = [
            'email' => $email,
        ];

        if (!empty($type)) {
            $request['type'] = $type;
        }

        /** @var Response $response */
        $response = $this->adapter->request('blacklist/remove', $request);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $contactListId
     * @param array  $contacts
     *
     * @return bool
     * @throws SmartSenderException
     */
    public function addContacts(string $contactListId, array $contacts = []): bool
    {
        $request = [
            'contactListId' => $contactListId,
            'contacts'      => [],
        ];

        foreach ($contacts as $contact) {
            if (!$contact instanceof Contact) {
                throw new SmartSenderException('contact must be an instance of ' . Contact::class);
            }

            $request['contacts'][] = $contact->__toArray();
        }

        /** @var Response $response */
        $response = $this->adapter->request('contacts/add', $request);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $contactListId
     * @param array  $contacts
     * @param bool   $upsert
     *
     * @return bool
     * @throws SmartSenderException
     */
    public function updateContacts(string $contactListId, array $contacts = [], bool $upsert = false): bool
    {
        $request = [
            'contactListId' => $contactListId,
            'upsert'        => $upsert,
            'contacts'      => [],
        ];

        foreach ($contacts as $contact) {
            if (!$contact instanceof Contact) {
                throw new SmartSenderException('contact must be an instance of ' . Contact::class);
            }

            $request['contacts'][] = $contact->__toArray();
        }

        /** @var Response $response */
        $response = $this->adapter->request('contacts/update', $request);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $contactListId
     * @param array  $contacts
     *
     * @return bool
     */
    public function removeContacts(string $contactListId, array $contacts = []): bool
    {
        /** @var Response $response */
        $response = $this->adapter->request('contacts/remove', [
            'contactListId' => $contactListId,
            'emails'        => $contacts,
        ]);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    public function addVariablesToContactList(string $contactListId, array $variables = []): bool
    {
        $request = [
            'contactListId' => $contactListId,
            'variablesMetadata' => [],
        ];

        foreach($variables as $variable) {
            if (!$variable instanceof Variable) {
                throw new SmartSenderException('variable must be an instance of ' . Variable::class);
            }
            $request['variablesMetadata'][] = $variable->__toArray();
        }

        /** @var Response $response */
        $response = $this->adapter->request('contact-list/variables/add', $request);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }


}