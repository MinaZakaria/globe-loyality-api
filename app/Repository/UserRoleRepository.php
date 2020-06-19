<?php

namespace App\Repository;

use App\Model\UserRole;

class UserRoleRepository extends BaseRepository
{
    public function model()
    {
        return UserRole::class;
    }
}