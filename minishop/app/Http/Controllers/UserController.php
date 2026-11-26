<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'age' => ['required', 'integer'],
        ]);

        $user = $this->userService->create($validated);

        return response()->json([
            'message' => '用户信息处理成功',
            'data' => $user,
        ]);
    }
}
