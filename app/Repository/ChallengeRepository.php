<?php

namespace App\Repository;

use App\Model\Challenge;

class ChallengeRepository extends BaseRepository
{
    public function model()
    {
        return Challenge::class;
    }
}