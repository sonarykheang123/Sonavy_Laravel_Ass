<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facade\Validator;

class BookController extends Controller
{
    // Get all books
    public function index() {
        $books = Book::all();

        return response()->json([
            'message' => 'Books retrieved successfully!',
            'data' => $books
        ], 200);
    }

    // Get a single book by ID
    public function show(int $id) {
        $book = Book::find($id);

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

    // Count all books
    public function count() {
        $count = Book::count();

        return response()->json([
            'message' => 'Book count retrieved successfully!',
            'data' => $count
        ], 200);
    }

    // Create a new book
    public function create( StoreBookRequest $request) {
        $book = Book::create($request-> all());
        return response() -> json([
            "message" => "Success",
            "data" => $book
        ]);

       if($book-> fails()){
        return $validator->message();
       }

       $book = Book::create($request->all());
       return response ()->json([
        "message" => "Success",
        "data"  => $book
       ]);
    }


 

    // Update a book
    public function edit(UpdateBookRequest $request, int $id) {
    $book = Book::find($id);

    if (!$book) {
        return response()->json([
            'message' => 'Book not found!'
        ], 404);
    }

    $book->update($request->validated());

    return response()->json([
        'message' => 'Book updated successfully',
        'data' => $book
    ], 200);
}

    // Delete a book
    public function delete(int $id) {
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
