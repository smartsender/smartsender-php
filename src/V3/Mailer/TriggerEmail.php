<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 19:49
 */

namespace SmartSender\V3\Mailer;


class TriggerEmail
{

    /** @var string */
    protected $contactListId;

    /** @var string */
    protected $contact;

    /** @var string */
    protected $templateId;

    /** @var array */
    protected $tags;

    /** @var array */
    protected $variables;

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
     * @param string $name
     * @param string $value
     *
     * @return TriggerEmail
     */
    public function addVariable(string $name, string $value): TriggerEmail
    {
        $this->variables[$name] = $value;

        return $this;
    }


}