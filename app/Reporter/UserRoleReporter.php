<?php

namespace App\Reporter;

use Exception;

use App\Exceptions\ErrorType;
use App\Exceptions\ItemNotFoundException;

class UserRoleReporter extends Reporter
{
    public function find(Exception $exception)
    {
        $exceptionClass = get_class($exception);
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
