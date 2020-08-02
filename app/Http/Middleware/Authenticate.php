<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use \Illuminate\Http\Request;

use Tymon\JWTAuth\Payload;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

use App\Http\Exceptions\TokenInvalidException;
use App\Http\Exceptions\TokenIsExpiredException;
use App\Http\Exceptions\TokenNotProvidedException;

class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $payload = $this->validateToken($request);
        // $authData = [
        //     'sub' => $payload->get('sub'),
        //     'brandId' => $payload->get('brandId'),
        //     'resellerId' => $payload->get('resellerId'),
        //     'storeId' => $payload->get('storeId'),
        //     'storeLoginId' => $payload->get('storeLoginId'),
        //     'type' => $payload->get('type')
        // ];

        // $request->request->add(compact('authData'));

        return $next($request);
    }

    /**
     * Validate incoming token.
     * @param  Request  $request
     * @return Payload $payload
     */
    public function validateToken(Request $request)
    {
        if (! JWTAuth::getToken()) {
            throw new TokenNotProvidedException();
        }

        try {
            $payload = JWTAuth::parseToken()->getPayload();
        } catch (TokenExpiredException $exception) {
            throw new TokenIsExpiredException($exception);
        } catch (JWTException $exception) {
            throw new TokenInvalidException($exception);
        }
        return $payload;
    }
}
