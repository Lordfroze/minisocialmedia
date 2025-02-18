<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // import model Post

class PostsController extends Controller
{
    //
    public function index()
    {   
        $posts = Post::get(); // mengambil semua data dari model Post

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
}
