<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminste\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    // Show all users
    public function index() {
        $users = User::all();

        return response()->json([
            'message' => 'Users retrieved successfully!',
            'data' => $users
        ], 200);
    }

    // Show a user by ID
    public function show(int $id) {
        $user = User::find($id);

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

    // Count users
    public function count() {
        $count = User::count();

        return response()->json([
            'message' => 'User count retrieved successfully!',
            'data' => $count
        ], 200);
    }

    // Create a new user
        
    public function create(StoreUserRequest $request) {
        $user = User::create(request->all());
        return response()-> json([
            "message" => "Success",
            "data" => $user,
        ]);

        if (validators->fails()){
            return $validator()-> message();
        }

    $user = User::create(request ->all());
    return response -> json ([
        "message"=> "Success",
        "data" => $user

    ]);

    }

    // Update an existing user
    public function edit(UpdateUserRequest $request, int $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found!'
            ], 404);
        }

        $user -> update ($request -> validated());

        return response()->json([
            'message' => 'User updated successfully!',
            'data' => $user
        ], 200);
    }

    // Delete a user
    public function delete(int $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found!'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully!',
            'id' => $id
        ], 200);
    }
}
