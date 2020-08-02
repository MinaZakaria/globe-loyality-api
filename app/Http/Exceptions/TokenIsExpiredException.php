<?php

namespace App\Http\Exceptions;

use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class TokenIsExpiredException extends Exception
{
    private TokenExpiredException $exception;

    public function __construct(TokenExpiredException $exception)
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
