<?php

namespace App\Service;

use JWTAuth;

use App\Repository\UserRoleRepository;

use App\Reporter\UserRoleReporter;

use App\Exceptions\ItemNotFoundException;

use App\Model\UserRole;

class UserRoleService extends ServiceProxy
{
    private $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository) {
        $this->userRoleRepository = $userRoleRepository;
    }

    protected function reporter()
    {
        return UserRoleReporter::class;
    }

    protected function find(int $id)
    {
        $role = $this->userRoleRepository->find($id);
        if (! $role) {
            throw new ItemNotFoundException(UserRole::class, $id);
        }

        return $role;
    }
}