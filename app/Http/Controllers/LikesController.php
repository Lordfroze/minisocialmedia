<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Validator; // import validator

class LikesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => $validator->errors()
            ]);
        }

        // Simpan like baru ke dalam database
        $like = Like::create([
            'user_id' => $request->user_id,
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