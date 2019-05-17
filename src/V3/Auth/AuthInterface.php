<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 13:03
 */

namespace SmartSender\V3\Auth;


interface AuthInterface
{

    public function getAuthHeaders(): array;
}