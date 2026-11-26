<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name', 'Guest');

        return response()->json([
            'message' => 'Hello ' . $name,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "max:50"],
            "age" => ["required", "integer"]
        ]);

        return response()->json([
            'message' => '用户信息验证成功',
            'data' => $validated,
        ]);
    }
}
