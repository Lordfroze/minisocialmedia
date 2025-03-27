<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment; // import model Comment
use Illuminate\Support\Facades\Validator; // import validator

class CommentsController extends Controller
{
    // menyimpan komentar
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
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
            'user_id' => $request->user_id,
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
