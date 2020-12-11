<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\ChallengeSubmittion\ControlSubmittionRequest;

use App\Service\ChallengeSubmittionService;

use App\Constants\ChallengeSubmittionStatus;

class ChallengeSubmittionController
{
  private $challengeService;

  public function __construct(ChallengeSubmittionService $challengeSubmittionService)
  {
    $this->challengeSubmittionService = $challengeSubmittionService;
  }

  public function list(Request $request)
  {
    $data = $this->challengeSubmittionService->list();
    return response()->json(['data' => $data], 200);
  }

  public function approve(ControlSubmittionRequest $request, int $id)
  {
    $comment = $request->input('comment');
    $data = $this->challengeSubmittionService->updateStatus($id, ChallengeSubmittionStatus::APPROVED, $comment);
    return response()->json(['data' => $data], 200);
  }

  public function reject(ControlSubmittionRequest $request, int $id)
  {
    $comment = $request->input('comment');
    $data = $this->challengeSubmittionService->updateStatus($id, ChallengeSubmittionStatus::REJECTED, $comment);
    return response()->json(['data' => $data], 200);
  }

  public function decline(ControlSubmittionRequest $request, int $id)
  {
    $comment = $request->input('comment');
    $data = $this->challengeSubmittionService->updateStatus($id, ChallengeSubmittionStatus::DECLINED, $comment);
    return response()->json(['data' => $data], 200);
  }
}