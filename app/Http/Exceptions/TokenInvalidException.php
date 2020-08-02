<?php

namespace App\Http\Exceptions;

use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;

class TokenInvalidException extends Exception
{
    private JWTException $exception;

    public function __construct(JWTException $exception)
    {
        parent::__construct($exception->getMessage());
        $this->exception = $exception;
    }

    /**
     *
     * @return array
     */
    public function getDetails()
    {
        return [
            'error' => $this->exception->getMessage()
        ];
    }
}
