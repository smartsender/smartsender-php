<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 07.05.19
 * Time: 13:20
 */

namespace SmartSender\V3\Contact;


class Contact
{

    /** @var string */
    protected $contact = '';

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $email = '';

    /** @var string */
    protected $phone = '';

    /** @var string */
    protected $externalId = '';

    /** @var bool */
    protected $isActive = false;

    /** @var Variable[] */
    protected $variables = [];

    /**
     * Contact constructor.
     *
     * @param string $contactEmail
     */
    public function __construct(string $contactEmail)
    {
        $this->contact = $contactEmail;
        $this->email   = $contactEmail;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Contact
     */
    public function setName(string $name): Contact
    {
        $this->name = $name;

        return $this;
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
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;

        return $this;
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
     * @return Contact
     */
    public function setPhone(string $phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     *
     * @return Contact
     */
    public function setExternalId(string $externalId): Contact
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     *
     * @return Contact
     */
    public function setIsActive(bool $isActive): Contact
    {
        $this->isActive = $isActive;

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
     * @return Contact
     */
    public function addVariable(Variable $variable): Contact
    {
        $this->variables[] = $variable;

        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        $array = [
            'contact'     => $this->contact,
            'email'       => $this->getEmail(),
            'name'        => $this->getName(),
            'externalId'  => $this->getExternalId(),
            'active'      => $this->isActive(),
            'phoneNumber' => $this->getPhone(),
            'variables'   => [],
        ];

        foreach ($this->getVariables() as $variable) {
            $array['variables'][] = $variable->__toArray();
        }

        return $array;
    }
}