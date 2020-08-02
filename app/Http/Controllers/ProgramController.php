<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\ProgramService;

class ProgramController
{
    private $programService;

    public function __construct(ProgramService $programService) {
        $this->programService = $programService;
    }

    public function list()
    {
        $data = $this->programService->list();
        return response()->json(['data' => $data], 200);
    }
}