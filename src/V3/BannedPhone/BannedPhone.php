<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 17:43
 */

namespace SmartSender\V3\BannedPhone;

class BannedPhone
{

    const TYPE_IMPORT        = 'import';
    const TYPE_INVALID       = 'invalid';
    const TYPE_UNSUBSCRIBE   = 'unsubscribe';
    const TYPE_UNDELIVERABLE = 'undeliverable';

    const ALLOWED_TYPES = [
        self::TYPE_IMPORT,
        self::TYPE_INVALID,
        self::TYPE_UNSUBSCRIBE,
        self::TYPE_UNDELIVERABLE,
    ];

    /** @var string */
    protected $phone = '';

    /** @var string */
    protected $rejectType = '';

    /** @var \DateTime|null */
    protected $createdAt;

    /**
     * BannedPhone constructor.
     *
     * @param string $phone
     * @param string $type
     */
    public function __construct(string $phone, string $rejectType)
    {
        if (!in_array($rejectType, self::ALLOWED_TYPES)) {
            $rejectType = self::TYPE_IMPORT;
        }

        $this->phone      = $phone;
        $this->rejectType = $rejectType;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return BannedPhone
     */
    public function setPhone(string $phone): BannedPhone
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getRejectType(): string
    {
        return $this->rejectType;
    }

    /**
     * @param string $rejectType
     *
     * @return BannedPhone
     */
    public function setRejectType(string $rejectType): BannedPhone
    {
        $this->rejectType = $rejectType;

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
     * @param \DateTime $createdAt
     *
     * @return BannedPhone
     */
    public function setCreatedAt(\DateTime $createdAt): BannedPhone
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toArray(): array
    {
        return [
            'phoneNumber' => $this->getPhone(),
            'rejectType'  => $this->getRejectType(),
            'createdAt'   => !$this->getCreatedAt() ?: $this->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    public static function createFromArray(array $array): BannedPhone
    {
        $bannedPhone = new static(isset($array['phoneNumber']) ? strval($array['phoneNumber']) : '',
            isset($array['rejectType']) ? $array['rejectType'] : '');

        if (isset($array['createdAt'])
            && $createdAt = \DateTime::createFromFormat('Y-m-d H:i:s', $array['createdAt'], new \DateTimeZone('UTC'))) {
            $bannedPhone->setCreatedAt($createdAt);
        }

        return $bannedPhone;
    }

}