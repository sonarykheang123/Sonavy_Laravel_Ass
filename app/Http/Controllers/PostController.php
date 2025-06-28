<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePostRequest;


class PostController extends Controller
{



    public function edit(Request $request, int $id)
    {
        $post = Post::where('id', $id)
            ->update([
                'title' => $request->title,
                'body' => $request->body
            ]);
        if ($post) {
            return response()->json([
                'message' => 'Post updated successfully',
                'data' =>  $post
            ], 201);
        }

        return response()->json([
            'message' => "Failed to update post"
        ], 203);
    }
    public function create(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        return response()->json([
            "message" => "Success",
            "data" => $post
        ]);
    

        
        if($validator->fails()){
           return $validator->messages();
        }

        $post = Post::create($request->all());
        return response()->json([
            "message" => "Success",
            "data" => $post
        ]);
    }
    //
    public function index()
    {
        $post = new Post();
        return response()->json([
            'message' => 'request successfully!',
            // data normally get from model that query from db
            'data' => $post::all(),
        ], 200);
    }

    public function destroy(int $id)
    {
        $post = Post::where('id', $id)->delete();
        if ($post) {
            return response()->json([
                'message' => 'Post deleted successfully',
                'data' =>  $post
            ], 201);
        }

        return response()->json([
            'message' => "Failed to delete post"
        ], 203);
    }

    public function show(int $id)
    {
        $post = Post::where('id', $id)->get();
        if ($post) {
            return response()->json([
                'message' => 'successfully',
                'data' =>  $post
            ], 201);
        }

        return response()->json([
            'message' => "Post id:" . $id . "not found"
        ], 203);
    }
}
