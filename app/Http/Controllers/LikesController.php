<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Validator; // import validator
use Tymon\JWTAuth\Facades\JWTAuth; // import JWTAuth


class LikesController extends Controller
{
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate(); // mengambil data user yang login berdasarkan token

        $validator = Validator::make($request->all(), [
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => $validator->errors()
            ], 400);
        }

        // Simpan like baru ke dalam database
        $like = Like::create([
            'user_id' => $user->id, // mengambil id user dari data user yang login
            'post_id' => $request->post_id
        ]);

        return response()->json([
           'success' => true,
           'message' => 'Like berhasil ditambahkan',
            'data' => $like
        ], 201);
    }

    // menghapus like
    public function destroy($id){
        Like::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Like berhasil dihapus'
        ]);
    }
}