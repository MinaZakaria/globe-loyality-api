<?php

namespace App\Reporter;

use Exception;

use App\Exceptions\ErrorType;
use App\Exceptions\ClientException;

use App\Exceptions\InternalViolationException;

/**
 * Some Helpers and common functions for reporters
 */
class Reporter
{
    protected function throw(string $type, Exception $exception)
    {
        $exceptionClass = get_class($exception);
        switch ($exceptionClass) {
            case InternalViolationException::class:
                $type = ErrorType::INTERNAL_ERROR;
                break;
        }

        $details = [];
        if ($type != ErrorType::UNKNOWN) {
            $details = $exception->getDetails();
        }
        $title = ErrorType::title($type);
        $status = ErrorType::status($type);
        throw new ClientException($exception, $status, $type, $title, $details);
    }
}
