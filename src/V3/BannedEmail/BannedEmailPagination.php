<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 17:57
 */

namespace SmartSender\V3\BannedEmail;

use SmartSender\V3\Pagination;

class BannedEmailPagination extends Pagination
{

    /** @var BannedEmail[] */
    protected $bannedEmails = [];

    /** @var string|null */
    protected $email;

    /** @var string|null */
    protected $type;

    /**
     * @return array
     */
    public function getBannedEmails(): array
    {
        return $this->bannedEmails;
    }

    /**
     * @param BannedEmail $bannedEmail
     *
     * @return Pagination
     */
    public function addBannedEmail(BannedEmail $bannedEmail): Pagination
    {
        $this->bannedEmails[] = $bannedEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Pagination
     */
    public function setEmail(string $email): Pagination
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Pagination
     */
    public function setType(string $type): Pagination
    {
        $this->type = $type;

        return $this;
    }

    public function __toArray(): array
    {
        $array = [
            'offset' => $this->offset,
            'limit'  => $this->limit,
            'email'  => $this->email,
            'type'   => $this->type,
        ];

        return $array;
    }
}