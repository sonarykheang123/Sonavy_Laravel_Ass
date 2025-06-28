<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    // Get all books with their author info
    public function index()
    {
        $books = Book::with('author')->get();

        return response()->json([
            'message' => 'Books retrieved successfully!',
            'data' => $books
        ], 200);
    }

    // Get a single book with author
    public function show(int $id)
    {
        $book = Book::with('author')->find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found!'
            ], 404);
        }

        return response()->json([
            'message' => 'Book found!',
            'data' => $book
        ], 200);
    }

    // Count all books
    public function count()
    {
        $count = Book::count();

        return response()->json([
            'message' => 'Book count retrieved successfully!',
            'data' => $count
        ], 200);
    }

    // Create a new book
    public function create(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return response()->json([
            'message' => 'Book created successfully!',
            'data' => $book->load('author')  // Return with author relationship
        ], 201);
    }

    // Update a book
    public function edit(UpdateBookRequest $request, int $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found!'
            ], 404);
        }

        $book->update($request->validated());

        return response()->json([
            'message' => 'Book updated successfully!',
            'data' => $book->load('author')
        ], 200);
    }

    // Delete a book
    public function delete(int $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found!'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully!',
            'id' => $id
        ], 200);
    }
}
