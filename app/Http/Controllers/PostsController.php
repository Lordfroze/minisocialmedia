<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // import model Post
use Illuminate\Support\Facades\Validator; // import validator
use Tymon\JWTAuth\Facades\JWTAuth; // import JWTAuth

class PostsController extends Controller
{
    // function index
    public function index()
    {   
        $posts = Post::get(); // mengambil semua data dari model Post

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    // function store
    public function store(Request $request){
        $user = JWTAuth::parseToken()->authenticate(); // mengambil data user yang login berdasarkan token

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
            'image_url' => 'nullable'
        ]);

        // check validator jika gagal
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        // jika validator sukses
        $post = Post::create([
            'user_id' => $user->id,
            'content' => $request->content,
            'image_url' => $request->image_url
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat post',
            'data' => $post
        ], 201); 
    }

    // function show
    public function show($id){
        $post = Post::find($id);

        return response()->json([
           'success' => true,
            'data' => $post
        ], 200);
    }

    // function update
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
            'image_url' => 'nullable'
        ]);

        // check validator jika gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->error()
            ],400);
        }

        // jika validator sukses
        $post = Post::find($id);
        // Tampung data baru
        $post->content = $request->content;
        $post->image_url = $request->image_url;
        $post->save();

        return response()->json([
           'success' => true,
           'message' => 'Berhasil mengupdate data',
            'data' => $post
        ]);
    }

    // function destroy
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json([
          'success' => true,
            'message' => 'Post berhasil dihapus'
        ]);
    }

    

}
