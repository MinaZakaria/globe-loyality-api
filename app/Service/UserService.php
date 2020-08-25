<?php

namespace App\Service;

use JWTAuth;

use \Exception;
use App\Exceptions\ItemNotFoundException;
use App\Exceptions\ItemIsPendingException;
use App\Exceptions\ItemIsBlockedException;
use App\Exceptions\UnAuthenticatedException;
use App\Exceptions\EmailNotVerifiedException;

use App\Repository\UserRepository;

use App\Service\UserRoleService;

use App\Reporter\UserReporter;

use App\Model\User;

USE App\Constants\UserRole;
USE App\Constants\UserStatus;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            throw new EmailNotVerifiedException();
        }

        if($user->status_id === UserStatus::PENDING){
            throw new ItemIsPendingException(User::class, $user->id);
        }

        if($user->status_id === UserStatus::IN_ACTIVE){
            throw new ItemIsBlockedException(User::class, $user->id);
        }

        return ['user' => $user, 'token' => $token];
    }

    protected function register(array $data)
    {
        $role = $this->userRoleService->find($data['role_id']);

        if ($role->id === UserRole::MEDICAL_REP) {
            $status_id = UserStatus::ACTIVE;
        } else {
            $status_id = UserStatus::PENDING;
        }

        $userData = [
            'name'=> $data['name'],
            'email'=> $data['email'],
            'role_id'=> $data['role_id'],
            'status_id'=> $status_id,
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

    protected function approve(int $userId)
    {
        $user = $this->find($userId);
        $user->status_id = UserStatus::ACTIVE;
        $user->save();

        return $user;
    }

    protected function block(int $userId)
    {
        $user = $this->find($userId);
        $user->status_id = UserStatus::IN_ACTIVE;
        $user->save();

        return $user;
    }

    protected function list($status_id)
    {
        $filterBy = [];
        if(isset($status_id)) {
            $filterBy['status_id'] = $status_id;
        }

        $users = $this->userRepository->findBy($filterBy);
        return $users;
    }
}