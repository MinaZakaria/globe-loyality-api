<?php

namespace App\Exceptions;

use Exception;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\Exceptions\Reporter;

class Handler extends ExceptionHandler
{
    /**
     * @var Reporter
     */
    private $reporter;

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    /**
     * @override
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @override
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if (config('app.debug')) {
            if ($exception instanceof ClientException) {
                $exception = $exception->getException();
            }
            return parent::render($request, $exception);
        }
        return $this->handle($request, $exception);
    }

    /**
     * handle exceptions in case of app.debug=false
     *
     * @param  Request $request
     * @param  ClientException|Exception $exception
     * @return JsonResponse
     */
    public function handle($request, $exception)
    {
        if (! ($exception instanceof ClientException)) {
            if(!isset($this->reporter)) {
                $this->reporter = $this->container->make(Reporter::class);
            }
            $exception = $this->reporter->report($exception);
        }

        return $this->handleClientException($request, $exception);
    }

    /**
     * @param  Request $request
     * @param  ClientException $exception
     * @return JsonResponse
     */
    private function handleClientException(Request $request, ClientException $exception) {
        return response()->json($exception->toArray(), $exception->getStatusCode());
    }
}
