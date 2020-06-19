<?php

namespace App\Http\Exceptions;

use Exception;

class ValidationException extends Exception
{
    private $details;

    /**
     *
     * @param array $details
     * @return void
     */
    public function __construct($details = [])
    {
        parent::__construct();
        $this->details = $details;
    }

    public function getDetails()
    {
        return $this->details;
    }
}
