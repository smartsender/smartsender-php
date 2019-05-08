<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 19:00
 */

namespace SmartSender\V3\Sms;


class Sms
{

    /** @var string|null */
    protected $id;

    /** @var string|null */
    protected $status;

    /** @var string|null */
    protected $domain;

    /** @var string */
    protected $to = '';

    /** @var string */
    protected $text = '';

    /** @var string */
    protected $fromName = '';

    /** @var string[] */
    protected $tags = [];

    /** @var \DateTime|null */
    protected $createdAt;

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Sms
     */
    public function setId(string $id): Sms
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Sms
     */
    public function setStatus(string $status): Sms
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     *
     * @return Sms
     */
    public function setDomain(string $domain): Sms
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     *
     * @return Sms
     */
    public function setTo(string $to): Sms
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Sms
     */
    public function setText(string $text): Sms
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     *
     * @return Sms
     */
    public function setFromName(string $fromName): Sms
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string $tag
     *
     * @return Sms
     */
    public function addTag(string $tag): Sms
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return Sms
     */
    public function setCreatedAt(\DateTime $createdAt): Sms
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        return [
            'id'        => $this->getId(),
            'status'    => $this->getStatus(),
            'domain'    => $this->getDomain(),
            'to'        => $this->getTo(),
            'text'      => $this->getText(),
            'fromName'  => $this->getFromName(),
            'tags'      => $this->getTags(),
            'createdAt' => !$this->getCreatedAt() ?: $this->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    public static function createFromArray(array $array): Sms
    {
        $sms = new static();

        if (isset($array['id'])) {
            $sms->setId($array['id']);
        }

        if (isset($array['domain'])) {
            $sms->setDomain($array['domain']);
        }

        if (isset($array['status'])) {
            $sms->setStatus($array['status']);
        }

        $sms->setText(isset($array['text']) ? $array['text'] : '');
        $sms->setTo(isset($array['to']) ? $array['to'] : '');
        $sms->setFromName(isset($array['fromName']) ? $array['fromName'] : '');
        $sms->setFromName(isset($array['from']) ? $array['from'] : '');

        if (isset($array['createdAt'])
            && $createdAt = \DateTime::createFromFormat('Y-m-d H:i:s', $array['createdAt'], new \DateTimeZone('UTC'))) {
            $sms->setCreatedAt($createdAt);
        }

        return $sms;
    }


}