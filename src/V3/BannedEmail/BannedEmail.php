<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 16:21
 */

namespace SmartSender\V3\BannedEmail;


class BannedEmail
{

    /** @var string */
    protected $email = '';

    /** @var string */
    protected $type = '';

    /** @var string */
    protected $rawLog = '';

    /** @var \DateTime|null */
    protected $expiredAt;

    public function __construct(string $email = '', string $type = '', string $rawLog = '')
    {
        $this->email  = $email;
        $this->type   = $type;
        $this->rawLog = $rawLog;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return BannedEmail
     */
    public function setEmail(string $email): BannedEmail
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return BannedEmail
     */
    public function setType(string $type): BannedEmail
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getRawLog(): string
    {
        return $this->rawLog;
    }

    /**
     * @param string $rawLog
     *
     * @return BannedEmail
     */
    public function setRawLog(string $rawLog): BannedEmail
    {
        $this->rawLog = $rawLog;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpiredAt(): ?\DateTime
    {
        return $this->expiredAt;
    }

    /**
     * @param \DateTime|null $expiredAt
     *
     * @return BannedEmail
     */
    public function setExpiredAt(?\DateTime $expiredAt): BannedEmail
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }


    public function __toArray()
    {
        return [
            'email'     => $this->getEmail(),
            'type'      => $this->getType(),
            'rawLog'    => $this->getRawLog(),
            'expiredAt' => !$this->getExpiredAt() ?: $this->getExpiredAt()->format('Y-m-d H:i:s'),
        ];
    }
}