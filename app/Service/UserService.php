<?php

namespace App\Service;

use JWTAuth;

use \Exception;
use App\Exceptions\ItemNotFoundException;

use App\Repository\UserRepository;

use App\Service\UserRoleService;

use App\Reporter\UserReporter;

use App\Model\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Exceptions\UnAuthenticatedException;

class UserService extends ServiceProxy
{
    private $userRepository;
    private $userRoleService;

    public function __construct(UserRepository $userRepository, UserRoleService $userRoleService) {
        $this->userRepository = $userRepository;
        $this->userRoleService = $userRoleService;
    }

    protected function reporter()
    {
        return UserReporter::class;
    }

    protected function authenticate(array $credentials)
    {
        $token = Auth::attempt($credentials);
        if (! $token) {
            throw new UnAuthenticatedException();
        }

        $user = Auth::user();
        if(! $user->email_verified_at){
            throw new UnAuthenticatedException(['email' => 'not verified']);
        }

        return ['user' => $user, 'token' => $token];
    }

    protected function register(array $data)
    {
        $role = $this->userRoleService->find($data['roleId']);

        $userData = [
            'name'=> $data['name'],
            'email'=> $data['email'],
            'roleId'=> $role->id,
            'password'=> Hash::make($data['password']),
        ];

        $user = $this->userRepository->create($userData);
        $user->sendEmailVerificationNotification();

        $token = JWTAuth::fromUser($user);
        return ['user' => $user, 'token' => $token];
    }

    protected function find(int $id)
    {
        $user = $this->userRepository->find($id);
        if (! $user) {
            throw new ItemNotFoundException(User::class, $id);
        }

        return $user;
    }

    protected function verifyEmail(int $userId)
    {
        $user = $this->find($userId);
        $user->email_verified_at = date('Y-m-d g:i:s');
        $user->save();
    }
}