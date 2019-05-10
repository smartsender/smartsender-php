<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 12:42
 */

namespace SmartSender\V3\GlobalVariable;


class GlobalVariable
{

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $value = '';

    /** @var \DateTime|null */
    protected $createdAt;

    public function __construct(string $name, string $value = '')
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
     * @return GlobalVariable
     */
    public function setName(string $name): GlobalVariable
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
     * @return GlobalVariable
     */
    public function setValue(string $value): GlobalVariable
    {
        $this->value = $value;

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
     * @return GlobalVariable
     */
    public function setCreatedAt(\DateTime $createdAt): GlobalVariable
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toArray()
    {
        return [
            'name'  => $this->getName(),
            'value' => $this->getValue(),
            'createdAt'   => !$this->getCreatedAt() ?: $this->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    public static function createFromArray(array $array):  GlobalVariable
    {
        $globalVariable = new static(isset($array['name']) ? strval($array['name']) : '',
            isset($array['value']) ? $array['value'] : '');

        if (isset($array['createdAt'])
            && $createdAt = \DateTime::createFromFormat('Y-m-d H:i:s', $array['createdAt'], new \DateTimeZone('UTC'))) {
            $globalVariable->setCreatedAt($createdAt);
        }

        return $globalVariable;
    }
}