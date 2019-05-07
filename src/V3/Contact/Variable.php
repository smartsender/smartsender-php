<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 12:42
 */

namespace SmartSender\V3\Contact;


class Variable
{

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $value = '';

    public function __construct(string $name, string $value)
    {
        $this->name  = $name;
        $this->value = $value;
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
     * @return Variable
     */
    public function setName(string $name): Variable
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return Variable
     */
    public function setValue(string $value): Variable
    {
        $this->value = $value;

        return $this;
    }

    public function __toArray()
    {
        return [
            'name'  => $this->getName(),
            'value' => $this->getValue(),
        ];
    }
}