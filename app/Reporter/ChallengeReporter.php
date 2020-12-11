<?php

namespace App\Reporter;

use Exception;
use App\Exceptions\ClientException;

use App\Exceptions\ErrorType;
use App\Exceptions\ItemNotFoundException;
use App\Exceptions\ChallengeAlreadySubmittedException;

class ChallengeReporter extends Reporter
{
    public function create(Exception $exception)
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

    public function submit(Exception $exception)
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
            case ChallengeAlreadySubmittedException::class:
                $type = ErrorType::ITEM_ALREADY_SUBMITTED;
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

    public function finish(Exception $exception)
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
