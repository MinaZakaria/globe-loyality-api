<?php

namespace App\Service;

use App\Repository\ProgramRepository;

use App\Reporter\ProgramReporter;

use App\Exceptions\ItemNotFoundException;

use App\Model\Program;

class ProgramService extends ServiceProxy
{
    private $programRepository;

    public function __construct(ProgramRepository $programRepository) {
        $this->programRepository = $programRepository;
    }

    protected function reporter()
    {
        return ProgramReporter::class;
    }

    protected function find(int $id)
    {
        $program = $this->programRepository->find($id);
        if (! $program) {
            throw new ItemNotFoundException(Program::class, $id);
        }

        return $program;
    }

    protected function list()
    {
        $programs = $this->programRepository->all();
        return $programs;
    }
}