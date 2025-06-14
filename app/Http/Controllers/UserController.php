<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public $users = [
        ['id' => 1, 'name' => 'Alice', 'email' => 'alice@example.com'],
        ['id' => 2, 'name' => 'Bob', 'email' => 'bob@example.com']
    ];

    private function find($users, $id) {
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }

    public function index() {
        return response()->json([
            'message' => 'Users retrieved successfully!',
            'data' => $this->users
        ], 200);
    }

    public function show(int $id) {
        $user = $this->find($this->users, $id);

        if ($user) {
            return response()->json([
                'message' => 'User found!',
                'data' => $user
            ], 200);
        }

        return response()->json([
            'message' => 'User not found!'
        ], 404);
    }

    public function count() {
        return response()->json([
            'message' => 'User count retrieved successfully!',
            'data' => count($this->users)
        ], 200);
    }

    public function create(Request $request) {
        return response()->json([
            'message' => 'User created successfully!',
            'data' => [
                'name' => $request->name,
                'email' => $request->email,
            ],
        ], 201);
    }

    public function edit(Request $request, int $id) {
        $user = $this->find($this->users, $id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found!'
            ], 404);
        }

        return response()->json([
            'message' => 'User updated successfully!',
            'id' => $id,
            'data' => [
                'name' => $request->name,
                'email' => $request->email,
            ],
        ], 200);
    }

    public function delete(int $id) {
        $user = $this->find($this->users, $id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found!'
            ], 404);
        }

        return response()->json([
            'message' => 'User deleted (simulated) successfully!',
            'id' => $id,
        ], 200);
    }
}
