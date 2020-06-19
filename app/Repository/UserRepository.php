<?php

namespace App\Repository;

use App\Model\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }
}