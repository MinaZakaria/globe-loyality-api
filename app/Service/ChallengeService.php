<?php

namespace App\Service;

use \Exception;
use App\Exceptions\ItemNotFoundException;

use App\Repository\ChallengeRepository;

use App\Service\ProgramService;

use App\Reporter\ChallengeReporter;

use Illuminate\Support\Facades\Auth;

use App\Model\Challenge;


class ChallengeService extends ServiceProxy
{
    private $challengeRepository;
    private $progarmService;

    public function __construct(ChallengeRepository $challengeRepository, ProgramService $progarmService) {
        $this->challengeRepository = $challengeRepository;
        $this->progarmService = $progarmService;
    }

    protected function reporter()
    {
        return ChallengeReporter::class;
    }

    protected function create(array $data)
    {
        $program = $this->progarmService->find($data['program_id']);

        $challengeData = [
            'name'=> $data['name'],
            'description'=> $data['description'],
            'program_id'=> $data['program_id'],
            'image_url'=> null,
            'created_by'=> Auth::id()
        ];

        $challenge = $this->challengeRepository->create($challengeData);
        return $challenge;
    }

    protected function find(int $id)
    {
        $challenge = $this->challengeRepository->find($id);
        if (! $challenge) {
            throw new ItemNotFoundException(Challenge::class, $id);
        }

        return $challenge;
    }

    protected function list($is_active, $program_id)
    {
        $filterBy = [];
        if(isset($is_active)) {
            $filterBy['is_active'] = $is_active;
        }

        if(isset($program_id)) {
            $filterBy['program_id'] = $program_id;
        }

        $challenges = $this->challengeRepository->findBy($filterBy);
        return $challenges;
    }

    protected function finish($challenge_id)
    {
        $challenge = $this->find($challenge_id);
        $challenge->is_active = false;
        $challenge->save();

        return $challenge;
    }
}