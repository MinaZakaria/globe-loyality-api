<?php

namespace App\Reporter;

use Exception;
use App\Exceptions\ClientException;

use App\Exceptions\ErrorType;
use App\Exceptions\UnAuthenticatedException;
use App\Exceptions\ItemNotFoundException;

class UserReporter extends Reporter
{
    public function authenticate(Exception $exception)
    {
        $exceptionClass = get_class($exception);

        if ($exceptionClass === ClientException::class) {
            $exception = $exception->getException();
            $exceptionClass = get_class($exception);
        }
        switch ($exceptionClass) {
            case UnAuthenticatedException::class:
                $type = ErrorType::UNAUTHENTICATED;
                break;
            default:
                $type = ErrorType::UNKNOWN;
                break;
        }

        $this->throw($type, $exception);
    }

    public function register(Exception $exception)
    {
        $exceptionClass = get_class($exception);

        if ($exceptionClass === ClientException::class) {
            $exception = $exception->getException();
            $exceptionClass = get_class($exception);
        }
        switch ($exceptionClass) {
            case ItemNotFoundException::class:
                $type = ErrorType::ITEM_NOT_FOUND;
                break;
            default:
                $type = ErrorType::UNKNOWN;
                break;
        }

        $this->throw($type, $exception);
    }

    public function find(Exception $exception)
    {
        $exceptionClass = get_class($exception);

        if ($exceptionClass === ClientException::class) {
            $exception = $exception->getException();
            $exceptionClass = get_class($exception);
        }
        switch ($exceptionClass) {
            case ItemNotFoundException::class:
                $type = ErrorType::ITEM_NOT_FOUND;
                break;
            default:
                $type = ErrorType::UNKNOWN;
                break;
        }

        $this->throw($type, $exception);
    }

    public function verifyEmail(Exception $exception)
    {
        $exceptionClass = get_class($exception);

        if ($exceptionClass === ClientException::class) {
            $exception = $exception->getException();
            $exceptionClass = get_class($exception);
        }
        switch ($exceptionClass) {
            case ItemNotFoundException::class:
                $type = ErrorType::ITEM_NOT_FOUND;
                break;
            default:
                $type = ErrorType::UNKNOWN;
                break;
        }

        $this->throw($type, $exception);
    }
}
