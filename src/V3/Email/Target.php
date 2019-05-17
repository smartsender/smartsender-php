<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 19:21
 */

namespace SmartSender\V3\Email;


class Target
{

    /** @var string */
    protected $email;

    /** @var string|null */
    protected $name;

    public function __construct(string $email = null, string $name = null)
    {
        $this->email = $email;
        $this->name  = $name;
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
     * @return Target
     */
    public function setEmail(string $email): Target
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return Target
     */
    public function setName(string $name): Target
    {
        $this->name = $name;

        return $this;
    }

    public function __toArray(): array
    {
        return [
            'email' => $this->email,
            'name'  => $this->name,
        ];
    }


}