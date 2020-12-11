<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\Challenge\CreateChallengeRequest;
use App\Http\Request\Challenge\SubmitChallengeRequest;
use App\Http\Request\Challenge\FinishChallengeRequest;

use App\Service\ChallengeService;

class ChallengeController
{
    private $challengeService;

    public function __construct(ChallengeService $challengeService)
    {
        $this->challengeService = $challengeService;
    }

    public function create(CreateChallengeRequest $request)
    {
        $validatedData = $request->validated();

        $data = $this->challengeService->create($validatedData);
        return response()->json(['data' => $data], 200);
    }

    public function submit(SubmitChallengeRequest $request, int $challengeId)
    {
        $validatedData = $request->validated();

        $this->challengeService->submit($challengeId, $validatedData);
        return response()->json([], 204);
    }

    public function list(Request $request)
    {
        $is_active = $request->query('is_active');
        $program_id = $request->query('program_id');

        $data = $this->challengeService->list($is_active, $program_id);
        return response()->json(['data' => $data], 200);
    }

    public function finish(FinishChallengeRequest $request, int $id)
    {
        $data = $this->challengeService->finish($id);
        return response()->json(['data' => $data], 200);
    }
}