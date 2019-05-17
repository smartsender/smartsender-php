<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 18:47
 */

namespace SmartSender\V3\Client;


use SmartSender\V3\Adapter\Response;
use SmartSender\V3\Contact\Contact;
use SmartSender\V3\Contact\Variable;
use SmartSender\V3\Exceptions\SmartSenderException;

class ContactList extends BaseClient
{

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
        $response = $this->adapter->request('/v3/contacts/add', $request);

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
        $response = $this->adapter->request('/v3/contacts/update', $request);

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
        $response = $this->adapter->request('/v3/contacts/remove', [
            'contactListId' => $contactListId,
            'emails'        => $contacts,
        ]);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }

    /**
     * @param string $contactListId
     * @param array  $variables
     *
     * @return bool
     * @throws SmartSenderException
     */
    public function addVariablesToContactList(string $contactListId, array $variables = []): bool
    {
        $request = [
            'contactListId' => $contactListId,
            'variables'     => [],
        ];

        foreach ($variables as $variable) {
            if (!$variable instanceof Variable) {
                throw new SmartSenderException('variable must be an instance of ' . Variable::class);
            }
            $request['variables'][] = $variable->__toArray();
        }

        /** @var Response $response */
        $response = $this->adapter->request('/v3/contact-list/variables/add', $request);

        $parsed = $response->getParsedBody();

        return isset($parsed['result']) ? boolval($parsed['result']) : false;
    }
}