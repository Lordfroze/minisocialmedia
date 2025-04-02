<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment; // import model Comment
use Illuminate\Support\Facades\Validator; // import validator
use Tymon\JWTAuth\Facades\JWTAuth; // import JWTAuth


class CommentsController extends Controller
{
    // menyimpan komentar
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate(); // mengambil data user yang login berdasarkan token

        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'content' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        // Simpan komentar baru ke dalam database
        $comment = Comment::create([
            'user_id' => $user->id, // mengambil id user dari data user yang login
            'post_id' => $request->post_id,
            'content' => $request->content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $comment
        ],201);
    }

    // menghapus komentar
    public function destroy($id)
    {
        Comment::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus'
        ]);
    }


}
