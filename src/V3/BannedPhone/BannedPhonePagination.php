<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 06.05.19
 * Time: 17:57
 */

namespace SmartSender\V3\BannedPhone;

use SmartSender\V3\Pagination;

class BannedPhonePagination extends Pagination
{

    /** @var BannedPhone[] */
    protected $bannedPhones = [];

    /** @var string|null */
    protected $phone;

    /** @var string|null */
    protected $type;

    /**
     * @return array
     */
    public function getBannedPhones(): array
    {
        return $this->bannedPhones;
    }

    /**
     * @param BannedPhone $bannedPhone
     *
     * @return Pagination
     */
    public function addBannedPhone(BannedPhone $bannedPhone): Pagination
    {
        $this->bannedPhones[] = $bannedPhone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return BannedPhonePagination
     */
    public function setPhone(string $phone): BannedPhonePagination
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return BannedPhonePagination
     */
    public function setType(string $type): BannedPhonePagination
    {
        $this->type = $type;

        return $this;
    }

    public function __toArray(): array
    {
        $array = [
            'offset'      => $this->offset,
            'limit'       => $this->limit,
            'phoneNumber' => $this->phone,
            'rejectType'  => $this->type,
        ];

        return $array;
    }
}