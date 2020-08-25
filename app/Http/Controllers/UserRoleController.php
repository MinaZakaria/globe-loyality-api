<?php

namespace App\Http\Controllers;

use App\Service\UserRoleService;

class UserRoleController
{
    private $userRoleService;

    public function __construct(UserRoleService $userRoleService) {
        $this->userRoleService = $userRoleService;
    }

    public function list()
    {
        $data = $this->userRoleService->list();
        return response()->json(['data' => $data], 200);
    }
}