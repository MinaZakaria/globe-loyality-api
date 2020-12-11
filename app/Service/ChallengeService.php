<?php

namespace App\Service;

use \Exception;
use App\Exceptions\ItemNotFoundException;
use App\Exceptions\ChallengeAlreadySubmittedException;

use App\Repository\ChallengeRepository;
use App\Repository\ChallengeSubmittionRepository;

use App\Service\ProgramService;

use App\Reporter\ChallengeReporter;

use Illuminate\Support\Facades\Auth;

use App\Model\Challenge;
use App\Model\ChallengeSubmittion;


class ChallengeService extends ServiceProxy
{
    private $challengeRepository;
    private $challengeSubmittionRepository;
    private $progarmService;

    public function __construct(
        ChallengeRepository $challengeRepository,
        ChallengeSubmittionRepository $challengeSubmittionRepository,
        ProgramService $progarmService
    ) {
        $this->challengeRepository = $challengeRepository;
        $this->challengeSubmittionRepository = $challengeSubmittionRepository;
        $this->progarmService = $progarmService;
    }

    protected function reporter()
    {
        return ChallengeReporter::class;
    }

    protected function create(array $data)
    {
        $program = $this->progarmService->find($data['program_id']);

        $data['created_by'] = Auth::id();

        $challenge = $this->challengeRepository->create($data);
        $challenge->refresh();
        return $challenge;
    }

    protected function submit(int $challengeId, array $data)
    {
        $challenge = $this->find($challengeId);

        $data['user_id'] = Auth::id();
        $data['challenge_id'] = $challengeId;
        $userSubmittion = $this->challengeSubmittionRepository->findOneBy(
            [
                'user_id' => $data['user_id'],
                'challenge_id' => $data['challenge_id']
            ]
        );
        if ($userSubmittion) {
            throw new ChallengeAlreadySubmittedException(ChallengeSubmittion::class);
        }
        $this->challengeSubmittionRepository->create($data);
    }

    protected function find(int $id)
    {
        $challenge = $this->challengeRepository->find($id);
        if (!$challenge) {
            throw new ItemNotFoundException(Challenge::class, $id);
        }

        return $challenge;
    }

    protected function list($is_active, $program_id)
    {
        $filterBy = [];
        if (isset($is_active)) {
            $filterBy['is_active'] = $is_active;
        }

        if (isset($program_id)) {
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