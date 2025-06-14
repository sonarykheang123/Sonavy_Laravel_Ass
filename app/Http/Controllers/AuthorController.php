<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public $authors = [
        ['id' => 1, 'name' => 'George Orwell'],
        ['id' => 2, 'name' => 'Aldous Huxley']
    ];

    private function find($authors, $id) {
        foreach ($authors as $author) {
            if ($author['id'] == $id) {
                return $author;
            }
        }
        return null;
    }

    public function index() {
        return response()->json([
            'message' => 'Authors retrieved successfully!',
            'data' => $this->authors
        ], 200);
    }

    public function show(int $id) {
        $author = $this->find($this->authors, $id);

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

    public function count() {
        return response()->json([
            'message' => 'Author count retrieved successfully!',
            'data' => count($this->authors)
        ], 200);
    }

    public function create(Request $request) {
        return response()->json([
            'message' => 'Author created successfully!',
            'data' => [
                'name' => $request->name,
            ],
        ], 201);
    }

    public function edit(Request $request, int $id) {
        $author = $this->find($this->authors, $id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found!'
            ], 404);
        }

        return response()->json([
            'message' => 'Author updated successfully!',
            'id' => $id,
            'data' => [
                'name' => $request->name,
            ],
        ], 200);
    }

    public function delete(int $id) {
        $author = $this->find($this->authors, $id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found!'
            ], 404);
        }

        return response()->json([
            'message' => 'Author deleted (simulated) successfully!',
            'id' => $id,
        ], 200);
    }
}
