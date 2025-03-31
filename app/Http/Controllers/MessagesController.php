<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // import validator
use App\Models\Message; // import model Message

class MessagesController extends Controller
{
    //menyimpan pesan
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_id' =>'required',
            'receiver_id' =>'required',
            'message_content' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
              'success' => false,
              'message' => $validator->errors()
            ], 400);
        }

        // jika validasi berhasil
        $message = Message::create([
            'sender_id' => $request->sender_id,
           'receiver_id' => $request->receiver_id,
           'message_content' => $request->message_content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'data' => $message
        ]);
    }

}
