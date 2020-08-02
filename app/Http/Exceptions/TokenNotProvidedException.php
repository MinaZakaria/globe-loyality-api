<?php

namespace App\Http\Exceptions;

use Exception;

class TokenNotProvidedException extends Exception
{
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }

    /**
     *
     * @return array
     */
    public function getDetails()
    {
        return [];
    }
}
