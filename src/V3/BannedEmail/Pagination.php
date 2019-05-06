<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 17:57
 */

namespace SmartSender\V3\BannedEmail;

class Pagination
{
    /** @var int  */
    protected $offset = 0;

    /** @var int  */
    protected $limit = 0;

    /** @var int  */
    protected $totalCount = 0;

    /** @var string|null  */
    protected $email;

    /** @var string|null  */
    protected $type;

    /** @var BannedEmail[]  */
    protected $bannedEmails = [];

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return Pagination
     */
    public function setOffset(int $offset): Pagination
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return Pagination
     */
    public function setLimit(int $limit): Pagination
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     *
     * @return Pagination
     */
    public function setTotalCount(int $totalCount): Pagination
    {
        $this->totalCount = $totalCount;

        return $this;
    }

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
            'limit' => $this->limit,
            'email' => $this->email,
            'type' => $this->type,
        ];

        return $array;
    }
}