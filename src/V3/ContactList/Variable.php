<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 07.05.19
 * Time: 18:29
 */

namespace SmartSender\V3\ContactList;


use SmartSender\V3\Exceptions\VariableException;

class Variable
{

    const ENUM_STRING = 'ENUM_STRING';
    const ENUM_DATE   = 'ENUM_DATE';

    const RESERVED_NAMES = [
        'name',
        'email',
        'phonenumber',
        'externalid',
        'createdat',
    ];

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $type = '';

    /**
     * Variable constructor.
     *
     * @param string $name
     * @param string $type
     *
     * @throws VariableException
     */
    public function __construct(string $name, string $type)
    {
        if (in_array(mb_strtolower($name), static::RESERVED_NAMES)) {
            throw new VariableException("name $name is reserved");
        }

        if (static::ENUM_DATE != $type && static::ENUM_STRING != $type) {
            throw new VariableException("type $type is not equal to " . static::ENUM_DATE . " or " . static::ENUM_STRING);
        }

        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}