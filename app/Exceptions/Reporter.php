<?php

namespace App\Exceptions;

use Exception;

use App\Exceptions\ErrorType;
use App\Exceptions\ClientException;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

use Repository\Exceptions\ItemNotFoundException;
use App\Http\Exceptions\ValidationException;

class Reporter
{
    /**
     * @param Exception $exception
     * @return ClientException
     */
    public function report(Exception $exception)
    {
        $details = [];
        switch (get_class($exception)) {
            case AuthenticationException::class:
                $type = ErrorType::UNAUTHENTICATED;
                break;
            case AuthorizationException::class:
                $type = ErrorType::UNAUTHORIZED;
                break;
            case NotFoundHttpException::class:
                $type = ErrorType::ROUTE_NOT_FOUND;
                break;
            case MethodNotAllowedHttpException::class:
                $type = ErrorType::METHOD_NOT_ALLOWED;
                break;
            case ItemNotFoundException::class:
                $type = ErrorType::ITEM_NOT_FOUND;
                break;
            case ValidationException::class:
                $type = ErrorType::INPUT_VALIDATION;
                $details = $exception->getDetails();
                break;
            default:
                $type = ErrorType::UNKNOWN;
                break;
        }

        $title = ErrorType::title($type);
        $status = ErrorType::status($type);

        return new ClientException($exception, $status, $type, $title, $details);
    }
}
