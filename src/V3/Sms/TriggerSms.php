<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 08.05.19
 * Time: 19:26
 */

namespace SmartSender\V3\Sms;


use SmartSender\V3\Contact\Variable;

class TriggerSms
{

    /** @var string|null */
    protected $id;

    /** @var string */
    protected $contactListId = '';

    /** @var string */
    protected $contact = '';

    /** @var string */
    protected $text = '';

    /** @var string */
    protected $fromName = '';

    /** @var array */
    protected $tags = [];

    /** @var Variable[] */
    protected $variables = [];

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
     * @return TriggerSms
     */
    public function setId(string $id): TriggerSms
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactListId(): string
    {
        return $this->contactListId;
    }

    /**
     * @param string $contactListId
     *
     * @return TriggerSms
     */
    public function setContactListId(string $contactListId): TriggerSms
    {
        $this->contactListId = $contactListId;

        return $this;
    }

    /**
     * @return string
     */
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     *
     * @return TriggerSms
     */
    public function setContact(string $contact): TriggerSms
    {
        $this->contact = $contact;

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
     * @return TriggerSms
     */
    public function setText(string $text): TriggerSms
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
     * @return TriggerSms
     */
    public function setFromName(string $fromName): TriggerSms
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string $tag
     *
     * @return TriggerSms
     */
    public function addTag(string $tag): TriggerSms
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return Variable[]
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * @param Variable $variable
     *
     * @return TriggerSms
     */
    public function addVariable(Variable $variable): TriggerSms
    {
        $this->variables[] = $variable;

        return $this;
    }

    public function __toArray(): array
    {
        $array = [
            'id'            => $this->getId(),
            'contactListId' => $this->getContactListId(),
            'contact'       => $this->getContact(),
            'text'          => $this->getText(),
            'fromName'      => $this->getFromName(),
            'tags'          => $this->getTags(),
            'variables'     => [],
        ];

        foreach ($this->getVariables() as $variable) {
            $array['variables'][] = $variable->__toArray();
        }

        return $array;
    }
}