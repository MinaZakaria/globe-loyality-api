<?php

namespace App\Exceptions;

use Exception;

abstract class BaseException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * Return the exception details as an array
     *
     * @return array
     */
    abstract public function getDetails();
}
