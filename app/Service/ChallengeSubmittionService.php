<?php

namespace App\Service;

use App\Repository\ChallengeSubmittionRepository;

use App\Reporter\ChallengeSubmittionReporter;

use App\Model\ChallengeSubmittion;
use App\Mapper\SubmittionMapper;

use App\Constants\ChallengeSubmittionStatus;

use App\Service\UserService;

class ChallengeSubmittionService extends ServiceProxy
{
  private $challengeSubmittionRepository;
  private $userService;

  public function __construct(
    ChallengeSubmittionRepository $challengeSubmittionRepository,
    UserService $userService
  ) {
    $this->challengeSubmittionRepository = $challengeSubmittionRepository;
    $this->userService = $userService;
  }

  protected function reporter()
  {
    return ChallengeSubmittionReporter::class;
  }

  protected function find(int $id)
  {
    $submittion = $this->challengeSubmittionRepository->find($id);
    if (!$submittion) {
      throw new ItemNotFoundException(ChallengeSubmittion::class, $id);
    }

    return $submittion;
  }

  protected function list()
  {
    $submittions = $this->challengeSubmittionRepository->all();
    return SubmittionMapper::fromDomainFormatList($submittions);
  }

  protected function updateStatus(int $submittionId, int $statusId, string $comment = null)
  {
    $submittion = $this->find($submittionId);
    $submittion->status_id = $statusId;
    $submittion->comment = $comment;
    $submittion->save();

    if ($statusId === ChallengeSubmittionStatus::APPROVED) {
      $user = $this->userService->find($submittion->user_id);
      $user->points += $submittion->points;
      $user->save();
    }

    return $submittion;
  }
}