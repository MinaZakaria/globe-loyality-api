<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\User\LoginRequest;
use App\Http\Request\User\RegisterRequest;
use Illuminate\Foundation\Auth\VerifiesEmails;

use Illuminate\Support\Facades\Auth;

use App\Service\UserService;

class UserController
{
    use VerifiesEmails;

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $data = $this->userService->authenticate($credentials);
        return response()->json(['data' => $data], 200);
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $data = $this->userService->register($validatedData);

        return response()->json(['data' => $data], 200);
    }

    public function me()
    {
        $currentUser = Auth::user();
        return response()->json(['data' => $currentUser], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([], 204);
    }

    public function refresh()
    {
        $newToken = Auth::refresh();
        return response()->json(['token' => $newToken], 200);
    }

    /**
    * Mark the authenticated user’s email address as verified.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function verifyEmail(Request $request)
    {
        $userId = $request->route('id');
        $this->userService->verifyEmail($userId);

        return response()->json('Email verified!', 200);
    }

    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resend(Request $request)
    {
        dd($request->user());
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('User already have verified email!', 422);
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json('The notification has been resubmitted');
    }
}