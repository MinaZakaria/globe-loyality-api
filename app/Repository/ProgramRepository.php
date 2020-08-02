<?php

namespace App\Repository;

use App\Model\Program;

class ProgramRepository extends BaseRepository
{
    public function model()
    {
        return Program::class;
    }
}