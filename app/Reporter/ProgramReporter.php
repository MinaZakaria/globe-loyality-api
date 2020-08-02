<?php

namespace App\Reporter;

use Exception;

use App\Exceptions\ErrorType;
use App\Exceptions\ItemNotFoundException;

class ProgramReporter extends Reporter
{
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

    public function list(Exception $exception)
    {
        $exceptionClass = get_class($exception);
        if ($exceptionClass === ClientException::class) {
            $exception = $exception->getException();
            $exceptionClass = get_class($exception);
        }

        switch ($exceptionClass) {
            default:
                $type = ErrorType::UNKNOWN;
                break;
        }

        $this->throw($type, $exception);
    }
}
