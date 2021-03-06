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

    const TYPE_HARD         = 'hard';
    const TYPE_COMPLAINT    = 'complaint';
    const TYPE_UNSUBSCRIBED = 'list-unsubscribe';

    const ALLOWED_TYPES = [
        self::TYPE_HARD,
        self::TYPE_COMPLAINT,
        self::TYPE_UNSUBSCRIBED,
    ];

    /** @var string|null */
    protected $email;

    /** @var string|null */
    protected $rejectType;

    /** @var string|null */
    protected $rawLog;

    /** @var \DateTime|null */
    protected $createdAt;

    /** @var \DateTime|null */
    protected $expireAt;

    public function __construct(string $email = null, string $rejectType = null, string $rawLog = null)
    {
        $this->email      = $email;
        $this->rejectType = $rejectType;
        $this->rawLog     = $rawLog;
    }

    /**
     * @return string|null
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
     * @return string|null
     */
    public function getRejectType(): string
    {
        return $this->rejectType;
    }

    /**
     * @param string $rejectType
     *
     * @return BannedEmail
     */
    public function setRejectType(string $rejectType): BannedEmail
    {
        $this->rejectType = $rejectType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRawLog()
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
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     *
     * @return BannedEmail
     */
    public function setCreatedAt(?\DateTime $createdAt): BannedEmail
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpireAt(): ?\DateTime
    {
        return $this->expireAt;
    }

    /**
     * @param \DateTime|null $expireAt
     *
     * @return BannedEmail
     */
    public function setExpireAt(?\DateTime $expireAt): BannedEmail
    {
        $this->expireAt = $expireAt;

        return $this;
    }


    public function __toArray()
    {
        return [
            'email'      => $this->getEmail(),
            'rejectType' => $this->getRejectType(),
            'rawLog'     => $this->getRawLog(),
            'createdAt'  => !$this->getCreatedAt() ?: $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'expireAt'   => !$this->getExpireAt() ?: $this->getExpireAt()->format('Y-m-d H:i:s'),
        ];
    }

    public static function createFromArray(array $array): BannedEmail
    {
        $bannedEmail = new static();
        if (isset($array['email']) && !empty($array['email'])) {
            $bannedEmail->setEmail(strval($array['email']));
        }
        if (isset($array['rejectType']) && !empty($array['rejectType'])) {
            $bannedEmail->setRejectType(strval($array['rejectType']));
        }
        if (isset($array['rawLog']) && !empty($array['rawLog'])) {
            $bannedEmail->setRawLog(strval($array['rawLog']));
        }
        if (isset($array['createdAt'])
            && $createdAt = \DateTime::createFromFormat('Y-m-d H:i:s', $array['createdAt'], new \DateTimeZone('UTC'))) {
            $bannedEmail->setCreatedAt($createdAt);
        }

        if (isset($array['expireAt'])
            && $expiredAt = \DateTime::createFromFormat('Y-m-d H:i:s', $array['expireAt'], new \DateTimeZone('UTC'))) {
            $bannedEmail->setExpireAt($expiredAt);
        }

        return $bannedEmail;
    }
}