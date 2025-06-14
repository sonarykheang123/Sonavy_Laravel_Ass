<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public $books = [
        ['id' => 1, 'title' => '1984', 'author_id' => 1, 'isbn' => '9780451524935'],
        ['id' => 2, 'title' => 'Brave New World', 'author_id' => 2, 'isbn' => '9780060850524']
    ];

    private function find($books, $id) {
        foreach ($books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }
        return null;
    }

    public function index() {
        return response()->json([
            'message' => 'Books retrieved successfully!',
            'data' => $this->books
        ], 200);
    }

    public function show(int $id) {
        $book = $this->find($this->books, $id);

        if ($book) {
            return response()->json([
                'message' => 'Book found!',
                'data' => $book
            ], 200);
        }

        return response()->json([
            'message' => 'Book not found!'
        ], 404);
    }

    public function count() {
        return response()->json([
            'message' => 'Book count retrieved successfully!',
            'data' => count($this->books)
        ], 200);
    }

    public function create(Request $request) {
        return response()->json([
            'message' => 'Book created successfully!',
            'data' => [
                'title' => $request->title,
                'author_id' => $request->author_id,
                'isbn' => $request->isbn,
            ],
        ], 201);
    }

    public function edit(Request $request, int $id) {
        $book = $this->find($this->books, $id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found!'
            ], 404);
        }

        return response()->json([
            'message' => 'Book updated successfully!',
            'id' => $id,
            'data' => [
                'title' => $request->title,
                'author_id' => $request->author_id,
                'isbn' => $request->isbn,
            ],
        ], 200);
    }

    public function delete(int $id) {
        $book = $this->find($this->books, $id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found!'
            ], 404);
        }

        return response()->json([
            'message' => 'Book deleted successfully!',
            'id' => $id,
        ], 200);
    }
}
