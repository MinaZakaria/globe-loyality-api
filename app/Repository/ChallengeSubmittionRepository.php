<?php

namespace App\Repository;

use App\Model\ChallengeSubmittion;

class ChallengeSubmittionRepository extends BaseRepository
{
    public function model()
    {
        return ChallengeSubmittion::class;
    }
}