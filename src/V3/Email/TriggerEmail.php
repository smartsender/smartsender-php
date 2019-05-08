<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 19:49
 */

namespace SmartSender\V3\Email;


use SmartSender\V3\Contact\Variable;

class TriggerEmail
{

    /** @var string */
    protected $id = '';

    /** @var string */
    protected $contactListId = '';

    /** @var string */
    protected $contact = '';

    /** @var string */
    protected $templateId = '';

    /** @var array */
    protected $tags = [];

    /** @var Variable[] */
    protected $variables = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return TriggerEmail
     */
    public function setId(string $id): TriggerEmail
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
     * @return TriggerEmail
     */
    public function setContactListId(string $contactListId): TriggerEmail
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
     * @return TriggerEmail
     */
    public function setContact(string $contact): TriggerEmail
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateId(): string
    {
        return $this->templateId;
    }

    /**
     * @param string $templateId
     *
     * @return TriggerEmail
     */
    public function setTemplateId(string $templateId): TriggerEmail
    {
        $this->templateId = $templateId;

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
     * @return TriggerEmail
     */
    public function addTag(string $tag): TriggerEmail
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * @param Variable $variable
     *
     * @return TriggerEmail
     */
    public function addVariable(Variable $variable): TriggerEmail
    {
        $this->variables[] = $variable;

        return $this;
    }

    public function __toArray()
    {
        $array = [
            'id'            => $this->getId(),
            'contactListId' => $this->getContactListId(),
            'contact'       => $this->getContact(),
            'templateId'    => $this->getTemplateId(),
            'tags'          => $this->getTags(),
            'variables'     => [],
        ];

        foreach ($this->getVariables() as $variable) {

            /** @var Variable $variable */
            $array['variables'][] = $variable->__toArray();
        }

        return $array;
    }
}