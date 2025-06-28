<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // Get all authors
    public function index() {
        $authors = Author::all();

        return response()->json([
            'message' => 'Authors retrieved successfully!',
            'data' => $authors
        ], 200);
    }

    // Get a single author by ID
    public function show(int $id) {
        $author = Author::find($id);

        if ($author) {
            return response()->json([
                'message' => 'Author found!',
                'data' => $author
            ], 200);
        }

        return response()->json([
            'message' => 'Author not found!'
        ], 404);
    }

    // Count all authors
    public function count() {
        $count = Author::count();

        return response()->json([
            'message' => 'Author count retrieved successfully!',
            'data' => $count
        ], 200);
    }

    // Create a new author
    public function create(StoreAuthorRequest $request) {
        // Just check if name is given, no formal validation
        $author = Author::create($request->all());
        return response()-> json([
            "message"=> "Success",
            "data"=> $author
        ]);
        

        if($validator->fails()){
            return $validator-> message();
        }

        $author = Author::create(request->all());
        return response->json([
            "message" => "Success",
            "data"  => $author
        ]);
    }

        

        // Edit (update) an author
    public function edit(UpdateAuthorRequest $request, int $id)
    {
        $author = author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found!'
            ], 404);
        }

        // Update the book with only validated data
        $author->update($request->validated());

        return response()->json([
            'message' => 'Author updated successfully!',
            'data' => $author
        ], 200);
    }


    // Delete an author
    public function delete(int $id) {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found!'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully!',
            'id' => $id
        ], 200);
    }
}
